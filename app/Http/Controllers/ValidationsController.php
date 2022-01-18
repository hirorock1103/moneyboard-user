<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class ValidationsController extends Controller
{

    /** 共通エラーメッセージ */
    function commonMsgs() {
        return '入力に誤りがあります';
    }


    /**
    * login
    *
    * ログイン用バリデーションデータ
    *
    * @param array $request  ログイン情報
    *
    */
    function login(Request $request) {
        $rulus = [
            'email_address' => 'required|email',
            'password' => 'required|min:8',
        ];

        $messages = [];

        return Validator::make($request->all(), $rulus, $messages);
    }

    /**
    * registration
    *
    * 新規登録情報入力項目用バリデーションデータ
    *
    * @param array $request  入力情報
    *
    */
    function registration(Request $request) {
        $rulus = [
            'company_name' => 'required|max:50',
            'address' => 'required|max:200',
            'phone_number' => 'required|max:10',
            'company_rep' => 'required|max:50',
            'mobile_number' => 'required|max:11',
            'email_address' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'plan_id' => 'required|numeric|max:1',
            'addtional_number_of_company' => 'required|numeric',
            'motivated_by' => 'required|max:500',

            // TODO: 今後名前変わるかも知らん 処理も保留
            'introducer' => 'max:500',
            'other' => 'max:500',
        ];

        $messages = [];

        return Validator::make($request->all(), $rulus, $messages);
    }


    /**
    * creditcardRegistration
    *
    * クレジットカード情報入力項目用バリデーションデータ
    *
    * @param array $request  入力情報
    *
    */
    function creditcardRegistration(Request $request) {
        $rulus = [
            'number' => 'required',
            'year' => 'required',
            'month' => 'required|min:1|max:12',
            'code' => 'required|max:4',
            'name' => 'required',
        ];

        $messages = [];

        return Validator::make($request->all(), $rulus, $messages);
    }

    /**
    * passwordReset
    *
    * パスワードリセットチェックバリデーション
    *
    * @param array $request  入力情報
    *
    */
    function passwordReset(Request $request) {
        $rulus = [
            'password' => 'required|min:8|confirmed',
        ];

        $messages = [];

        return Validator::make($request->all(), $rulus, $messages);
    }

    /**
    * changePlan
    *
    * プラン変更用バリデーションデータ
    *
    * @param array $request  入力情報
    *
    */
    function changePlan(Request $request) {
        $rulus = [
            'plan_id' => 'required|numeric|max:1',
            'addtional_number_of_company' => 'required|numeric',
        ];

        $messages = [];

        return Validator::make($request->all(), $rulus, $messages);
    }
}
