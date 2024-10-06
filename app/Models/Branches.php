<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'country',
        'branch',
    ];
    public function services()
    {
        return $this->hasMany(CargoService::class, 'origin_branch_id');
    }

    use HasFactory;
}
