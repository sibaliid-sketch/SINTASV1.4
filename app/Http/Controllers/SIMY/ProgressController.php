<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\StudentProgress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display student progress dashboard
     */
    public function index()
    {
        $student = Auth::user();
        
        // Get all progress records
        $progressData = StudentProgress::where('student_id', $student->id)
            ->with('program', 'registration')
            ->get();
        
        // Calculate overall stats
        $totalProgress = $progressData->avg('overall_progress_percentage');
        $completedPrograms = $progressData->where('status', 'completed')->count();
        $onTrackPrograms = $progressData->where('status', 'on_track')->count();
        $aheadPrograms = $progressData->where('status', 'ahead')->count();
        $behindPrograms = $progressData->where('status', 'behind')->count();
        
        // Get detailed progress per program
        $detailed = $progressData->map(function($progress) {
            return [
                'program' => $progress->program,
                'progress' => $progress,
                'completionRate' => [
                    'materials' => $progress->total_materials > 0 
                        ? round(($progress->completed_materials / $progress->total_materials) * 100, 2) 
                        : 0,
                    'assignments' => $progress->total_assignments > 0 
                        ? round(($progress->completed_assignments / $progress->total_assignments) * 100, 2) 
                        : 0,
                    'quizzes' => $progress->total_quizzes > 0 
                        ? round(($progress->completed_quizzes / $progress->total_quizzes) * 100, 2) 
                        : 0,
                ]
            ];
        });

        return view('simy.progress.index', compact(
            'progressData',
            'totalProgress',
            'completedPrograms',
            'onTrackPrograms',
            'aheadPrograms',
            'behindPrograms',
            'detailed'
        ));
    }
}
