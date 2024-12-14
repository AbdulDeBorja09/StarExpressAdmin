<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{

    protected $table = 'login_logs';
    protected $fillable = [
        'star_id',
        'ip_address',
        'user_agent',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
