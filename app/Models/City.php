<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = [
        'state_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
