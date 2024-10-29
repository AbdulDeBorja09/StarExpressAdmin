<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'service_id',
        'reference_number',
        'items',
        'note',
        'sender_name',
        'sender_number',
        'sender_address',
        'receiver_name',
        'receiver_number',
        'receiver_address',
        'alternate_name',
        'alternate_number',
        'gov_id',
        'packing_list',
        'payment',
        'method',
        'voucher',
        'status',
        'state',
        'total',
    ];
    public function cargoService()
    {
        return $this->belongsTo(CargoService::class, 'service_id');
    }
    public function originBranch()
    {
        return $this->belongsTo(Branches::class, 'origin');
    }

    public function destinationBranch()
    {
        return $this->belongsTo(Branches::class, 'destination');
    }
    use HasFactory;
}
