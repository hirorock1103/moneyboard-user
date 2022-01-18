<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller {


    public function getLogin() {
        return view('login');
    }

    /**
    * postLogin
    *
    * ログイン処理
    *
    * @param array    $request  ログイン情報
    *
    */
    public function postLogin(Request $request){
        $this->validate($request,[
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->route('index');
        }
        return redirect()->back();
    }
}
