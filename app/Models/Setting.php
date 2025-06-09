<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //basic configuration
    protected $table    = "setting";
    protected $guarded  = [];

    protected $casts = [
        'schedule' => 'array'
    ];

    public function media()
    {
        return $this->hasOne('App\Models\Media', 'id', 'cid');
    }
}
