<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Win;
use App\Game;
use App\Models\Timeslot;
use Illuminate\Http\Request;

class WinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Win::with('user', 'game', 'timeslot')->orderBy('id', 'desc')->paginate(10);
        $page  = "win_list";
        $title = "Win List";
        $data  = compact('lists', 'page', 'title');

        return view('admin.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Win $winner)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Win  $winner
     * @return \Illuminate\Http\Response
     */
    public function show(Win $winner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Win  $winner
     * @return \Illuminate\Http\Response
     */
    public function edit(Win $winner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Win  $winner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Win $winner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Win  $winner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Win $winner)
    {
        $winner->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        Win::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
