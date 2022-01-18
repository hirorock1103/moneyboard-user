<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// use App\Http\Requests\CustomFormRequest;
use GuzzleHttp\Client;

class LoginController extends Controller
{


    // public function getLogin() {
    //     return view('login');
    // }

    /**
    * login
    *
    * ログイン処理
    *
    * @param array    $request  ログイン情報
    *
    */
    public function login(Request $request) {

        return view('home_top');

        // バリデーションチェック
        $validationC = app()->make('App\Http\Controllers\ValidationsController');
        $validator = $validationC->login($request);
        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // TODO: 認証

        // TODO: データ取得

        // TODO: データをユーザトップ画面に渡す
//        return view('home_top');


        // $this->userService->createUser($request->all() != []);
        // return redirect()->back()->withErrors($validator)->withInput();

        // // TODO: とりあえず画面遷移のみ
        // return view('complete_send_mail');

        $client = new Client();
        // TODO: URL本番用に変えて下さい！
        $res = $client->request('POST', 'http://money-board-api.amb-dev.com/oauth/token', [

            'form_params' => [
                                'grant_type' => 'password',
                                'client_id' => '1',
                                'client_secret' => 'GE7IPCOoTvKMqkBZwQps78uZBjxF5YHvQkxtg3oc',
                                'username' => 'takenawa@ambi-tious.com',
                                'password' => 'Testpass1111',
                                'scope' => '*'
                            ]

        ]);

        print($res->getStatusCode());

        // if($res->getStatusCode() ！= 200) {
        //     return redirect()->back();
        // }
        //
        // echo $res->getHeader('content-type')[0];
        // // 'application/json; charset=utf8'
        // echo $res->getBody();
        // // {"type":"User"...'

        return view('home');
    }

}
