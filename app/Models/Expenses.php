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
        'method',
        'plan',
        'amount',
        'submitted_by',
        'received_by',
        'confirm',
        'note',
        'status'
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
