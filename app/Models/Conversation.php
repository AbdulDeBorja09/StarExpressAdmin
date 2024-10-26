<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_group'];

    // Relationship with messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relationship with users (participants)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
}
