<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Placepoint;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Wallet::with('user')->orderBy('id', 'asc');


        if (!empty($request->user_id)) {
            $query->where('user_id', 'LIKE', '%' . $request->user_id . '%');
        }
        $lists = $query->paginate(20);

        $totalCredits = Wallet::where('type', 'credit')->sum('amount');

        $totalDebits = Wallet::where('type', 'debit')->sum('amount');
        $Total =  $totalCredits - $totalDebits;
        $page  = 'wallet.list';
        $title = 'Wallet list';
        $data  = compact('lists', 'page', 'title', 'totalCredits', 'totalDebits', 'Total', 'request');
        return view('admin.layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page  = "wallet.add";
        $title = "Wallet Add";
        $user  = User::get();
        $userArr = [
            ''  => 'Select User'
        ];

        foreach ($user as $c) {
            $userArr[$c->id] = $c->name;
        }
        $data  = compact('page', 'title', 'userArr');
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
            'user_id'       => 'required',
            'amount'        => 'required',
            'remarks'       => 'required',
        ];

        $request->validate($rules);
        $input = $request->all();
        $obj = new Wallet($input);

        $obj->save();

        return redirect(url('admin/wallet'))->with('success', 'Success! New record has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet, Request $request)
    {
        $edit = Wallet::findOrFail($wallet->id);
        $request->replace($edit->toArray());
        $request->flash();
        $user  = User::get();
        $userArr = [
            ''  => 'Select User'
        ];

        foreach ($user as $c) {
            $userArr[$c->id] = $c->name;
        }
        $page  = 'wallet.edit';
        $title = 'Wallet Edit';
        $data  = compact('page', 'title', 'edit', 'request', 'userArr');

        // return data to view
        return view('admin.layout', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        $rules = [
            'user_id'       => 'required',
            'amount'        => 'required',
            'remarks'       => 'required',
        ];

        $request->validate($rules);
        $obj =  Wallet::findOrFail($wallet->id);
        $input = $request->all();


        $obj->update($input);

        return redirect(url('admin/wallet'))->with('success', 'Success!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->sub_chk;
        // dd($ids);
        Wallet::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Success! Select record(s) have been deleted');
    }
    public function placePoint()
    {
        $lists = Placepoint::with('user')->with('game')->orderBy('id', 'desc')->paginate(10);

        // $wallet = Wallet::with('user')->paginate(10);

        // $lists = DB::table('users')
        //     ->join('wallet_credit', 'users.id', '=', 'wallet_credit.user_id')
        //     ->join('place_points', 'users.id', '=', 'place_points.user_id')
        //     ->join('game', 'place_points.game_id', '=', 'game.id')
        //     ->select('users.*','users.name as user_name', 'wallet_credit.*', 'place_points.*', 'game.*')
        //     ->paginate(10);


        $page  = 'wallet.point_list';
        $title = 'Point list';
        $data  = compact('lists', 'page', 'title');
        return view('admin.layout', $data);
    }
}
