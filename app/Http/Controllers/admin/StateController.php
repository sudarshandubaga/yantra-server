<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\State;

class StateController extends BaseController
{
    public function index(Request $request)
    {
        $lists = State::orderBy('id', 'desc')
            ->paginate(10);

        // set page and title ------------------
        $page  = 'state.add_state';
        $title = 'Add State';
        $data  = compact('page', 'title', 'lists');

        // return data to view
        return view('admin.layout', $data);
    }
    public function list()
    {
        $lists = State::orderBy('id', 'desc')
            ->paginate(10);

        // set page and title ------------------
        $page  = 'state.list';
        $title = 'State List';
        $data  = compact('page', 'title', 'lists');
        // return data to view
        return view('admin.layout', $data);
    }
    public function add(Request $request)
    {
        $rules = [
            'record'        => 'required|array',
            'record.name'  => 'required|string'
        ];

        $messages = [
            'record.sid.required'  => 'Please Select State.'
        ];

        $request->validate($rules, $messages);

        $record           = new State;
        $input            = $request->record;
        $input['slug']    = $input['slug'] == '' ? Str::slug($input['name'], '-') : $input['slug'];
        $record->fill($input);

        if ($record->save()) {
            return redirect(url('restaurent-control/state/list'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(url('restaurent-control/state/list'))->with('danger', 'Error! Something going wrong.');
        }
    }
    // edit record
    public function edit(Request $request, $id)
    {
        $edit     =  State::find($id);

        $editData =  ['record' => $edit->toArray()];

        $request->replace($editData);
        //send to view
        $request->flash();

        // set page and title ------------------
        $page = 'state.edit';
        $title = 'Edit State';
        $data = compact('page', 'title', 'id');
        // return data to view

        return view('admin.layout', $data);
    }
    public function update(Request $request, $id)
    {
        $record           = State::find($id);
        $input            = $request->record;
        $input['slug']    = $input['slug'] == '' ? Str::slug($input['name'], '-') : $input['slug'];
        $record->fill($input);
        if ($record->save()) {
            return redirect(url('restaurent-control/state/list'))->with('success', 'Success! Record has been edided');
        }
    }
    public function destroy(State $row)
    {
        $row->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        State::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
