<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branches;
use App\Models\CargoService;
use App\Models\CargoLocations;

class CargoPrices extends Model
{

    protected $table = 'cargo_prices';
    protected $fillable = [
        'branch_id',
        'service_id',
        'area',
        'name',
        'size',
        'type',
        'rate',
        'image',
    ];

    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }
    public function service()
    {
        return $this->belongsTo(CargoService::class, 'service_id');
    }


    use HasFactory;
}
