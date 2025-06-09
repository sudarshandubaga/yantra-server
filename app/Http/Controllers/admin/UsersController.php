<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = User::orderBy('id', 'desc')->paginate(10);
        $page  = 'user.list';
        $title = 'User list';
        $data  = compact('lists', 'page', 'title');
        return view('admin.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $page  = "user.add";
        $title = "User Add";
        $roleArr = Role::select('id', 'name')->pluck('name', 'id');
        $data  = compact('page', 'title', 'request', 'roleArr');
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
        $rules = [
            'login'        => 'required',
            'password'     => 'required',
            'name'         => 'required',
            'email'        => 'required',
        ];


        $request->validate($rules);
        $input = $request->all();
        $obj = new User($input);

        $obj->save();

        return redirect(url('admin/user/'))->with('success', 'Success! New record has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $edit = User::findOrFail($user->id);
        $request->replace($edit->toArray());
        $request->flash();
        $page  = 'user.edit';
        $title = 'User Edit';
        $data  = compact('page', 'title', 'edit', 'request');

        // return data to view
        return view('admin.layout', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'login'        => 'required',
            'password'     => 'required',
            'name'         => 'required',
            'email'        => 'required',
        ];
        $messages = [
            'login.required'     => 'Please Enter Login.',
            'password.required'  => 'Please Enter Password.',
            'name.required'      => 'Please Enter Name.',
            'email.required'     => 'Please Enter Email.',
        ];
        $request->validate($rules);
        $obj =  User::findOrFail($user->id);
        $input = $request->all();

        $obj->update($input);

        return redirect(url('admin/user/'))->with('success', 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        User::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
