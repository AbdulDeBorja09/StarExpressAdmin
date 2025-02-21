<?php

namespace App\Http\Controllers;


use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class ChatController extends Controller
{

    public function chatpage2()
    {
        return view('chat.chat');
    }
    public function chatpage()
    {
        $messages = Message::latest()->take(20)->where('from_user_id', Auth::user()->id)
            ->orWhere('to_user_id', Auth::user()->id)->get()->reverse();

        return view('chat.chat', compact('messages'));
    }
    public function fetchMessages($conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);
        $messages = $conversation->messages;
        return response()->json($messages);
    }
    public function sendmsg(Request $request)
    {
        $message = Message::create([
            'conversation_id' => 1,
            'from_user_id' => Auth::id(),
            'to_user_id' => 2,
            'text' => $request->message,
        ]);

        return response()->json([
            'message' => $message,
        ]);
    }
}
