<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    protected $fillable = [
        'driver_id',
        'manager_id',
        'truck_id',
        'trip_id',
        'date',
        'items',
        'status',
    ];
    public function driver()
    {
        return $this->belongsTo(TruckDriver::class, 'driver_id');
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    use HasFactory;
}
