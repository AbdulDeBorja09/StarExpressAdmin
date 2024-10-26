<?php

namespace App\Http\Controllers;


use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function chatpage()
    {
        $userId = Auth::id();

        // Retrieve users for the chat, excluding the authenticated user
        $users = User::where('id', '!=', $userId)->get();
        $messages = Message::all();

        $me = Auth::user();
        return view('chat.chat', [
            'users' => $users,
            'userId' => $userId,
            'me' => $me,
            'messages' =>  $messages,
        ]);
    }

    /**
     * Retrieve messages for the selected user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($userId)
    {
        // Fetch messages between the authenticated user and the selected user
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', Auth::id());
        })->get();

        return response()->json($messages);
    }

    /**
     * Send a new message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);

        // Create a new message
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return response()->json($message, 201);
    }
}
