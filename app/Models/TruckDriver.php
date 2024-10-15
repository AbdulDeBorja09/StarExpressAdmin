<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckDriver extends Model
{
    protected $table = 'drivers';
    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'position',
    ];
    use HasFactory;

    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }
}
