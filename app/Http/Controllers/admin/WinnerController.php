<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Winner;
use App\Game;
use App\Models\Timeslot;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Winner::with('game', 'timeslot')->orderBy('id', 'desc')->paginate(10);
        $page  = "winner.list";
        $title = "Winner List";
        $data  = compact('lists', 'page', 'title');

        return view('admin.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Winner $winner)
    {
        $type = $request->type ?? "yantra";
        $date = $request->date ?? date('Y-m-d', time());

        $request->replace(compact('type', 'date'));
        $request->flash();

        $edit = [];
        $request->flash();

        $page  = "winner.add";
        $title = "Winner Add";
        $game  = Game::where('type', $request->type)->get();
        $gameArr = [
            ''  => 'Select Game'
        ];

        foreach ($game as $c) {
            $gameArr[$c->id] = $c->name;
        }
        $timeslot  = Timeslot::where('type', $request->type)->get();

        if (!$timeslot->isEmpty() && !empty($request->date) && !empty($request->type)) {
            foreach ($timeslot as $key => $tslot) {
                $winner = Winner::where('date', $request->date)->where('type', $request->type)->where('timeslot_id', $tslot->id)->first();
                $timeslot[$key]->game_id = $winner->game_id ?? "";
            }

            // dd($timeslot->toArray());
        }


        $data  = compact('page', 'title', 'gameArr', 'timeslot', 'request', 'edit');

        return view('admin.layout', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required'
        ]);
        foreach ($request->game as $timeslot_id => $game_id) {
            if ($game_id != '') {
                Winner::updateOrCreate([
                    'game_id' => $game_id,
                    'timeslot_id' => $timeslot_id,
                    'date'  => $request->date,
                    'type'  => $request->type
                ]);
            }
        }
        return redirect()->back()->with('success', 'Success! New record has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function show(Winner $winner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function edit(Winner $winner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Winner $winner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Winner $winner)
    {
        $winner->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        Winner::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
