<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:F d, Y',
        'updated_at' => 'date:F d, Y',
    ];
}
