<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/foo', function () {
    Artisan::call('passport:install');
    return 'clearede';
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'migrate';
});
Route::any('admin', function () {
    return false;
});

Route::get('/passport', function () {
    $exitCode = Artisan::call('passport:install');
    return 'clearede';
});

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin'], function () {
    // Route::get('', 'HomeController@index')->name('home');
    // Admin Routes
    Route::group(['middleware' => 'guest', 'namespace' => 'admin'], function () {
        Route::any('/', 'UserController@index')->name('admin_login');
        Route::post('main/checklogin', 'UserController@checklogin');
    });



    // Route::group(['middleware' => 'guest', 'namespace' => 'admin'], function () {
    //     Route::any('/', 'UserController@index')->name('admin_login');
    //     Route::post('main/checklogin', 'UserController@checklogin');
    // });



    Route::group(['middleware' => 'auth:admin', 'namespace' => 'admin'], function () {
        // Dashboard
        Route::get('home', 'DashboardController@index')->name('admin_home');

        // Timeslot
        Route::resource('timeslot', 'TimeslotController');
        Route::post('timeslot/edittime', 'TimeslotController@editstatus')->name('timeslot.edittime');
        Route::post('timeslot/delete', 'TimeslotController@destroyAll');
        Route::get('/timeslot/status/{id}', 'TimeslotController@change_status')->name('change_status');
        Route::post('/timeslot/switch-change', 'TimeslotController@editswitch')->name('change_switch');

        // Game
        Route::get('game?type=yantra', 'GameController@index');
        Route::get('game?type=city', 'GameController@index');
        Route::get('create?type=yantra', 'GameController@create');
        Route::get('create?type=city', 'GameController@create');
        Route::get('game/{id}/edit?type={type}', 'GameController@edit');
        Route::post('game/delete', 'GameController@destroyAll');
        Route::resource('game', 'GameController');

        // User 
        Route::resource('user', 'UsersController');
        Route::post('user/delete', 'UsersController@destroyAll');

        // Wallet 
        Route::resource('wallet', 'WalletController');
        Route::post('wallet/delete', 'WalletController@destroyAll');

        Route::get('placepoint/', 'WalletController@placePoint');

        // timeslote_schedule 
        Route::get('timeslot-winner/{game}', 'WinnerController@allot_winner');
        Route::get('ajax/current-timeslots', 'WinnerController@current_timeslot');
        Route::resource('timeslote_schedule', 'WinnerController');
        Route::post('timeslote_schedule/delete', 'WinnerController@destroyAll');

        // page 
        Route::resource('page', 'PagesController');
        Route::post('page/delete', 'PagesController@destroyAll');

        // Win
        Route::resource('winner', 'WinController');
        Route::get('win_history/', 'GameController@winHistory');
        Route::get('point_history/', 'WinController@pointHistory');


        // setting 
        Route::resource('setting', 'SettingController');

        Route::get('logout', 'UserController@logout')->name('admin_logout');
        Route::get('general-setting', 'SettingController@edit')->name('general_setting');
    });
});
