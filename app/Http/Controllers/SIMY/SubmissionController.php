<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\AssignmentSubmission;
use App\Models\SIMY\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Store a new assignment submission
     */
    public function store(Request $request, Assignment $assignment)
    {
        $student = Auth::user();
        
        // Check access
        if (!$student->programs()->where('program_id', $assignment->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'submission_text' => 'nullable|string',
            'submission_file' => 'nullable|file|max:10240' // 10MB max
        ]);

        // Check if already submitted
        $existing = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existing && !$assignment->allow_late_submission) {
            return back()->with('error', 'You have already submitted this assignment.');
        }

        $submissionData = [
            'assignment_id' => $assignment->id,
            'student_id' => $student->id,
            'submission_text' => $validated['submission_text'] ?? null,
            'submitted_at' => now(),
            'is_late' => $assignment->isOverdue()
        ];

        // Handle file upload
        if ($request->hasFile('submission_file')) {
            $path = $request->file('submission_file')
                ->store('submissions/' . $assignment->id, 'public');
            $submissionData['submission_file_url'] = Storage::url($path);
        }

        if ($existing) {
            $existing->update($submissionData);
        } else {
            AssignmentSubmission::create($submissionData);
        }

        return back()->with('success', 'Assignment submitted successfully!');
    }
}
