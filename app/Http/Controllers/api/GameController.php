<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Game;
use App\Models\Setting;
use App\Models\Timeslot;
use App\Models\Wallet;
use App\Models\Win;
use App\Models\Winner;
use App\Models\Placepoint;

class GameController extends Controller
{

    public function game($type)
    {
        $datetime = time();

        $games = Game::where('type', $type)->get();

        $timeslots = Timeslot::where('type', $type)->orderBy('time')->get();

        $f_time = $f_date = "";
        $finish = false;

        foreach ($timeslots as $key => $tslot) {
            $time2 = strtotime($tslot->time);

            if ($key == 0 && $time2 > $datetime) {
                $f_date = date("Y-m-d", strtotime("-1 day"));
                $f_time = $timeslots[count($timeslots) - 1]->id;
                $finish = true;
            } else if (!$finish) {
                $f_date = date("Y-m-d");

                if ($time2 < $datetime) {
                    $f_time = $timeslots[$key]->id;
                }
            }
        }

        $wins = Winner::where('type', $type)->where('date', $f_date)->where('timeslot_id', $f_time)->first();

        if (empty($wins->id)) {
            $game = Game::where('type', $type)->orderBy(\DB::raw('RAND()'))->first();

            // insert 
            $wins = new Winner();
            $wins->timeslot_id = $f_time;
            $wins->date        = $f_date;
            $wins->game_id     = $game->id;
            $wins->type        = $type;
            $wins->save();
        }
        $place_point = Placepoint::where('timeslot_id', $f_time)->where('game_id', $wins->game_id)->where('date', $f_date)->get();

        $setting = Setting::findOrFail(1);
        foreach ($place_point as $p) {
            $point = $p->point * $setting->return_point;
            $ab = Win::where('user_id', $p->user_id)->where('timeslot_id', $p->timeslot_id)->where('game_id', $p->game_id)->where('date', $f_date)->get();

            if ($ab->count() == 0) {
                $win_data = new Win();
                $win_data->user_id = $p->user_id;
                $win_data->game_id = $p->game_id;
                $win_data->timeslot_id = $p->timeslot_id;
                $win_data->point = $point;
                $win_data->date = $f_date;
                $win_data->save();



                $add_wallet = new Wallet();
                $add_wallet->user_id = $p->user_id;
                $add_wallet->amount  = $point;
                $add_wallet->remarks = ' Win point ' . $point;
                $add_wallet->type    = "credit";
                $add_wallet->save();
            }
        }




        $re = [
            'games'     => $games,
            'win_game'  => $wins
        ];
        return response()->json($re);
    }
    public function win_user(Request $request)
    {
        $re = Win::where('user_id', $request->user_id)->get();

        return response()->json($re);
    }
    public function winHistory(Request $request)
    {

        $datetime = time();

        $games = Game::get();

        $timeslots = Timeslot::orderBy('time')->get();

        $f_time = $f_date = "";
        $finish = false;

        foreach ($timeslots as $key => $tslot) {
            $time2 = strtotime($tslot->time);

            if ($key == 0 && $time2 > $datetime) {
                $f_date = date("Y-m-d", strtotime("-1 day"));
                $f_time = $timeslots[count($timeslots) - 1]->id;
                $finish = true;
            } else if (!$finish) {
                $f_date = date("Y-m-d");

                if ($time2 < $datetime) {
                    $f_time = $timeslots[$key]->id;
                }
            }
        }
        $wins = Win::where('user_id', auth()->user()->id)->get();


        $place_point = Placepoint::get();

        foreach ($place_point as $p) {
            foreach ($wins as $w) {
                if ($p->game_id == $w->game_id && $p->timeslot_id == $w->timeslot_id) {
                    $p->point   = $w->point;
                    $p->type = 'win';
                } else {
                    $p->type = 'lost';
                }
            }
        }


        $re = [
            'Win' => $place_point,

        ];

        return response()->json($re);
    }

    public function userWallet(Request $request)
    {
        $balance = 0;
        $totalCredits = Wallet::where('user_id', auth()->user()->id)->get();

        foreach ($totalCredits as $list) {
            if ($list->type == 'credit') {
                $balance += $list->amount;
            } else {
                $balance -= $list->amount;
            }
        }


        $re = [
            'place_point' => $totalCredits,
            'total' => $balance,
        ];
        return response()->json($re);
    }
}
