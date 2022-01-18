<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMailController extends Controller
{
    
    /**
    * sendMailForNewPassword
    *
    * パスワード再設定用のURLをメールで送る
    *
    * @param array    $request  ログイン情報
    *
    */
    public function sendMailForNewPassword(Request $request) {

        // TODO: とりあえず画面遷移のみ
        return view('password_reissue_email_send');

        $client = new Client();
        // TODO: URL本番用に変えて下さい！
        $res = $client->request('POST', 'http://localhost:8001/api/auth/login/', [
            'auth' => $request
        ]);

        print($res->getStatusCode());
    }
}
