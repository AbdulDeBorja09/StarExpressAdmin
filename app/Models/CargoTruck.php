<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoTruck extends Model
{
    protected $table = 'cargo_truck';
    protected $fillable = [
        'branch',
        'driver_id',
        'model',
        'plate',
        'status',
        'condition',
        'note',
        'expiration',
    ];
    use HasFactory;
}
