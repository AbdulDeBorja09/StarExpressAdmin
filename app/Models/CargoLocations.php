<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoLocations extends Model
{
    protected $table = 'cargo_location';
    protected $fillable = [
        'branch_id',
        'region',
        'areas',
    ];

    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }
    use HasFactory;
}
