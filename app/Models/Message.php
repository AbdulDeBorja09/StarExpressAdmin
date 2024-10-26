<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'user_id', 'message'];

    // Relationship with the user who sent the message
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the conversation the message belongs to
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
