<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Placepoint;
use App\Game;
use App\Models\Wallet;
use App\Models\User;
// use Illuminate\Http\Request;
use App\Http\Requests\PlacepointRequest;
use App\Models\Timeslot;
use Validator;

class PlacepointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $re = Placepoint::get();
        return response()->json($re);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function game()
    {
        $re = Game::get();
        return response()->json($re);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlacepointRequest $request)
    {
        $datetime = time();

        $games = Game::get();

        $timeslots = Timeslot::orderBy('time')->get();

        $f_time = $f_date = $timeslot_time = "";
        $finish = false;

        foreach ($timeslots as $key => $tslot) {
            $time2 = strtotime(date("Y-m-d") . $tslot->time);

            // print_r([$datetime, $time2, $tslot->time]);
            if ($key == count($timeslots) && $time2 < $datetime) {
                $f_date = date("Y-m-d", strtotime("+1 day"));
                $f_time = $timeslots[0]->id;
                $timeslot_time = $timeslots[0]->time;
                $finish = true;
            } else if ($time2 > $datetime && !$finish) {
                $f_date = date("Y-m-d");
                $f_time = $timeslots[$key]->id;
                $timeslot_time = $timeslots[$key]->time;
                $finish = true;
            }
        }

        // dd($f_time);

        $game  = Game::findOrFail($request->game_id);
        $Total = Wallet::get_wallet_amt($request->user()->id);

        $check_data = Placepoint::where('game_id', $request->input('game_id'))->where('timeslot_id', $f_time)->count();


        if ($Total >= $request->point && $check_data == 0) {
            $remarks = $request->user()->name . ' has placed point for ' . $game->name . ' of ' . $game->type . ' for ' . date('Y-m-d') . ' ' . $timeslot_time;
            Placepoint::create([
                'user_id' => $request->user()->id,
                'point' => $request->input('point'),
                'game_id' => $request->input('game_id'),
                'timeslot_id' => $f_time,
                'date'     => $f_date,
                'remarks' => $remarks,
            ]);

            Wallet::create([
                'user_id'   => $request->user()->id,
                'amount'    => $request->input('point'),
                'remarks'   => $remarks,
                'type'      => 'debit',
            ]);

            $re = [
                'message' => 'success'
            ];
            return response()->json($re);
        } else {
            return response()->json([
                'message'   => 'Insufficient wallet amount Or You have already placed points.',
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Placepoint  $placepoint
     * @return \Illuminate\Http\Response
     */
    public function show(Placepoint $placepoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Placepoint  $placepoint
     * @return \Illuminate\Http\Response
     */
    public function update(PlacepointRequest $request, Placepoint $placepoint)
    {
        // $validator = Validator::make($request->all(), [
        //     'point'   => 'required',
        // ]);
        // if($validator->fails()){
        //     $re = [
        //         'status'  => false,
        //         'message' => 'Validator Error',
        //     ];
        // } else {
        $data = Placepoint::findOrFail($placepoint->id);
        $store = $request->all();
        if ($data->update($store)) {
            $re = [
                'status'  =>  true,
                'message' =>  'Added Successfully'
            ];
        } else {
            $re = [
                'status'  =>  false,
                'message' => 'Please try again'
            ];
        }
        // }
        return response()->json($re);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Placepoint  $placepoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Placepoint $placepoint)
    {
        if ($placepoint->delete()) {
            $re = [
                'status'  => true,
                'message' => 'Deleted Successfully'
            ];
        } else {
            $re = [
                'status'  => false,
                'message' => 'Please try again'
            ];
        }
        return response()->json($re);
    }
}
