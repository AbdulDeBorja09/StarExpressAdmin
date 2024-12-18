<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'star_expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'category',
        'reference',
        'approved_by',
        'submitted_by',
        'status',
        'amount',
    ];

    /**
     * Relationships
     */

    // Define the relationship to the Branch model
    public function branch()
    {
        return $this->belongsTo(Branches::class);
    }
    public function manager()
    {
        return $this->belongsTo(User::class);
    }
}
