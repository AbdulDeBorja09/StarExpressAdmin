<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'management';
    protected $fillable = [
        'country',
        'branch',
        'position',
    ];
    use HasFactory;
}
