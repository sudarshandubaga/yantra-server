<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? url('imgs/game/' . $this->image) : "";
    }
    public function place_point()
    {
        return $this->hasOne('App\Models\Placepoint', 'game_id', 'id');
    }
}
