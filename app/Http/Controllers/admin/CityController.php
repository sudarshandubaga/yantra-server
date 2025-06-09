<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\State;
use App\Models\City;

class CityController extends BaseController
{
    public function index(Request $request)
    {
        $lists = City::with('state')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // root category
        $state = State::get();

        $parentArr  = ['' => 'Select State'];
        if (!$state->isEmpty()) {
            foreach ($state as $mcat) {
                $parentArr[$mcat->id] = $mcat->name;
            }
        }

        // set page and title ------------------
        $page  = 'city.add_city';
        $title = 'Add City';
        $data  = compact('page', 'title', 'lists', 'parentArr');

        // return data to view
        return view('admin.layout', $data);
    }
    public function list()
    {
        $lists = City::orderBy('id', 'desc')
            ->paginate(10);

        // set page and title ------------------
        $page  = 'city.list';
        $title = 'City List';
        $data  = compact('page', 'title', 'lists');
        // return data to view
        return view('admin.layout', $data);
    }
    public function add(Request $request)
    {
        $rules = [
            'record'        => 'required|array',
            'record.name'  => 'required|string',
            'record.sid'  => 'required'
        ];

        $messages = [
            'record.sid.required'  => 'Please Select State.',
            'record.name.required'  => 'Please Enter City.'
        ];

        $request->validate($rules, $messages);

        $record           = new City;
        $input            = $request->record;
        $input['slug']    = $input['slug'] == '' ? Str::slug($input['name'], '-') : $input['slug'];
        $record->fill($input);

        if ($record->save()) {
            return redirect(url('restaurent-control/city/list'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(url('restaurent-control/city/list'))->with('danger', 'Error! Something going wrong.');
        }
    }
    // edit record
    public function edit(Request $request, $id)
    {
        $edit     =  City::with(['state'])->find($id);

        $editData =  ['record' => $edit->toArray()];

        $request->replace($editData);
        //send to view
        $request->flash();


        $state = State::get();

        $parentArr  = ['' => 'Select State'];
        if (!$state->isEmpty()) {
            foreach ($state as $mcat) {
                $parentArr[$mcat->id] = $mcat->name;
            }
        }

        // set page and title ------------------
        $page = 'city.edit';
        $title = 'Edit City';
        $data = compact('page', 'title', 'parentArr', 'id');
        // return data to view

        return view('admin.layout', $data);
    }
    public function update(Request $request, $id)
    {
        $record           = City::find($id);
        $input            = $request->record;
        $input['slug']    = $input['slug'] == '' ? Str::slug($input['name'], '-') : $input['slug'];
        $record->fill($input);
        if ($record->save()) {
            return redirect(url('restaurent-control/city/list'))->with('success', 'Success! Record has been edided');
        }
    }
    public function destroy(City $row)
    {
        $row->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        City::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
