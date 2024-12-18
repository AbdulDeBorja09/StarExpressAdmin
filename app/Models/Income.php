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
        'submitted_by',
        'ammount',
    ];

    /**
     * Relationships
     */

    // Define the relationship to the CargoService model
    public function service()
    {
        return $this->belongsTo(CargoService::class, 'service_id');
    }

    // Define the relationship to the Branch model
    public function branch()
    {
        return $this->belongsTo(Branches::class, 'branch_id');
    }
}
