<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Registration;
use App\Models\Schedule;
use App\Models\Promo;
use App\Models\PaymentProof;
use App\Services\IdGeneratorService;
use App\Services\AuditLoggerService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // ==================== INTRO ====================
    public function index()
    {
        return view('registration.step1-intro');
    }

    // ==================== STEP 1 ==================== (Who to register)
    public function step1Show()
    {
        return view('registration.step1-registrar');
    }

    public function step1Submit(Request $request)
    {
        $validated = $request->validate([
            'is_self_register' => 'required|boolean',
        ]);

        return redirect()->route('registration.step2')->with($validated)->withInput();
    }

    // ==================== STEP 2 ==================== (Education & Student Data Form)
    public function step2Show(Request $request)
    {
        if (!session()->has('is_self_register')) {
            return redirect()->route('registration.step1');
        }

        $programs = Program::where('is_active', true)->get();

        return view('registration.step2-form', compact('programs'));
    }

    public function step2Submit(Request $request)
    {
        $validated = $request->validate([
            'is_self_register' => 'required|boolean',
            'education_level' => 'required|string|in:TK,SD,SMP,SMA,Mahasiswa,Umum',
            'class_level' => 'nullable|string|max:50',
            'service_type' => 'required|string|in:Regular-in Class,Private,Rumah Belajar,Mitra Belajar',
            'student_name' => 'required|string|max:255',
            'student_identity_number' => 'required|string|max:50',
            'student_dob' => 'required|date|before:today',
            'student_gender' => 'required|in:male,female',
            'student_province' => 'required|string|max:100',
            'student_regency' => 'required|string|max:100',
            'student_district' => 'required|string|max:100',
            'student_village' => 'required|string|max:100',
            'student_address_detail' => 'required|string',
            'student_phone' => 'nullable|string|max:20',
            'student_email' => 'nullable|email',
            'student_job' => 'nullable|string|max:100',
            'parent_name' => 'nullable|string|max:255',
            'parent_identity_number' => 'nullable|string|max:50',
            'parent_relationship' => 'nullable|string|max:50',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email',
            'parent_province' => 'nullable|string|max:100',
            'parent_regency' => 'nullable|string|max:100',
            'parent_district' => 'nullable|string|max:100',
            'parent_village' => 'nullable|string|max:100',
            'parent_address_detail' => 'nullable|string',
            'program_id' => 'required|exists:programs,id',
            'promo_code' => 'nullable|string|max:50',
            'agree_terms' => 'required|accepted',
            'agree_contract' => 'required|accepted',
        ]);

        // Age validation for self-registration
        if ($request->input('is_self_register')) {
            $birthdate = new \DateTime($request->input('student_dob'));
            $today = new \DateTime();
            $age = $today->diff($birthdate)->y;

            if ($age < 18) {
                // Require parent data
                $request->validate([
                    'parent_name' => 'required|string|max:255',
                    'parent_identity_number' => 'required|string|max:50',
                    'parent_relationship' => 'required|string|max:50',
                    'parent_phone' => 'required|string|max:20',
                    'parent_province' => 'required|string|max:100',
                    'parent_regency' => 'required|string|max:100',
                    'parent_district' => 'required|string|max:100',
                    'parent_village' => 'required|string|max:100',
                    'parent_address_detail' => 'required|string',
                ]);
            }
        }

        return redirect()->route('registration.step3')->with($validated)->withInput();
    }

    // ==================== STEP 3 ==================== (Review & Confirm)
    public function step3Show(Request $request)
    {
        if (!session()->has('program_id')) {
            return redirect()->route('registration.step2');
        }

        $program = Program::findOrFail(session('program_id'));
        $schedule = Schedule::where('program_id', $program->id)->where('is_active', true)->first();

        // Calculate age
        $birthdate = new \DateTime(session('student_dob'));
        $today = new \DateTime();
        $studentAge = $today->diff($birthdate)->y;

        // Calculate discount
        $discountAmount = 0;
        $promoCode = session('promo_code');
        if ($promoCode) {
            $promo = Promo::where('promo_code', strtoupper($promoCode))
                ->where('is_active', true)
                ->first();

            if ($promo && $promo->isValid()) {
                $discountAmount = $promo->calculateDiscount($program->price);
            }
        }

        $totalPrice = $program->price - $discountAmount;

        return view('registration.step3-review', compact('program', 'schedule', 'studentAge', 'discountAmount', 'totalPrice'));
    }

    public function step3Submit(Request $request)
    {
        $validated = $request->validate([
            'payment_choice' => 'required|in:pay_now,pay_later',
        ]);

        $paymentChoice = $request->input('payment_choice');

        if ($paymentChoice === 'pay_later') {
            // Create registration with pending_payment status
            return $this->createRegistration($request, 'pending_payment');
        } else {
            // Create registration and proceed to payment
            $registration = $this->createRegistration($request, 'awaiting_verification', true);
            return redirect()->route('registration.step4', $registration->id);
        }
    }

    // ==================== STEP 4 ==================== (Payment)
    public function step4Show(Registration $registration)
    {
        return view('registration.step4-payment', compact('registration'));
    }

    public function step4Submit(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bank_name' => 'required|string|max:100',
            'sender_name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'transfer_date' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'nullable|string',
        ]);

        // Store file
        $filePath = $request->file('proof_file')->store('payment_proofs/' . $registration->order_id, 'public');

        // Create payment proof
        PaymentProof::create([
            'registration_id' => $registration->id,
            'file_path' => $filePath,
            'file_name' => $request->file('proof_file')->getClientOriginalName(),
            'bank_name' => $validated['bank_name'],
            'sender_name' => $validated['sender_name'],
            'amount' => $validated['amount'],
            'transfer_date' => $validated['transfer_date'],
            'status' => 'pending',
        ]);

        // Update registration
        $registration->update([
            'status' => 'awaiting_verification',
            'payment_status' => 'pending',
        ]);

        // Log audit
        AuditLoggerService::log('payment_proof_uploaded', 'Registration', $registration->id, [], 'Bukti pembayaran diupload');

        return redirect()->route('registration.step5', $registration->id);
    }

    // ==================== STEP 5 ==================== (Final Confirmation)
    public function step5Show(Registration $registration)
    {
        return view('registration.step5-confirmation', compact('registration'));
    }

    private function createRegistration(Request $request, $status = 'pending_payment', $returnObject = false)
    {
        $program = Program::findOrFail(session('program_id'));

        // Auto-assign first available schedule
        $schedule = Schedule::where('program_id', $program->id)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return redirect()->route('registration.step2')->with(['error' => 'Tidak ada jadwal tersedia untuk program ini']);
        }

        // Build addresses
        $studentAddress = session('student_province') . ', ' . session('student_regency') . ', ' . session('student_district') . ', ' . session('student_village') . ', ' . session('student_address_detail');
        $parentAddress = session('parent_province') ? session('parent_province') . ', ' . session('parent_regency') . ', ' . session('parent_district') . ', ' . session('parent_village') . ', ' . session('parent_address_detail') : null;

        // Generate IDs
        $orderId = IdGeneratorService::generateOrderId();
        $studentId = IdGeneratorService::generateStudentId();
        $invoiceId = IdGeneratorService::generateInvoiceId();

        // Calculate age
        $birthdate = new \DateTime(session('student_dob'));
        $today = new \DateTime();
        $studentAge = $today->diff($birthdate)->y;

        // Calculate discount
        $discountAmount = 0;
        $promoCode = session('promo_code');
        if ($promoCode) {
            $promo = Promo::where('promo_code', strtoupper($promoCode))
                ->where('is_active', true)
                ->first();

            if ($promo && $promo->isValid()) {
                $discountAmount = $promo->calculateDiscount($program->price);
            }
        }

        // Create registration
        $registration = Registration::create([
            'order_id' => $orderId,
            'student_id' => $studentId,
            'invoice_id' => $invoiceId,
            'program_id' => $program->id,
            'schedule_id' => $schedule->id,
            'promo_id' => $promo ? $promo->id : null,
            'student_name' => session('student_name'),
            'student_identity_number' => session('student_identity_number'),
            'student_dob' => session('student_dob'),
            'student_gender' => session('student_gender'),
            'student_address' => $studentAddress,
            'student_phone' => session('student_phone'),
            'student_email' => session('student_email'),
            'student_job' => session('student_job'),
            'student_age' => $studentAge,
            'education_level' => session('education_level'),
            'class_level' => session('class_level'),
            'service_type' => session('service_type'),
            'is_self_register' => session('is_self_register'),
            'parent_name' => session('parent_name'),
            'parent_identity_number' => session('parent_identity_number'),
            'parent_phone' => session('parent_phone'),
            'parent_email' => session('parent_email'),
            'parent_relationship' => session('parent_relationship'),
            'parent_address' => $parentAddress,
            'status' => $status,
            'base_price' => $program->price,
            'discount_amount' => $discountAmount,
            'tax_amount' => 0,
            'total_price' => $program->price - $discountAmount,
            'payment_status' => $status === 'pending_payment' ? 'unpaid' : 'pending',
            'payment_deadline' => now()->addDays(2), // 2 days before class starts
        ]);

        // Log audit
        AuditLoggerService::log('created', 'Registration', $registration->id, [], "Order {$orderId} created");

        // Notify admins
        $notificationType = $status === 'pending_payment' ? 'registration_pay_later' : 'registration_pay_now';
        $title = $status === 'pending_payment' ? 'Pendaftaran Baru - Bayar Nanti' : 'Pendaftaran Baru - Menunggu Pembayaran';
        $message = "Pendaftaran baru dari " . session('student_name') . " untuk program {$program->name}. Order ID: {$orderId}";
        \App\Services\NotificationService::notifyAdmins($notificationType, $title, $message, [
            'registration_id' => $registration->id,
            'order_id' => $orderId,
            'student_name' => session('student_name'),
            'program_name' => $program->name,
            'service_type' => $program->service_type,
        ]);

        if ($returnObject) {
            return $registration;
        }

        return redirect()->route('registration.step4', $registration->id);
    }
}
