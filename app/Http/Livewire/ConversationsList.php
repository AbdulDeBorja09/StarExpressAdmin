<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Conversation;

class ConversationsList extends Component
{
    public $conversations;
    public $selectedConversation;

    public function mount()
    {
        $this->conversations = Conversation::all();
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = $conversationId;
        $this->emit('conversationSelected', $conversationId);
    }

    public function render()
    {
        return view('livewire.conversations-list');
    }
}
