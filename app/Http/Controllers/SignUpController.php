<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SignUpController extends Controller
{

    /**
    * login
    *
    * ログイン処理
    *
    * @param array    $request  ログイン情報
    *
    */
    public function sendRegistrationMail(Request $request) {

        $email_address = $request->get('email_address');

        $client = new Client();
        $res = $client->request('POST', 'http://money-board-api.amb-dev.com/api/user/signup',
            [
                'form_params' => [
                                    'email_address' => $email_address,
                                ]

            ]);

            return view('complete_send_mail');

    }
}
