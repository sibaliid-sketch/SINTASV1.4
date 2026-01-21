<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'source' => 'nullable|string',
        ]);

        // Save user message
        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => null, // For now, messages go to admin
            'message' => $request->message,
            'sender_type' => 'user',
            'session_id' => session()->getId(),
            'source' => $request->source,
        ]);

        // Simulate AI response (in future, this could be handled by admin or AI)
        // For now, create an AI response
        ChatMessage::create([
            'sender_id' => 0, // AI sender
            'receiver_id' => Auth::id(),
            'message' => 'Terima kasih atas pesan Anda. Admin akan segera merespons.',
            'sender_type' => 'ai',
            'session_id' => session()->getId(),
            'source' => $request->source,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    public function getMessages(Request $request)
    {
        $userId = Auth::id();
        $lastMessageId = $request->get('last_id', 0);

        $messages = ChatMessage::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->orWhere('receiver_id', $userId)
                  ->orWhere(function ($q) use ($userId) {
                      $q->where('sender_type', 'ai')->where('receiver_id', $userId);
                  });
        })
        ->where('id', '>', $lastMessageId)
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json([
            'messages' => $messages->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'sender_type' => $msg->sender_type,
                    'created_at' => $msg->created_at->format('H:i'),
                    'is_mine' => $msg->sender_id == Auth::id(),
                ];
            }),
        ]);
    }
}
