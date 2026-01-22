<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\SIMY\Quiz;
use App\Models\SIMY\QuizAttempt;
use App\Models\SIMY\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    /**
     * Start a new quiz attempt
     */
    public function create(Quiz $quiz)
    {
        $student = Auth::user();
        
        // Check access
        if (!$student->programs()->where('program_id', $quiz->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        // Check if can attempt
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('student_id', $student->id)
            ->get();
        
        if ($quiz->attempt_limit && $attempts->count() >= $quiz->attempt_limit) {
            return back()->with('error', 'You have reached the maximum number of attempts for this quiz.');
        }

        // Create new attempt
        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_id' => $student->id,
            'started_at' => now(),
            'attempt_number' => $attempts->count() + 1
        ]);

        $quiz->load('questions.options');
        
        // Shuffle questions if enabled
        $questions = $quiz->questions;
        if ($quiz->shuffle_questions) {
            $questions = $questions->shuffle();
        }

        return view('simy.quizzes.attempt', compact('quiz', 'attempt', 'questions'));
    }

    /**
     * Store quiz answers
     */
    public function store(Request $request, Quiz $quiz, QuizAttempt $attempt)
    {
        $student = Auth::user();
        
        // Validate ownership
        if ($attempt->student_id !== $student->id || $attempt->quiz_id !== $quiz->id) {
            abort(403, 'Unauthorized');
        }

        $answers = $request->input('answers', []);
        $score = 0;
        $totalPoints = 0;

        // Process each answer
        foreach ($answers as $questionId => $answer) {
            $question = $quiz->questions()->findOrFail($questionId);
            $totalPoints += $question->points;
            
            $isCorrect = false;
            $selectedOptionId = null;
            $pointsEarned = 0;

            if ($question->question_type === 'multiple_choice') {
                $selectedOptionId = $answer;
                $option = $question->options()->find($answer);
                
                if ($option && $option->is_correct) {
                    $isCorrect = true;
                    $pointsEarned = $question->points;
                    $score += $pointsEarned;
                }
            } elseif ($question->question_type === 'true_false') {
                $isCorrect = strtolower($answer) === strtolower($question->correct_answer);
                if ($isCorrect) {
                    $pointsEarned = $question->points;
                    $score += $pointsEarned;
                }
            }

            // Store answer
            QuizAnswer::create([
                'quiz_attempt_id' => $attempt->id,
                'quiz_question_id' => $question->id,
                'answer_text' => $answer,
                'selected_option_id' => $selectedOptionId,
                'is_correct' => $isCorrect,
                'points_earned' => $pointsEarned
            ]);
        }

        // Calculate percentage and pass status
        $percentage = $totalPoints > 0 ? ($score / $totalPoints) * 100 : 0;
        $passed = $percentage >= $quiz->passing_score;

        // Update attempt
        $attempt->update([
            'completed_at' => now(),
            'score' => $score,
            'total_points' => $totalPoints,
            'percentage' => round($percentage, 2),
            'passed' => $passed
        ]);

        return redirect()->route('simy.quizzes.show', $quiz)
            ->with('success', 'Quiz submitted! Your score: ' . round($percentage, 2) . '%');
    }
}
