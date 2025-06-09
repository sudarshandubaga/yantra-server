<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Notification;

class NotificationController extends Controller
{
	public function index(Request $request)
	{
		$lists = Notification::where('uid', $request->uid)->latest()->get();

		if ($lists->isEmpty()) {
			$re = [
				'status' => false,
				'message'	=> 'No record(s) found.'
			];
		} else {
			$re = [
				'status' => true,
				'message'	=> $lists->count() . " records found.",
				'data'   => $lists
			];
		}

		return response()->json($re);
	}
}
