<?php

namespace App\Http\Controllers;

use App\Models\Welcomeguest\Service;
use App\Models\General\Program;
use App\Models\General\Registration;
use App\Models\General\Schedule;
use App\Models\Welcomeguest\Promo;
use App\Models\General\PaymentProof;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     * Routes users to their appropriate system dashboard based on role.
     */
    public function index()
    {
        $user = auth()->user();

        // Validate user exists and has a role
        if (!$user || !$user->role) {
            return redirect()->route('login')->withError('Invalid user session. Please login again.');
        }

        // Route based on user role
        switch ($user->role) {
            case 'student':
            case 'student_under_18':
                return redirect()->route('simy');
            
            case 'parent':
            case 'guardian':
                return redirect()->route('sitra');
            
            case 'superadmin':
            case 'admin':
                return view('SINTAS.Superadmin.dashboard-superadmin');
            
            case 'employee':
            case 'karyawan':
                // Redirect to department-specific dashboard
                if ($user->department) {
                    return redirect()->route('departments.' . str_replace(' ', '-', strtolower($user->department)));
                }
                return redirect()->route('sintas.welcome');
            
            case 'teacher':
                return redirect()->route('simy');
            
            default:
                // Default fallback - redirect to SINTAS welcome
                return redirect()->route('sintas.welcome');
        }
    }
}
