<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Payment;
use App\User;
use Laravel\Cashier\Cashier;

class RegistrationController extends Controller
{

    // バリデーションチェッククラス
    // $validation = app()->make('App\Http\Controllers\ValidationsController');

    /**
    * baseInfo
    *
    * 基本情報入力画面へ遷移
    *
    * @param Request    $request  変数の説明
    */
    function baseInfo(Request $request) {

        //申込みフローで使用するセッションの初期化

        //必要な情報をセッションに保存
        session()->put('register_token', $request->input('token'));
        session()->put('register_mail_address', $request->input('mail_address'));

        // 登録画面に遷移
        return view('registration');
//        return view('registration',compact('token_hon','mail_address'));
    }

    /**
    * baseInfoConfirm
    *
    * 基本情報確認画面へ遷移
    *
    * @param Request    $request  変数の説明
    */
    function baseInfoConfirm(Request $request) {

        // バリデーションチェック
        $validationC = app()->make('App\Http\Controllers\ValidationsController');
        $validator = $validationC->registration($request);

        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //必要な情報をセッションに保存
        session()->put('register_company_name', $request->input('company_name'));
        session()->put('register_address', $request->input('address'));
        session()->put('register_phone_number', $request->input('phone_number'));
        session()->put('register_company_rep', $request->input('company_rep'));
        session()->put('register_mobile_number', $request->input('mobile_number'));
        session()->put('register_password', $request->input('password'));
        session()->put('register_plan_id', $request->input('plan_id'));
        session()->put('register_addtional_number_of_company', $request->input('addtional_number_of_company'));
        session()->put('register_motivated_by', $request->input('motivated_by'));
        session()->put('register_introducer', $request->input('introducer'));
        session()->put('register_other', $request->input('other'));

        return view("registration_confirm", ["confirm" => $request]);
    }

    /**
    * creditCardRegistration
    *
    * クレジットカード情報入力画面へ遷移
    *
    * @param Request    $request  変数の説明
    */
    function creditCardRegistration(Request $request) {
        // TODO: データをセッションに保存する

        return view("credit_card_registration");
    }

    /**
    * creditCardConfirm
    *
    * クレジットカード情報確認画面へ遷移
    *
    * @param Request    $request  変数の説明
    */
    function creditCardConfirm(Request $request) {

        // バリデーションチェック
        $validationC = app()->make('App\Http\Controllers\ValidationsController');
        $validator = $validationC->creditcardRegistration($request);
        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //クレカ情報をセッションに保存

        return view("credit_card_confirm", ["confirm" => $request]);
    }

    /**
    * showMailSendView
    *
    * クレカ情報を登録、画面遷移
    *
    * @param Request    $request  変数の説明
    */
    function showMailSendView(Request $request) {

        //クレカ情報
        $stripe_stripeToken = $request->input('stripeToken');
        $stripe_number = $request->input('number');
        $stripe_year   = $request->input('year');
        $stripe_month  = $request->input('month');
        $stripe_code   = $request->input('code');
        $stripe_name   = $request->input('name');
        $stripe_agree  = $request->input('agree');

        // TODO: Stripの顧客登録
        $stripe_info['name'] = $stripe_name;
        $stripe_info['description'] = '新規顧客登録';
        $result = Payment::setCustomer($stripe_stripeToken, $stripe_info);
        if(!$result){
            $errors = "カード登録に失敗しました。入力いただいた内容に相違がないかを確認いただき、問題ない場合は別のカードで登録を行ってみてください。";
            return redirect('/user/payment/form')->with('errors', $errors);
        }

        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        // // 会員登録
        // $ret = $stripe->customers->create([
        //     'name' => $register_company_name,
        //     'email' => $register_mail_address,
        //     'description' => '新規会員登録',
        // ]);
        // // クレカ登録
        // $stripe->customers->createSource(
        //   $ret->id,
        //   ['source' => 'tok_visa']
        // );


dd('カード登録');

        // TODO: Strip_idを含む基本情報をDBに保存しメール送信

        //基本情報
        $register_company_name = session()->get('register_company_name');
        $register_mail_address = session()->get('register_mail_address');
        $register_company_rep = session()->get('register_company_rep');
        $register_address = session()->get('register_address');
        $register_phone_number = session()->get('register_phone_number');
        $register_mobile_number = session()->get('register_mobile_number');
        $register_password = session()->get('register_password');
        $register_addtional_number_of_company = session()->get('register_addtional_number_of_company');
        $register_motivated_by = session()->get('register_motivated_by');

        $client = new Client();
        $res = $client->request('POST', 'http://money-board-api.amb-dev.com/api/user/register',
            [
                'headers' => [
                        'Register-Token' => $token,
                    ],
                'form_params' => [
                                    'email_address' => $register_mail_address,
                                    'company_name' =>  $register_company_name,
                                    'company_rep' =>  $register_company_rep,
                                    'address' =>  $register_address,
                                    'phone_number' =>  $register_phone_number,
                                    'mobile_number' =>  $register_mobile_number,
                                    'password' =>  $register_password,
                                    'app_password' =>  '',
                                    'additional_licenses' =>  '',
                                    'available_licenses_total' =>  $register_addtional_number_of_company,
                                    'motivated_by' =>  $register_motivated_by,
                                ]
            ]);

        //セッション情報を削除
//        $request->session()->flush();//メール送信完了画面でした方がいい？？

        // メール送信完了画面に遷移
        return view("complete_sign_up");
    }
}
