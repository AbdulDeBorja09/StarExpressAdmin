<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'admin_messages';
    protected $fillable = ['conversation_id', 'from_user_id', 'to_user_id', 'text'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
