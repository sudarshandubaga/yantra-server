<?php

namespace App\Http\Controllers\api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Mail;

use App\Models\Media;
use App\Models\Setting;

class MailController extends BaseController
{

    public function send(Request $request)
    {
        $setting = Setting::find(1);

        $subject = "New Contact Enquiry at " . $setting->site_title;
        $email_params = [
            'to'        => $setting->email,
            'reciever'  => $setting->site_title,
            'from'      => $request->email,
            'sender'    => $request->name,
            'subject'   => $subject,
            'form_subject' => $request->subject,
            'mobile'    => $request->mobile,
            'msg'       => $request->message,
        ];

        Mail::send('email.contact', $email_params, function ($msgEmail) use ($email_params) {
            extract($email_params);

            $msgEmail->to($to, $reciever)
                ->subject($subject)
                ->from($from, $sender)
                ->replyTo($to, $reciever);
        });

        return response()->json(['message' => 'Mail is sent.'], 200);
    }
}
