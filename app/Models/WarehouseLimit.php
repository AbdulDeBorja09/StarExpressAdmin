<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseLimit extends Model
{
    use HasFactory;
    protected $table = 'warehouse_limit';
    protected $fillable = [
        'branch_id',
        'box_id',
        'limit',
    ];
}
