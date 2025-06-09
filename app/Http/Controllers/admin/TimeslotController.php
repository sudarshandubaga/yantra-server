<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Timeslot::orderBy('id', 'desc')->paginate(10);
        $page  = 'timeslot.list';
        $title = 'Timeslote List';
        $data  = compact('page', 'title', 'lists');

        // return data to view
        return view('admin.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $rules = [
            'time'       =>  'required',
        ];

        $request->validate($rules);
        $input = $request->all();
        $obj = new Timeslot($input);

        $obj->save();

        return redirect(url('admin/timeslot/'))->with('success', 'Success! New record has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function show(Timeslot $timeslot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Timeslot $timeslot)
    {
        $edit = Timeslot::findOrFail($timeslot->id);
        $request->replace($edit->toArray());
        $request->flash();
        $page  = 'timeslot.edit';
        $title = 'Timeslote Edit';
        $data  = compact('page', 'title', 'edit');

        // return data to view
        return view('admin.layout', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timeslot $timeslot)
    {
        $rules = [
            'time'       =>  'required',
        ];

        $request->validate($rules);
        $obj =  Timeslot::findOrFail($timeslot->id);
        $input = $request->all();


        $obj->update($input);

        return redirect(url('admin/timeslot/'))->with('success', 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timeslot $timeslot)
    {
        $timeslot->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        Timeslot::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
