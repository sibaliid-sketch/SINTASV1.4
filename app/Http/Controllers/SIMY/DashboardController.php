<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\StudentProgress;
use App\Models\SIMY\StudentAchievement;
use App\Models\General\ClassAnnouncement;
use App\Models\SIMY\Assignment;
use App\Models\SIMY\Material;
use App\Models\SIMY\StudentCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the SIMY dashboard with comprehensive student learning data
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $student = Auth::user();
        
        // Validate student has proper role
        if (!in_array($student->role, ['student', 'teacher', 'student_under_18'])) {
            return redirect()->route('dashboard')->withError('Invalid access role');
        }

        try {
            // Get student's active programs with caching
            $programs = Cache::remember(
                'student_programs_' . $student->id,
                60,
                function () use ($student) {
                    return $student->programs()->where('is_active', true)->get();
                }
            );
            
            // Get progress for all programs
            $progressData = StudentProgress::where('student_id', $student->id)
                ->with('program')
                ->orderBy('overall_progress_percentage', 'desc')
                ->get();
            
            // Get recent achievements
            $achievements = StudentAchievement::where('student_id', $student->id)
                ->with('achievement')
                ->latest('earned_at')
                ->limit(5)
                ->get();
            
            // Get recent announcements
            $announcements = ClassAnnouncement::whereIn('program_id', $programs->pluck('id'))
                ->with('program', 'teacher')
                ->latest('published_at')
                ->limit(5)
                ->get();
            
            // Get overdue assignments
            $overdueAssignments = Assignment::whereIn('program_id', $programs->pluck('id'))
                ->where('due_date', '<', now())
                ->whereDoesntHave('submissions', function ($query) use ($student) {
                    $query->where('student_id', $student->id);
                })
                ->with('program', 'teacher')
                ->orderBy('due_date', 'asc')
                ->limit(10)
                ->get();
            
            // Get upcoming assignments (due in next 7 days)
            $upcomingAssignments = Assignment::whereIn('program_id', $programs->pluck('id'))
                ->whereBetween('due_date', [now(), now()->addDays(7)])
                ->with('program', 'teacher')
                ->latest('due_date')
                ->limit(5)
                ->get();

            // Get completed certificates
            $certificates = StudentCertificate::where('student_id', $student->id)
                ->with('program')
                ->latest('issued_date')
                ->limit(5)
                ->get();

            return view('SIMY.dashboard', compact(
                'progressData',
                'achievements',
                'announcements',
                'overdueAssignments',
                'upcomingAssignments',
                'programs',
                'certificates'
            ));
            
        } catch (\Exception $e) {
            Log::error('SIMY Dashboard Error: ' . $e->getMessage());
            return redirect()->route('simy')->withError('Error loading dashboard data. Please try again.');
        }
    }
}

