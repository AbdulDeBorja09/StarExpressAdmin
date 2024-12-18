<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAllowance extends Model
{
    protected $table = 'delivery_allowance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'branch_id',
        'driver_id',
        'delivery_id',
        'requested_by',
        'given_by',
        'received_by',
        'approved_by',
        'status',
        'allowance',
    ];

    /**
     * Relationships
     */


    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }


    public function driver()
    {
        return $this->belongsTo(TruckDriver::class, 'driver_id');
    }


    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    use HasFactory;
}
