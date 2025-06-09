<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Auth;

class UserController extends BaseController
{
    public function index()
    {
        $page = 'login';
        $title = 'Login  page';
        $data = compact('page', 'title');

        return view('admin.layout', $data);
    }
    public function checklogin(Request $request)
    {
        $rules = [
            "mobile"       => "required",
            "password"    => "required",
        ];
        $request->validate($rules);

        $user_data = array(
            'mobile'     => $request->mobile,
            'password'  => $request->password
        );
        $is_remembered = !empty($request->remember_me) ? true : false;

        if (Auth::guard('admin')->attempt($user_data, $is_remembered)) {
            return redirect(route('admin_home'));
        } else {
            // dd($request->all());
            return redirect()->back()->with('error', 'Credentials not matched.');
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin_login'));
    }
}
