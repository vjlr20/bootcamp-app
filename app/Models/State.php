<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $hidden = [
        'status',
        'created_at',
        'updated_at',
    ];
}
