<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoPrices extends Model
{
    protected $table = 'cargo_prices';
    protected $fillable = [
        'box_id',
        'type',
        'area',
        'rate',
    ];

    public function Box()
    {
        return $this->belongsTo(CargoBoxes::class, 'box_id');
    }
    use HasFactory;
}
