<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Pages::orderBy('id', 'desc')->paginate(10);
        $page  = 'page.list';
        $title = 'Pages list';
        $data  = compact('lists', 'page', 'title');
        return view('admin.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page  = 'page.add';
        $title = 'Add pages';
        $data  = compact('page', 'title');
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
            'title'        => 'required',
            'description'        => 'required',
        ];


        $request->validate($rules);
        $input = $request->all();


        $obj = new Pages($input);
        $obj->slug = $request->slug == '' ? Str::slug($request->title) : Str::lower($request->slug);

        $obj->save();

        return redirect(url('admin/page'))->with('success', 'Success! New record has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages, $id, Request $request)
    {
        $edit = Pages::find($id);
        $request->replace($edit->toArray());
        $request->flash();
        $page  = 'page.edit';
        $title = 'Page Edit';
        $data  = compact('page', 'title', 'edit', 'request');

        // return data to view
        return view('admin.layout', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pages $pages, $id)
    {

        $rules = [
            'title'        => 'required',
            'description'        => 'required',
        ];


        $request->validate($rules);
        $obj = Pages::findOrFail($id);
        $obj->title = $request->title;
        $obj->slug = $request->slug == '' ? Str::slug($request->title) : Str::lower($request->slug);
        $obj->description = $request->description;
        $obj->update();

        return redirect(url('admin/page'))->with('success', 'Success! New record has been added.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pages $pages)
    {
        $pages->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {

        $ids = $request->sub_chk;
        // dd($ids);
        Pages::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
