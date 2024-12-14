<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $table = 'notifications';
    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
        'read'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'read' => 'boolean',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
