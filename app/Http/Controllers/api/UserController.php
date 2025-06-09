<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function edit_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname'             => 'required|string|regex:/[A-Za-z ]+/',
            'lname'             => 'string|regex:/[A-Za-z ]*/',
            'email'             => 'email',
            'name'             => 'required|string|regex:/[A-Za-z ]+/'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {

            $info = User::where('id', request('id'))->first();
            // dd($info);

            $ID  =  $info->id;
            $lists         = User::find($ID);

            $input = $request->all();
            $details = $lists->fill($input)->save();

            $re = [
                'status'    => true,
                'message'   => 'Success! Information has been updated.',
                'data'      =>  $lists
            ];
        }
        return response()->json($re);
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:8|same:new_password',
            'confirm_password' => 'required|string|min:8|same:new_password'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {

            $info = User::where('id', request('id'))->first();
            $password  =  $info->password;

            if (Hash::check($request->current_password, $password)) {

                $ID  =  $info->id;
                $lists         = User::find($ID);

                $new_password = Hash::make($request->new_password);

                $details = $lists->fill(['password' => $new_password])->save();

                $re = [
                    'status'    => true,
                    'message'   => 'Success! Password has been updated.',
                    'data'      =>  $lists
                ];
            } else {

                $re = [
                    'status'    => false,
                    'message'   => 'Error! Current password not match.'
                ];
            }
        }
        return response()->json($re);
    }
}
