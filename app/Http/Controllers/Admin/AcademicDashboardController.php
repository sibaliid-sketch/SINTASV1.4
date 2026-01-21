<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Program;
use App\Models\Registration;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AcademicDashboardController extends Controller
{
    /**
     * Display the academic dashboard console.
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'total_services' => Service::count(),
            'active_services' => Service::active()->count(),
            'total_programs' => Program::count(),
            'active_programs' => Program::active()->count(),
            'total_registrations' => Registration::count(),
            'pending_registrations' => Registration::where('status', 'pending')->count(),
            'total_schedules' => Schedule::count(),
            'active_schedules' => Schedule::where('is_active', true)->count(),
        ];

        // Get recent programs
        $recentPrograms = Program::with('service')
            ->latest()
            ->take(5)
            ->get();

        // Get programs by education level
        $programsByLevel = Program::active()
            ->selectRaw('education_level, COUNT(*) as count')
            ->groupBy('education_level')
            ->get()
            ->pluck('count', 'education_level');

        // Get programs by service
        $programsByService = Service::withCount('programs')
            ->get()
            ->pluck('programs_count', 'name');

        // Get recent registrations
        $recentRegistrations = Registration::with(['program.service', 'user'])
            ->latest()
            ->take(10)
            ->get();

        // Get profit margin analysis
        $profitAnalysis = Program::active()
            ->selectRaw('
                AVG((price - hpp) / hpp * 100) as avg_margin,
                MIN((price - hpp) / hpp * 100) as min_margin,
                MAX((price - hpp) / hpp * 100) as max_margin,
                COUNT(*) as total_programs
            ')
            ->first();

        return view('admin.academic.console', compact(
            'stats',
            'recentPrograms',
            'programsByLevel',
            'programsByService',
            'recentRegistrations',
            'profitAnalysis'
        ));
    }

    /**
     * Get dashboard data for AJAX requests
     */
    public function getData(Request $request)
    {
        $period = $request->get('period', 'month');

        // Calculate date range
        $startDate = now()->startOfMonth();
        if ($period === 'week') {
            $startDate = now()->startOfWeek();
        } elseif ($period === 'year') {
            $startDate = now()->startOfYear();
        }

        $data = [
            'registrations' => Registration::where('created_at', '>=', $startDate)->count(),
            'new_programs' => Program::where('created_at', '>=', $startDate)->count(),
            'active_programs' => Program::active()->count(),
            'total_revenue' => Registration::where('status', 'confirmed')
                ->where('created_at', '>=', $startDate)
                ->sum('total_amount'),
        ];

        return response()->json($data);
    }
}
