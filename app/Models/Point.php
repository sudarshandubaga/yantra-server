<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:F d, Y',
        'updated_at' => 'date:F d, Y',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'uid');
    }
}
