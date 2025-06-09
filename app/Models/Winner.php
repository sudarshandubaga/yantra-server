<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    //
    protected $table   = "winner";
    protected $guarded = [];

    protected $appends = ['game_name'];

    public function getGameNameAttribute()
    {
        return $this->game->name;
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    public function timeslot()
    {
        return $this->hasOne('App\Models\Timeslot', 'id', 'timeslot_id');
    }
}
