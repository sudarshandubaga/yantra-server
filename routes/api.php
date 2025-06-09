<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['namespace' => 'App\Http\Controllers\api'], function () {
    Route::post('/login', 'LoginController@login');

    Route::get('/page/{slug}', 'PagesController@page');
    Route::post('/win', 'GameController@win_user');
    Route::get('/winhistory', 'GameController@winHistory');

    Route::get('/cron-game', 'GameController@cron_game');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/game/{type}', 'GameController@game');
        Route::post('/user_win_history', 'GameController@userwinHistory');
        Route::post('/user_wallet', 'GameController@userWallet');
        Route::post('/editprofile', 'LoginController@edit_profile');
        Route::post('/changepassword', 'LoginController@change_password');
        Route::post('/user_place_point', 'GameController@userPlacepoint');
        Route::resource('placepoint', 'PlacepointController');

        Route::get('/logout', 'LoginController@logout');
    });
});
