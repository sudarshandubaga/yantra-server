<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\EditprofileRequest;
use App\Http\Requests\ChangepasswordRequest;
use Intervention\Image\ImageManagerStatic as Image;
// use Hash;
// use Validator;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required',
            'password'      => 'required'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            // Check if mobile number exists or not
            $user = User::where('mobile', request('mobile'))->first();

            if (!empty($user->id)) {

                $credentials = $request->only('mobile', 'password');

                $remember    = !empty($request->remember) ? true : false;

                if (Auth::attempt($credentials, $remember)) {
                    $user = Auth::user();


                    // $input = [
                    //     'device_type'   => request('device_type'),
                    //     'device_id'     => request('device_id'),
                    //     'fcm_id'        => request('fcm_id')
                    // ];

                    // $user->fill($input)->save();
                    // dd($user);
                    // $token  = $user->createToken('multi-vender')->accessToken;
                    $token = $user->createToken('Yantra-Game')->accessToken;

                    if ($user->email_verified == 'true') {
                        $re = [
                            'status'    => true,
                            'email_verify' => true,
                            'message'   => 'Success!! Login successfully.',
                            'data'      => $user,
                            'token'     => $token,
                        ];
                    } else {
                        $re = [
                            'status'    => true,
                            'email_verify' => false,
                            'message'   => 'Success!! Login successfully.',
                            'data'      => $user,
                            'token'     => $token,
                        ];
                    }
                } else {
                    $re = [
                        'status'    => false,
                        'message'   => 'Error!! Credentials not matched.',
                    ];
                }
            } else {
                $re = [
                    'status'    => false,
                    'message'   => 'Error!! Credentials not matched.',
                ];
            }
        }
        return response()->json($re);
    }

    public function forgotpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile'           => 'required|string|regex:/\d{10}/',
            'new_password'     => 'required|string|min:6|same:new_password',
            'confirm_password' => 'required|string|min:6|same:new_password'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user = User::where('mobile', request('mobile'))->first();

            $new_password = Hash::make($request->new_password);
            $user = $user->fill(['password' => $new_password])->save();

            $re = [
                'status'    => true,
                'message'   => 'Success! Password has been updated.',
            ];
        }
        return response()->json($re);
    }

    public function edit_profile(EditprofileRequest $request)
    {
        $input = $request->all();
        $user = auth()->user();
        if ($request->hasFile('image')) {
            $image        = $request->file('image');
            $filename     = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(150, 175);
            $image_resize->save(public_path('imgs/' . $filename));
            $input['image']   = $filename;
        }
        if ($user->fill($input)->save()) {
            $re = [
                'message' =>  'Updated Successfully'
            ];
            return response()->json($re);
        } else {
            $re = [
                'message' => 'Please try again'
            ];
            return response()->json($re, 403);
        }
    }

    public function change_password(ChangepasswordRequest $request)
    {






        $input = $request->all();

        if (Auth::Check()) {

            $current_password = Auth::User()->password;
            if (password_verify($input['current_password'], $current_password)) {

                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = bcrypt($input['new_password']);
                $obj_user->save();
                // return response()->json(['success'=>'Password Changed Successfully'], $this-> successStatus); 

                $result = array();
                $result['status'] = 'success';
                $result['data'] = [];
                $result['msg'] = 'Password Changed Successfully';
                return response()->json($result);
            } else {
                $result = array();
                $result['status'] = 'failed';
                $result['data'] = [];
                $result['msg'] = 'Please enter correct current password';
                return response()->json($result, 200);
            }
        } else {
            $result = array();
            $result['status'] = 'failed';
            $result['data'] = [];
            $result['msg'] = 'Incorrect old Password';
            return response()->json($result, 200);
            //return response()->json(['error'=>'Incorrect old Password'], 200); 
        }
    }

    public function logout()
    {
        $user = auth()->user();
        // $user->device_id = '';
        $user->save();
        $re = [
            'status'    => true,
            'message'   => 'Success! You are logout successfully.',
        ];

        return response()->json($re);
    }
}
