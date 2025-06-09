<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:F d, Y',
        'updated_at' => 'date:F d, Y',
    ];

    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'sid');
    }
}
