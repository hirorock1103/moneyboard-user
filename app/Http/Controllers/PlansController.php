<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
    * getPlanName
    *
    * 基本情報確認画面へ遷移
    *
    * @param Request    $request  変数の説明
    */
    function getPlanName(int $planId) {

        // TODO: DBからデータを抜き出し、plan_idで検索をかけて該当のプラン名を取得する
        // TODO: 今はまだ仮処理
        if ($planId == 0) {
            return 'ライトプラン';
        }
        
        return 'プレミアムプラン';
    }

    /**
    * getPlanData
    *
    * プラン変更・会社数変更画面の表示データ取得
    *
    * @param int    $company_id  会社ID
    */
    // function getPlanData(int $company_id) {
    function getPlanData() {

        // TODO: DBからデータを抜き出し、company_idで検索をかけて該当のデータを渡す
        // return view("change_plan", ["confirm" => $request]);
        return view('plan_confirmation');
    }


    /**
    * showPlanConfirm
    *
    * プラン変更・会社数変更画面の表示データ取得
    *
    * @param int    $company_id  会社ID
    */
    function showPlanConfirm(Request $request) {

        // バリデーションチェック
        $validationC = app()->make('App\Http\Controllers\ValidationsController');
        $validator = $validationC->changePlan($request);
        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // TODO: ここ画面変更
        return view("plan_confirmation", ["confirm" => $request]);
    }

}
