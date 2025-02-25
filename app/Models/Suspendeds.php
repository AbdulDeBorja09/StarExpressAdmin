<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspendeds extends Model
{

    protected $table = 'suspendeds';
    protected $fillable = [
        'branch_id',
        'user_id',
        'email',
        'user_type',
        'reason',
    ];
 
    use HasFactory;
}
