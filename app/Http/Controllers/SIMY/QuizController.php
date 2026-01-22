<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\Quiz;
use App\Models\SIMY\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display list of quizzes
     */
    public function index()
    {
        $student = Auth::user();
        $programs = $student->programs()->whereNull('deleted_at')->pluck('id');
        
        // Get quizzes with attempt information
        $quizzes = Quiz::whereIn('program_id', $programs)
            ->where('is_published', true)
            ->with(['material', 'program', 'attempts' => function($query) use ($student) {
                $query->where('student_id', $student->id)
                    ->where('completed_at', '!=', null);
            }])
            ->latest('created_at')
            ->paginate(10);

        return view('simy.quizzes.index', compact('quizzes'));
    }

    /**
     * Display a specific quiz
     */
    public function show(Quiz $quiz)
    {
        $student = Auth::user();
        
        // Check access
        if (!$student->programs()->where('program_id', $quiz->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $quiz->load('material', 'program', 'questions');
        
        // Get student's attempts
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $student->id)
            ->orderBy('attempt_number', 'desc')
            ->get();
        
        // Check if can attempt
        $canAttempt = true;
        if ($quiz->attempt_limit && $attempts->count() >= $quiz->attempt_limit) {
            $canAttempt = false;
        }
        
        // Get best score
        $bestScore = $attempts->max('percentage');
        $averageScore = round($attempts->avg('percentage'), 2);

        return view('simy.quizzes.show', compact('quiz', 'attempts', 'canAttempt', 'bestScore', 'averageScore'));
    }
}
