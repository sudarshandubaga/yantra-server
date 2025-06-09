<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Intervention\Image\ImageManagerStatic as Image;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = Game::where('type', $request->type)->orderBy('id', 'desc')->paginate(10);
        $page  = 'game.list';
        $title = 'Game list';
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
        $page  = "game.add";
        $title = "Game Add";
        $data  = compact('page', 'title', 'request');
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
            'name'        => 'required',
        ];
        $messages = [
            'name.required'  => 'Please Enter Name.'
        ];

        $request->validate($rules);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image        = $request->file('image');
            $filename     = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(150, 175);
            $image_resize->save(public_path('imgs/game/' . $filename));
            $input['image']   = $filename;
        }
        $obj = new Game($input);

        $obj->save();

        return redirect(url('admin/game?type=' . $request->type))->with('success', 'Success! New record has been added.');
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
    public function edit(Request $request, Game $game)
    {

        $edit = Game::findOrFail($game->id);
        $request->replace($edit->toArray());
        $request->flash();
        $page  = 'game.edit';
        $title = 'Game Edit';
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
    public function update(Request $request, Game $game)
    {
        $rules = [
            'name'       =>  'required',
        ];

        $request->validate($rules);
        $obj =  Game::findOrFail($game->id);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image        = $request->file('image');
            $filename     = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(150, 175);
            $image_resize->save(public_path('imgs/game/' . $filename));
            $input['image']   = $filename;
        }


        $obj->update($input);

        return redirect(url('admin/game?type=' . $request->type))->with('success', 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        Game::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
}
