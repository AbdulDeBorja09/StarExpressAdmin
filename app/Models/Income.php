<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $table = 'star_income';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'branch_id',
        'category',
        'reference',
        'method',
        'plan',
        'amount',
        'submitted_by',
        'received_by',
        'confirm',
        'note'
    ];

    /**
     * Relationships
     */


    public function service()
    {
        return $this->belongsTo(CargoService::class, 'service_id');
    }


    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }
}
