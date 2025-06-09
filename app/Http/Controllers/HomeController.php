<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;



class HomeController extends BaseController
{
    public function index()
    {
        
        return view('frontend.inc.homepage');
    }
    public function terms(){
        return view('frontend.inc.terms');
    }
}
