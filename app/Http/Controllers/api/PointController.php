<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\User;
use App\Models\Point;
use App\Models\PointApply;
use App\Models\MenuItem;
use App\Models\Setting;

class PointController extends Controller
{
    public function index(Request $request)
    {
        $lists = Point::where('uid', $request->user_id)->first();

        if (empty($list->id)) {
            $re = [
                'status' => false,
                'message'    => 'No record(s) found.'
            ];
        } else {
            $re = [
                'status' => true,
                'data'   => $lists
            ];
        }

        return response()->json($re);
    }

    public function checkpoint(Request $request)
    {
        $user = User::find($request->user_id);
        $point = Point::where('uid', $user->id)->first();
        $pointsetting = PointApply::find(1);
        if (!empty($point)) {
            $json = $request->cart;
            $cart = json_decode($json);

            $is_valid    = true;
            if ($point->point <= $pointsetting->max_points) {
                $is_valid = false;
                $re = [
                    'status'    => false,
                    'message'   => 'Points is lass then max uses point.'
                ];
            }

            if (!empty($pointsetting->min_cart_amount)) {
                $cart_total = 0;
                foreach ($cart as $pid => $c) {
                    $productInfo = MenuItem::find($c->pid);
                    $cart_total  += $productInfo->sale_price * $c->qty;
                }
                if ($cart_total < $pointsetting->min_cart_amount) {
                    $is_valid = false;
                    $re = [
                        'status'    => false,
                        'message'   => 'Point is not valid for cart amount.'
                    ];
                }
            }
            $cartProducts = [];
            $totalPrice   = 0;
            if (!empty($cart)) {
                foreach ($cart as $pid => $pData) {
                    $productInfo = \App\Models\MenuItem::with('media')->find($pid);
                    if (!empty($productInfo->id)) {
                        $productInfo->qty   = $pData['qty'];
                        $productInfo->is_jain_food   = $pData['is_jain_food'] ?? 0;
                        $cartProducts[]     = $productInfo;
                        $totalPrice        += $productInfo->sale_price * $pData['qty'];
                    }
                }
            }
            $setting     = Setting::findOrFail(1);

            if ($is_valid) {
                session()->put('point', $point);
                $cart_footer = view('frontend.template.cart_footer', compact('totalPrice', 'setting', 'cartProducts'))->render();
                $re = [
                    'status'    => true,
                    'message'   => 'Points used in cart.',
                    'cart_footer' => $cart_footer
                ];
            }
        } else {
            $re = [
                'status'    => false,
                'message'   => 'Points value is equal to 0.'
            ];
        }
        return response()->json($re, 200);
    }
}
