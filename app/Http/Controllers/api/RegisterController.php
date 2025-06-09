<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Support\Facades\Auth;

use App\Models\Setting;
use App\Models\Point;
use App\Models\User;

use Hash;

class RegisterController extends Controller
{
    protected function referalcode($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname'             => 'required|string|regex:/[A-Za-z ]+/',
            'lname'             => 'string|regex:/[A-Za-z ]*/',
            'mobile'            => 'required|string|regex:/\d{10}/',
            'email'             => 'email',
            'password'          => 'required|string|same:password',
            'confirm_password'  => 'required|string|same:password',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {

            $UserData =  User::where('mobile', $request->mobile)->first();

            $check  =  User::where('mobile', $request->mobile)->get()->count();
            if ($request->accept_code) {
                $referalcode_check =  User::where('referal_code', $request->accept_code)->get()->count();
            } else {
                $referalcode_check  =   1;
            }

            $fname = strtoupper(substr($request->fname, 0, 3));

            if ($check == 0) {
                $dataArr = [
                    'fname'    => request('fname'),
                    'lname'    => request('lname'),
                    'name'     => trim(request('fname') . ' ' . request('lname')),
                    'email'    => request('email'),
                    'mobile'   => request('mobile'),
                    'login'    => request('mobile'),
                    'password' => Hash::make(request('password')),
                    'is_verified'  => 'Y',
                    'device_id' => request('device_id'),
                    'device_type' => request('device_type'),
                    'fcm_id'    => request('fcm_id'),
                    'google_id'    => request('google_id'),
                    'fb_id'    => request('fb_id'),
                    'social_type'    => request('social_type'),
                    'role'     => '3',
                    'accept_code'  => $request->accept_code,
                    'referal_code' => trim($fname . '' . $this->referalcode())
                ];
                if ($referalcode_check != 0) {
                    $newUser    = User::create($dataArr);
                    $setting = Setting::find(1);

                    if ($newUser->accept_code != '') {
                        $point          =   new Point;
                        $point->point   =   $setting->accept_point;
                        $point->uid     =   $newUser->id;
                        $point->save();

                        $user_check = User::where('referal_code', $newUser->accept_code)->first();
                        $user_point = Point::where('uid', $user_check->id)->first();
                        if (!empty($user_point)) {
                            $user_point->point = $user_point->point + $setting->invite_point;
                            $user_point->save();
                        } else {
                            $point          =   new Point;
                            $point->point   =   $setting->invite_point;
                            $point->uid     =   $newUser->id;
                            $point->save();
                        }
                    }

                    $token      = $newUser->createToken('cityfoods')->accessToken;

                    $re = [
                        'status'    => true,
                        'message'   => 'Success!! Registration successful.',
                        'user_details' => $newUser,
                        'token'     => $token
                    ];
                } else {
                    $re = [
                        'status'    => false,
                        'message'   => 'Referal Code not valid.',
                    ];
                }
            } else {

                $re = [
                    'status'    => false,
                    'message'   => 'Mobile number already exists.',
                    'user_details' => $UserData
                ];
            }
        }
        return response()->json($re);
    }

    public function sendOtp(Request $request)
    {
        $setting = Setting::find(1);
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|numeric|regex:/\d{10}/',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $otp        = rand(100000, 999999);

            // Send SMS
            $msg    = urlencode("Your one time password in " . $setting->site_title . " is " . $otp . " ");

            $apiUrl = str_replace(["[message]", "[number]"], [$msg, request('mobile')], $setting->sms_api);

            $sms    = file_get_contents($apiUrl);

            $re = [
                'status'    => true,
                'message'       => 'OTP has been sent to ' . request('mobile'),
                'mobile_no'  => request('mobile'),
                'otp_code'  => $otp
            ];
        }
        return response()->json($re);
    }
    public function verifyOtp(Request $request)
    {
        $OTP = request('otp_code');
        $mobile = request('mobile_no');

        if ($OTP == request('otp')) {

            $UserData =  User::where('mobile', $mobile)->get();

            $obj =  User::where('mobile', $mobile)->first();
            $obj->is_verified  = 'Y';
            $obj->save();

            $re = [
                'status'    => true,
                'is_verified'    => true,
                'message'       => 'Success!!  Account verified. Please login.',
                'user_details' => $UserData
            ];
        } else {
            $re = [
                'status'    => false,
                'message'       => 'Error!!  OTP not match.'
            ];
        }
        return response()->json($re);
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

            $info = User::where('mobile', request('mobile'))->first();
            $password  =  $info->password;

            $ID  =  $info->id;
            $lists         = User::find($ID);

            $new_password = Hash::make($request->new_password);

            $details = $lists->fill(['password' => $new_password])->save();

            $re = [
                'status'    => true,
                'message'   => 'Success! Password has been updated.',
                'data'      =>  $lists
            ];
        }
        return response()->json($re);
    }
}
