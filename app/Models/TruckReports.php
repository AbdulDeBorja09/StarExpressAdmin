<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class TruckReports extends Model
{
    protected $table = 'truck_report';
    protected $fillable = [
        'plate',
        'report',
        'urgent',
        'driver_id',
    ];
    public function driver()
    {
        return $this->belongsTo(TruckDriver::class, 'driver_id');
    }
    use HasFactory;
}
