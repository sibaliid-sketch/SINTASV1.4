<?php

namespace App\Http\Controllers\SIMY;

use App\Http\Controllers\Controller;
use App\Models\General\ClassMessage;
use App\Models\General\MessageReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display class messages/forum
     */
    public function index()
    {
        $student = Auth::user();
        $programs = $student->programs()->whereNull('deleted_at')->pluck('id');
        
        // Get root messages (questions/discussions)
        $messages = ClassMessage::whereIn('program_id', $programs)
            ->whereNull('parent_message_id')
            ->with(['sender', 'program', 'replies.sender', 'reactions'])
            ->latest()
            ->paginate(15);

        return view('simy.forum.index', compact('messages'));
    }

    /**
     * Store a new message
     */
    public function store(Request $request)
    {
        $student = Auth::user();
        
        // Check if student has access to this program
        if (!$student->programs()->where('program_id', $request->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'message' => 'required|string|min:3',
            'type' => 'required|in:text,question,answer',
            'parent_message_id' => 'nullable|exists:class_messages,id'
        ]);

        ClassMessage::create([
            'program_id' => $validated['program_id'],
            'sender_id' => $student->id,
            'message' => $validated['message'],
            'type' => $validated['type'],
            'parent_message_id' => $validated['parent_message_id'] ?? null
        ]);

        return back()->with('success', 'Message posted successfully!');
    }

    /**
     * Add reaction to a message
     */
    public function addReaction(Request $request, ClassMessage $message)
    {
        $student = Auth::user();
        
        // Check access
        if (!$student->programs()->where('program_id', $message->program_id)->exists()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'reaction_type' => 'required|in:like,love,wow,thinking,sad'
        ]);

        // Remove existing reaction if any
        MessageReaction::where('message_id', $message->id)
            ->where('user_id', $student->id)
            ->delete();

        // Add new reaction
        MessageReaction::create([
            'message_id' => $message->id,
            'user_id' => $student->id,
            'reaction_type' => $validated['reaction_type']
        ]);

        return back()->with('success', 'Reaction added!');
    }
}
