<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\StudentCertificate;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display student's certificates
     */
    public function index()
    {
        $student = Auth::user();
        
        $certificates = StudentCertificate::where('student_id', $student->id)
            ->with('program', 'registration')
            ->latest('issue_date')
            ->paginate(10);
        
        // Statistics
        $totalCertificates = $certificates->total();
        $validCertificates = StudentCertificate::where('student_id', $student->id)
            ->where(function($query) {
                $query->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>', now());
            })
            ->count();

        return view('simy.certificates.index', compact('certificates', 'totalCertificates', 'validCertificates'));
    }

    /**
     * Display certificate details
     */
    public function show(StudentCertificate $certificate)
    {
        $student = Auth::user();
        
        // Check ownership
        if ($certificate->student_id !== $student->id) {
            abort(403, 'Unauthorized');
        }

        $certificate->load('program', 'student', 'registration');
        
        $isValid = $certificate->isValid();
        $isExpired = $certificate->isExpired();

        return view('simy.certificates.show', compact('certificate', 'isValid', 'isExpired'));
    }
}
