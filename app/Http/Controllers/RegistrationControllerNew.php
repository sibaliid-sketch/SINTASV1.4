<?php

namespace App\Http\Controllers;

use App\Models\Welcomeguest\Service;
use App\Models\General\Program;
use App\Models\General\Registration;
use App\Models\General\Schedule;
use App\Models\Welcomeguest\Promo;
use App\Models\General\PaymentProof;
use App\Services\IdGeneratorService;
use App\Services\AuditLoggerService;
use App\Services\OtpService;
use App\Services\DocumentGenerationService;
use App\Services\RegistrationEmailService;
use App\Services\AccountCreationService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationControllerNew extends Controller
{
    // ==================== SECTION 1: REGISTRATION TYPE & SELECTION ====================
    
    /**
     * Step 1: Who's registering? (Parent or Self)
     * Shows registration type selection
     */
    public function step1Show()
    {
        // Clear any existing registration session data
        session()->forget('registration_data');
        return view('registration.step1-registrar');
    }

    /**
     * Submit Step 1 - Registration type selection
     */
    public function step1Submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'is_self_register' => 'required|boolean',
            ]);

            session(['registration_data' => $validated]);

            return redirect()->route('registration.step2');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration Step 1 Error: ' . $e->getMessage());
            return back()->withError('Error processing registration type. Please try again.');
        }
    }

    /**
     * Step 2: Class mode (Online or Offline)
     * Shows education method selection
     */
    public function step2Show()
    {
        if (!session()->has('registration_data.is_self_register')) {
            return redirect()->route('registration.step1')->withError('Please start from the beginning');
        }

        return view('registration.step2-education');
    }

    /**
     * Submit Step 2 - Education mode selection
     */
    public function step2Submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'class_mode' => 'required|in:online,offline',
            ]);

            $data = session('registration_data', []);
            $data = array_merge($data, $validated);
            session(['registration_data' => $data]);

            return redirect()->route('registration.step3');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration Step 2 Error: ' . $e->getMessage());
            return back()->withError('Error processing class mode. Please try again.');
        }
    }

    /**
     * Step 3: Education level & Class/Semester
     * Shows education level and class selection
     */
    public function step3Show()
    {
        if (!session()->has('registration_data.class_mode')) {
            return redirect()->route('registration.step2')->withError('Please select class mode first');
        }

        try {
            $isSelfRegister = session('registration_data.is_self_register');
            
            // Determine available education levels based on registrar type
            if ($isSelfRegister) {
                $educationLevels = ['Mahasiswa', 'Umum'];
            } else {
                $educationLevels = ['TK', 'SD', 'SMP', 'SMA'];
            }

            return view('registration.step3-education-level', compact('educationLevels', 'isSelfRegister'));
            
        } catch (\Exception $e) {
            Log::error('Registration Step 3 Show Error: ' . $e->getMessage());
            return redirect()->route('registration.step2')->withError('Error loading education levels');
        }
    }

    /**
     * Submit Step 3 - Education level selection
     */
    public function step3Submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'education_level' => 'required|string|in:TK,SD,SMP,SMA,Mahasiswa,Umum',
                'class_level' => 'nullable|string|max:50',
            ]);

            // Validate class_level requirement based on education_level
            if (in_array($validated['education_level'], ['TK', 'SD', 'SMP', 'SMA', 'Mahasiswa'])) {
                $request->validate([
                    'class_level' => 'required|string|max:50',
                ]);
            }

            $data = session('registration_data', []);
            $data = array_merge($data, $validated);
            session(['registration_data' => $data]);

            return redirect()->route('registration.step4');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration Step 3 Error: ' . $e->getMessage());
            return back()->withError('Error processing education level. Please try again.');
        }
    }

    /**
     * Step 4: Service selection (Layanan)
     */
    public function step4Show()
    {
        if (!session()->has('registration_data.education_level')) {
            return redirect()->route('registration.step3');
        }

        $sessionData = session('registration_data');
        
        // Get filtered services
        $services = Service::active()
            ->forRegistrarType($sessionData['is_self_register'])
            ->byClassMode($sessionData['class_mode'])
            ->byEducationLevel($sessionData['education_level'])
            ->get();

        return view('registration.step4-service-type', compact('services'));
    }

    public function step4Submit(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $data = session('registration_data', []);
        $data = array_merge($data, $validated);
        session(['registration_data' => $data]);

        return redirect()->route('registration.step5');
    }

    /**
     * Step 5: Program selection (filtered by service)
     */
    public function step5Show()
    {
        if (!session()->has('registration_data.service_id')) {
            return redirect()->route('registration.step4');
        }

        $sessionData = session('registration_data');
        
        // Get filtered programs
        $programs = Program::getFilteredPrograms(
            $sessionData['service_id'],
            $sessionData['class_mode'],
            $sessionData['education_level']
        );

        $service = Service::find($sessionData['service_id']);

        return view('registration.step5-program', compact('programs', 'service'));
    }

    public function step5Submit(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
        ]);

        $data = session('registration_data', []);
        $data = array_merge($data, $validated);
        session(['registration_data' => $data]);

        return redirect()->route('registration.step6');
    }

    /**
     * Step 6: Schedule selection
     */
    public function step6Show()
    {
        if (!session()->has('registration_data.program_id')) {
            return redirect()->route('registration.step5');
        }

        $sessionData = session('registration_data');
        $program = Program::with('schedules')->find($sessionData['program_id']);
        
        // Get available schedules
        $schedules = $program->schedules()
            ->where('is_active', true)
            ->where('current_students', '<', DB::raw('max_students'))
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->get();

        return view('registration.step6-schedule', compact('schedules', 'program'));
    }

    public function step6Submit(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        // Verify schedule is still available
        $schedule = Schedule::find($validated['schedule_id']);
        if (!$schedule->isAvailable()) {
            return back()->withErrors(['schedule_id' => 'Jadwal yang dipilih sudah penuh atau tidak tersedia.']);
        }

        $data = session('registration_data', []);
        $data = array_merge($data, $validated);
        session(['registration_data' => $data]);

        return redirect()->route('registration.step7');
    }

    // ==================== SECTION 2: PERSONAL DATA & AGREEMENTS ====================

    /**
     * Step 7: Personal data forms (conditional based on registrar type)
     */
    public function step7Show()
    {
        if (!session()->has('registration_data.schedule_id')) {
            return redirect()->route('registration.step6');
        }

        $sessionData = session('registration_data');
        $isSelfRegister = $sessionData['is_self_register'];

        return view('registration.step7-student-data', compact('isSelfRegister'));
    }

    public function step7Submit(Request $request)
    {
        $sessionData = session('registration_data');
        $isSelfRegister = $sessionData['is_self_register'];

        // Base validation rules
        $rules = [
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
        ];

        // Calculate age
        $birthdate = new \DateTime($request->input('student_dob'));
        $today = new \DateTime();
        $age = $today->diff($birthdate)->y;

        // If parent is registering OR student is under 18, require parent data
        if (!$isSelfRegister || $age < 18) {
            $rules = array_merge($rules, [
                'parent_name' => 'required|string|max:255',
                'parent_identity_number' => 'required|string|max:50',
                'parent_relationship' => 'required|string|max:50',
                'parent_phone' => 'required|string|max:20',
                'parent_email' => 'nullable|email',
                'parent_province' => 'required|string|max:100',
                'parent_regency' => 'required|string|max:100',
                'parent_district' => 'required|string|max:100',
                'parent_village' => 'required|string|max:100',
                'parent_address_detail' => 'required|string',
            ]);
        }

        // Validate if self-register and under 18
        if ($isSelfRegister && $age < 18) {
            return back()->withErrors([
                'student_dob' => 'Anda masih di bawah umur. Silakan isi data orang tua/wali untuk melanjutkan pendaftaran.'
            ])->withInput();
        }

        $validated = $request->validate($rules);
        $validated['student_age'] = $age;

        $data = session('registration_data', []);
        $data = array_merge($data, $validated);
        session(['registration_data' => $data]);

        return redirect()->route('registration.step8');
    }

    /**
     * Step 8: Promo code & Agreements
     */
    public function step8Show()
    {
        if (!session()->has('registration_data.student_name')) {
            return redirect()->route('registration.step7');
        }

        return view('registration.step8-promo');
    }

    public function step8Submit(Request $request)
    {
        $validated = $request->validate([
            'promo_code' => 'nullable|string|max:50',
            'agree_terms' => 'required|accepted',
            'agree_contract' => 'required|accepted',
        ]);

        // Validate promo code if provided
        $promoId = null;
        $discountAmount = 0;
        
        if ($validated['promo_code']) {
            $promo = Promo::where('promo_code', strtoupper($validated['promo_code']))
                ->where('is_active', true)
                ->first();

            if (!$promo || !$promo->isValid()) {
                return back()->withErrors(['promo_code' => 'Kode promo tidak valid atau sudah kadaluarsa.'])->withInput();
            }

            $promoId = $promo->id;
            
            // Calculate discount
            $sessionData = session('registration_data');
            $program = Program::find($sessionData['program_id']);
            $discountAmount = $promo->calculateDiscount($program->price);
        }

        $data = session('registration_data', []);
        $data['promo_id'] = $promoId;
        $data['discount_amount'] = $discountAmount;
        session(['registration_data' => $data]);

        return redirect()->route('registration.step9');
    }

    // ==================== SECTION 3: ORDER SUMMARY ====================

    /**
     * Step 9: Order summary & confirmation
     */
    public function step9Show()
    {
        if (!session()->has('registration_data.student_name')) {
            return redirect()->route('registration.step7');
        }

        $sessionData = session('registration_data');
        
        // Load related data
        $service = Service::find($sessionData['service_id']);
        $program = Program::find($sessionData['program_id']);
        $schedule = Schedule::find($sessionData['schedule_id']);
        $promo = $sessionData['promo_id'] ? Promo::find($sessionData['promo_id']) : null;

        // Calculate pricing
        $basePrice = $program->price;
        $discountAmount = $sessionData['discount_amount'] ?? 0;
        $taxAmount = 0; // Can be calculated if needed
        $totalPrice = $basePrice - $discountAmount + $taxAmount;

        return view('registration.step9-confirmation', compact(
            'sessionData',
            'service',
            'program',
            'schedule',
            'promo',
            'basePrice',
            'discountAmount',
            'taxAmount',
            'totalPrice'
        ));
    }

    public function step9Submit(Request $request)
    {
        $validated = $request->validate([
            'payment_choice' => 'required|in:pay_now,pay_later',
        ]);

        // Create registration
        $registration = $this->createRegistration($validated['payment_choice']);

        if (!$registration) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat pendaftaran. Silakan coba lagi.']);
        }

        // Clear session data
        session()->forget('registration_data');

        return redirect()->route('registration.step10', $registration->id);
    }

    // ==================== SECTION 4: PAYMENT & CONFIRMATION ====================

    /**
     * Step 10: Payment portal
     */
    public function step10Show(Registration $registration)
    {
        return view('registration.step10-confirmation', compact('registration'));
    }

    public function step10Submit(Request $request, Registration $registration)
    {
        // If pay later, skip to confirmation
        if ($registration->payment_status === 'unpaid') {
            return redirect()->route('registration.step11', $registration->id);
        }

        // Validate payment proof upload
        $validated = $request->validate([
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bank_name' => 'required|string|max:100',
            'sender_name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'transfer_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Store payment proof file
        $filePath = $request->file('proof_file')->store('payment_proofs/' . $registration->order_id, 'public');

        // Create payment proof record
        PaymentProof::create([
            'registration_id' => $registration->id,
            'file_path' => $filePath,
            'file_name' => $request->file('proof_file')->getClientOriginalName(),
            'bank_name' => $validated['bank_name'],
            'sender_name' => $validated['sender_name'],
            'amount' => $validated['amount'],
            'transfer_date' => $validated['transfer_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        // Update registration status
        $registration->update([
            'status' => 'awaiting_verification',
            'payment_status' => 'pending',
        ]);

        // Log audit
        AuditLoggerService::log('payment_proof_uploaded', 'Registration', $registration->id, [], 'Bukti pembayaran diupload');

        // Notify admins
        NotificationService::notifyAdmins(
            'payment_proof_uploaded',
            'Bukti Pembayaran Baru',
            "Bukti pembayaran untuk order {$registration->order_id} telah diupload dan menunggu verifikasi.",
            [
                'registration_id' => $registration->id,
                'order_id' => $registration->order_id,
            ]
        );

        return redirect()->route('registration.step11', $registration->id);
    }

    /**
     * Step 11: Final confirmation
     */
    public function step11Show(Registration $registration)
    {
        // Generate documents
        $documents = DocumentGenerationService::generateAllDocuments($registration);

        // Generate OTP for account activation
        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;
        
        $name = $registration->is_self_register 
            ? $registration->student_name 
            : $registration->parent_name;

        if ($email) {
            $otp = OtpService::generateAndSend($email, $name);
        }

        // Send all registration emails
        RegistrationEmailService::sendAllRegistrationEmails($registration);

        return view('registration.step9-confirmation', compact('registration', 'documents'));
    }

    /**
     * Verify OTP and create accounts
     */
    public function verifyOtp(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $email = $registration->is_self_register 
            ? $registration->student_email 
            : $registration->parent_email;

        if (!OtpService::verify($email, $validated['otp'])) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.']);
        }

        // Create accounts
        $accounts = AccountCreationService::createAccountsForRegistration($registration);

        // Update registration status
        $registration->update([
            'status' => 'active',
        ]);

        // Log audit
        AuditLoggerService::log('accounts_created', 'Registration', $registration->id, [], 'Akun berhasil dibuat');

        return redirect()->route('registration.step11', $registration->id)
            ->with('success', 'Akun berhasil diaktifkan! Silakan cek email Anda untuk kredensial login.');
    }

    // ==================== HELPER METHODS ====================

    /**
     * Create registration record
     */
    private function createRegistration(string $paymentChoice): ?Registration
    {
        try {
            DB::beginTransaction();

            $sessionData = session('registration_data');
            $program = Program::find($sessionData['program_id']);
            $schedule = Schedule::find($sessionData['schedule_id']);

            // Generate IDs
            $orderId = IdGeneratorService::generateOrderId();
            $studentId = IdGeneratorService::generateStudentId();
            $invoiceId = IdGeneratorService::generateInvoiceId();
            $contractId = 'KTR/STU/' . date('y.m') . '/' . $studentId;

            // Calculate payment deadline (2 days before class starts)
            $paymentDeadline = $schedule->start_date->copy()->subDays(2);

            // Determine status based on payment choice
            $status = $paymentChoice === 'pay_now' ? 'awaiting_verification' : 'pending_payment';
            $paymentStatus = $paymentChoice === 'pay_now' ? 'pending' : 'unpaid';

            // Create registration
            $registration = Registration::create([
                'order_id' => $orderId,
                'student_id' => $studentId,
                'service_id' => $sessionData['service_id'],
                'program_id' => $sessionData['program_id'],
                'schedule_id' => $sessionData['schedule_id'],
                'promo_id' => $sessionData['promo_id'] ?? null,
                'student_name' => $sessionData['student_name'],
                'student_identity_number' => $sessionData['student_identity_number'],
                'student_dob' => $sessionData['student_dob'],
                'student_gender' => $sessionData['student_gender'],
                'student_phone' => $sessionData['student_phone'] ?? null,
                'student_email' => $sessionData['student_email'] ?? null,
                'student_job' => $sessionData['student_job'] ?? null,
                'student_province' => $sessionData['student_province'],
                'student_regency' => $sessionData['student_regency'],
                'student_district' => $sessionData['student_district'],
                'student_village' => $sessionData['student_village'],
                'student_address_detail' => $sessionData['student_address_detail'],
                'student_age' => $sessionData['student_age'],
                'education_level' => $sessionData['education_level'],
                'class_level' => $sessionData['class_level'] ?? null,
                'class_mode' => $sessionData['class_mode'],
                'is_self_register' => $sessionData['is_self_register'],
                'parent_name' => $sessionData['parent_name'] ?? null,
                'parent_identity_number' => $sessionData['parent_identity_number'] ?? null,
                'parent_phone' => $sessionData['parent_phone'] ?? null,
                'parent_email' => $sessionData['parent_email'] ?? null,
                'parent_relationship' => $sessionData['parent_relationship'] ?? null,
                'parent_province' => $sessionData['parent_province'] ?? null,
                'parent_regency' => $sessionData['parent_regency'] ?? null,
                'parent_district' => $sessionData['parent_district'] ?? null,
                'parent_village' => $sessionData['parent_village'] ?? null,
                'parent_address_detail' => $sessionData['parent_address_detail'] ?? null,
                'status' => $status,
                'base_price' => $program->price,
                'discount_amount' => $sessionData['discount_amount'] ?? 0,
                'tax_amount' => 0,
                'total_price' => $program->price - ($sessionData['discount_amount'] ?? 0),
                'payment_status' => $paymentStatus,
                'payment_deadline' => $paymentDeadline,
                'invoice_id' => $invoiceId,
                'contract_id' => $contractId,
            ]);

            // Increment schedule current_students
            $schedule->increment('current_students');

            // Increment promo used_count if applicable
            if ($sessionData['promo_id']) {
                Promo::find($sessionData['promo_id'])->increment('used_count');
            }

            // Log audit
            AuditLoggerService::log('created', 'Registration', $registration->id, [], "Order {$orderId} created");

            // Notify admins
            $notificationType = $paymentChoice === 'pay_now' ? 'registration_pay_now' : 'registration_pay_later';
            $title = $paymentChoice === 'pay_now' ? 'Pendaftaran Baru - Bayar Sekarang' : 'Pendaftaran Baru - Bayar Nanti';
            $message = "Pendaftaran baru dari {$sessionData['student_name']} untuk program {$program->name}. Order ID: {$orderId}";
            
            NotificationService::notifyAdmins($notificationType, $title, $message, [
                'registration_id' => $registration->id,
                'order_id' => $orderId,
                'student_name' => $sessionData['student_name'],
                'program_name' => $program->name,
            ]);

            DB::commit();

            return $registration;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration creation failed: ' . $e->getMessage());
            return null;
        }
    }

    // ==================== API ENDPOINTS ====================

    /**
     * Get filtered services (AJAX)
     */
    public function getFilteredServices(Request $request)
    {
        $services = Service::active()
            ->forRegistrarType($request->is_self_register)
            ->byClassMode($request->class_mode)
            ->byEducationLevel($request->education_level)
            ->get();

        return response()->json($services);
    }

    /**
     * Get filtered programs (AJAX)
     */
    public function getFilteredPrograms(Request $request)
    {
        $programs = Program::getFilteredPrograms(
            $request->service_id,
            $request->class_mode,
            $request->education_level
        );

        return response()->json($programs);
    }

    /**
     * Get available schedules (AJAX)
     */
    public function getAvailableSchedules(Request $request, Program $program)
    {
        $schedules = $program->schedules()
            ->where('is_active', true)
            ->where('current_students', '<', DB::raw('max_students'))
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->get();

        return response()->json($schedules);
    }

    /**
     * Validate promo code (AJAX)
     */
    public function validatePromo(Request $request)
    {
        $promo = Promo::where('promo_code', strtoupper($request->promo_code))
            ->where('is_active', true)
            ->first();

        if (!$promo || !$promo->isValid()) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode promo tidak valid atau sudah kadaluarsa.'
            ]);
        }

        $program = Program::find($request->program_id);
        $discountAmount = $promo->calculateDiscount($program->price);

        return response()->json([
            'valid' => true,
            'promo' => $promo,
            'discount_amount' => $discountAmount,
            'message' => 'Kode promo valid!'
        ]);
    }
}
