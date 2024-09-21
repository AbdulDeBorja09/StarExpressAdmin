<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoLocations extends Model
{
    protected $table = 'cargo_location';
    protected $fillable = [
        'country',
        'branch',
        'region',
        'areas',
    ];
    use HasFactory;
}
