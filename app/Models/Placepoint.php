<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placepoint extends Model
{
    //
    protected $table   = "place_points";
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:F d, Y',
        'updated_at' => 'date:F d, Y',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function game()
    {
        return $this->hasOne('App\Game', 'id', 'game_id');
    }
    protected $appends = ['game_image'];

    public function getGameImageAttribute()
    {
        return $this->game ? url('imgs/game/' . $this->game->image) : "";
    }
}
