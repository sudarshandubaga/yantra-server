<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Win extends Model
{
    protected $table   = "win";
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
    public function timeslot()
    {
        return $this->hasOne('App\Models\Timeslot', 'id', 'timeslot_id');
    }

    protected $appends = ['game_name', 'user_name', 'timeslot_time'];

    public function getGameNameAttribute()
    {
        return $this->game->name;
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getTimeslotTimeAttribute()
    {
        return $this->timeslot->time;
    }
}
