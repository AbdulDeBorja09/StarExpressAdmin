<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoService extends Model
{
    protected $table = 'cargo_services';
    protected $fillable = [
        'origin',
        'destination',
        'active',
    ];

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
