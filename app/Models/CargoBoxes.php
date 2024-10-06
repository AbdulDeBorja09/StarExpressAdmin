<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branches;
use App\Models\CargoService;
use App\Models\CargoLocations;

class CargoBoxes extends Model
{

    protected $table = 'cargo_boxes';
    protected $fillable = [
        'branch_id',
        'service_id',
        'name',
        'note',
        'size',
        'image',
    ];

    public function prices()
    {
        return $this->hasMany(CargoPrices::class, 'box_id');
    }
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
