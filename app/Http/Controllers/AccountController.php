<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
    * resetPassword
    *
    * パスワード
    *
    * @param array    $request  ログイン情報
    *
    */
    public function resetPassword(Request $request) {

        // バリデーションチェック
        $validationC = app()->make('App\Http\Controllers\ValidationsController');
        $validator = $validationC->passwordReset($request);
        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // TODO: 新しいパスワードをDBに保存

        // TODO: 画面まだ仮です
        return view('password_reset_complete');

        // $client = new Client();
        // // TODO: URL本番用に変えて下さい！
        // $res = $client->request('POST', 'http://localhost:8001/api/auth/login/', [
        //     'auth' => $request
        // ]);

        // print($res->getStatusCode());

        // if($res->getStatusCode() ！= 200) {
        //     return redirect()->back();
        // }

        // echo $res->getHeader('content-type')[0];
        // // 'application/json; charset=utf8'
        // echo $res->getBody();
        // // {"type":"User"...'
        
        // return view('home');
    }
}
