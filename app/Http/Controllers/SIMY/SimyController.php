<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SIMY\DashboardController as SimyDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * SimyController - Gateway Controller untuk SIMY System
 * Mengarahkan ke SIMY subfolder controllers untuk memisahkan concerns
 */
class SimyController extends Controller
{
    protected $simyDashboard;

    public function __construct(SimyDashboardController $simyDashboard)
    {
        $this->simyDashboard = $simyDashboard;
    }

    /**
     * Display the SIMY dashboard - Gateway to SIMY DashboardController
     */
    public function index()
    {
        $user = auth()->user();

        // Validate student/teacher role
        if (!in_array($user->role ?? '', ['student', 'student_under_18', 'teacher', 'guru'])) {
            return redirect()->route('dashboard')->withError('Invalid student/teacher access');
        }

        try {
            return $this->simyDashboard->index();
        } catch (\Exception $e) {
            Log::error('SIMY Gateway Error: ' . $e->getMessage());
            return redirect()->route('dashboard')->withError('Error accessing SIMY');
        }
    }

    /**
     * Display the Beranda (Home) page for SIMY.
     */
    public function beranda()
    {
        return view('SIMY.beranda');
    }

    /**
     * Display the main SIMY view
     */
    public function show()
    {
        return view('SIMY.simy');
    }

    /**
     * Display the Ticket page for SIMY.
     */
    public function ticket()
    {
        return view('SIMY.ticket');
    }

    /**
     * Display the Message page for SIMY.
     */
    public function message()
    {
        return view('SIMY.message');
    }

    /**
     * Display the Notification page for SIMY.
     */
    public function notification()
    {
        return view('SIMY.notification');
    }

    /**
     * Display the Setting page for SIMY.
     */
    public function setting()
    {
        return view('SIMY.setting');
    }
}
