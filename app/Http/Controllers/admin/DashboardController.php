<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Game;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Winner;


class DashboardController extends Controller
{
    public function index()
    {


        $page = 'dashboard';
        $title = 'Master Admin Dashboard ';
        $game  = Game::count();
        $user  = User::count();
        $wallet  = Wallet::count();
        $winner  = Winner::count();
        $city_game = Game::where('type', 'city')->count();
        $yantra_game = Game::where('type', 'yantra')->count();
        $data = compact('page', 'title', 'game', 'city_game', 'yantra_game', 'user', 'wallet', 'winner');

        return view('admin.layout', $data);
    }
}
