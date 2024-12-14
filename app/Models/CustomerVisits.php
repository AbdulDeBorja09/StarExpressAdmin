<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerVisits extends Model
{
    protected $table = 'website_visits';
    protected $fillable = [
        'visitor_ip',
        'visited_at',
    ];
    use HasFactory;
}
