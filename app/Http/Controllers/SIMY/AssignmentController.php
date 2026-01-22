<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\Assignment;
use App\Models\SIMY\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display list of assignments
     */
    public function index()
    {
        $student = Auth::user();
        $programs = $student->programs()->whereNull('deleted_at')->pluck('id');
        
        // Get assignments with submission status
        $assignments = Assignment::whereIn('program_id', $programs)
            ->where('is_published', true)
            ->with(['program', 'teacher', 'submissions' => function($query) use ($student) {
                $query->where('student_id', $student->id);
            }])
            ->latest('due_date')
            ->paginate(15);

        // Status categories
        $completed = AssignmentSubmission::whereIn('assignment_id', 
                Assignment::whereIn('program_id', $programs)->pluck('id'))
            ->where('student_id', $student->id)
            ->count();
        
        $pending = Assignment::whereIn('program_id', $programs)
            ->where('is_published', true)
            ->where('due_date', '>', now())
            ->whereDoesntHave('submissions', function($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->count();
        
        $overdue = Assignment::whereIn('program_id', $programs)
            ->where('is_published', true)
            ->where('due_date', '<', now())
            ->whereDoesntHave('submissions', function($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->count();

        return view('simy.assignments.index', compact('assignments', 'completed', 'pending', 'overdue'));
    }

    /**
     * Display a specific assignment
     */
    public function show(Assignment $assignment)
    {
        $student = Auth::user();
        
        // Check access
        if (!$student->programs()->where('program_id', $assignment->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $assignment->load('program', 'teacher', 'schedule');
        
        // Get student's submission if exists
        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();
        
        // Check if overdue
        $isOverdue = $assignment->isOverdue();
        $daysLeft = $assignment->daysUntilDue();

        return view('simy.assignments.show', compact('assignment', 'submission', 'isOverdue', 'daysLeft'));
    }
}
