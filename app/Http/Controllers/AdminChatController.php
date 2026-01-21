<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminChatController extends Controller
{
    public function index()
    {
        // Check if user is superadmin
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized access');
        }

        // Get all chat messages grouped by user
        $chatMessages = \App\Models\ChatMessage::with('sender')
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

        return view('admin.chat-console', compact('activeChats'));
    }

    public function sendMessage(Request $request)
    {
        // Check if user is superadmin
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
            'user_id' => 'required|integer', // ID of user being replied to
        ]);

        // Save admin message
        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->user_id,
            'message' => $request->message,
            'sender_type' => 'admin',
            'session_id' => session()->getId(),
        ]);

        // Log the message
        Log::info('Admin Chat Message', [
            'admin_id' => Auth::id(),
            'user_id' => $request->user_id,
            'message' => $request->message,
            'timestamp' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => $message]);
    }
}
