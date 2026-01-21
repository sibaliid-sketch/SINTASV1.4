<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminChatController extends Controller
{
    private function getAllowedSources($department)
    {
        $sources = [
            'operations' => ['welcome', 'simy', 'sitra'],
            'it' => ['sintas'],
        ];
        return $sources[$department] ?? [];
    }

    public function index($department)
    {
        $user = Auth::user();

        // Check if user has access to this department
        if ($user->role !== 'superadmin' && $user->department !== $department) {
            abort(403, 'Unauthorized access');
        }

        $allowedSources = $this->getAllowedSources($department);

        // Get chat messages from allowed sources grouped by user
        $chatMessages = \App\Models\ChatMessage::with('sender')
            ->whereIn('source', $allowedSources)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('sender_id');

        $activeChats = [];
        foreach ($chatMessages as $senderId => $messages) {
            if ($senderId > 0) { // Skip AI messages
                $activeChats[] = [
                    'user' => $messages->first()->sender,
                    'last_message' => $messages->first(),
                    'unread_count' => $messages->where('is_read', false)->count(),
                ];
            }
        }

        return view('admin.chat-console', compact('activeChats', 'department'));
    }

    public function sendMessage(Request $request, $department)
    {
        $user = Auth::user();

        // Check if user has access to this department
        if ($user->role !== 'superadmin' && $user->department !== $department) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
            'user_id' => 'required|integer', // ID of user being replied to
        ]);

        // Get the source from the last message in the conversation
        $lastMessage = ChatMessage::where(function ($q) use ($request) {
            $q->where('sender_id', $request->user_id)->where('receiver_id', Auth::id())
              ->orWhere('sender_id', Auth::id())->where('receiver_id', $request->user_id);
        })->orderBy('created_at', 'desc')->first();

        $source = $lastMessage ? $lastMessage->source : null;

        // Save admin message
        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->user_id,
            'message' => $request->message,
            'sender_type' => 'admin',
            'session_id' => session()->getId(),
            'source' => $source,
        ]);

        // Log the message
        Log::info('Admin Chat Message', [
            'admin_id' => Auth::id(),
            'user_id' => $request->user_id,
            'message' => $request->message,
            'department' => $department,
            'timestamp' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => $message]);
    }
}
