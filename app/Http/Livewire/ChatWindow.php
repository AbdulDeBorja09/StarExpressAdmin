<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatWindow extends Component
{
    public $conversationId;
    public $messages;
    public $newMessage;

    protected $listeners = ['conversationSelected'];

    public function conversationSelected($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where('conversation_id', $this->conversationId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        if ($this->newMessage) {
            Message::create([
                'conversation_id' => $this->conversationId,
                'user_id' => Auth::user()->id,
                'message' => $this->newMessage,
            ]);
            $this->newMessage = '';
            $this->loadMessages();
        }
    }

    public function render()
    {
        return view('livewire.chat-window');
    }
}
