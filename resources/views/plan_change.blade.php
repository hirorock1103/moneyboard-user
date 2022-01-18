@extends('layouts.home_base_layout')

@inject('validations', 'App\Http\Controllers\ValidationsController')

@section('content')

<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/plan_change_style.css') }}">

<!-- 画面見出し -->
<div class="heading-container">
    <div class="heading-company-info-container">
        <div class="heading-company-name">
            プラン変更/使用会社数の増減
        </div>
        <div class="heading-remained">
            <div class="heading-remained-count">
                価格は全て税込み表記
            </div>
        </div>
    </div>
</div>

<!-- プランの変更 -->
<div class="main-container main-container-top">
    <div class="item-heading">
        <img src="{{ asset('/images/plan_change/money.png') }}" class="item-heading-icon">
        <div class="item-heading-title">
            プランの変更
        </div>
    </div>

    <!-- TODO: ここ変える -->
    {{ Form::open(['action' => ['PlansController@showPlanConfirm'], 'method' => 'post']) }}
    {{ Form::token() }}<!--CSRFトークン-->
        <div class="current-plans">
            <div class="current-plan">
                <div class="current-plan-heading">
                    料金プラン
                </div>
                <div class="current-plan-content">
                    {{ Form::radio('plan_id', 0, true, ['id' => 'standerd']) }}
                    <label for="standerd" class="radio">スタンダードプラン</label>
                    {{ Form::radio('plan_id', 1, false, ['id' => 'premium']) }}
                    <label for="premium" class="radio">プレミアムプラン</label>
                </div>
            </div>
            <div class="current-plan">
                <div class="current-plan-heading">
                    追加された現在のデータ
                </div>
                <div class="companies-count">
                    {{ Form::number('addtional_number_of_company') }}
                </div>
                <div class="companies-count-text">
                    社
                </div>
            </div>
        </div>

        <div class="item-heading">
            <div class="item-heading-title">
                <!-- TODO: 計算した値を表示 -->
                変更後の月額料金<span>55,000</span>円
            </div>
        </div>
        <!-- TODO: 計算する -->
        <div class="charge-items">
            <div class="charge-item">
                <div class="charge-item-title">
                    内訳
                </div>
                <div class="charge-item-content">
                    基本料金
                </div>
                <div class="charge-item-amount">
                    55,000円
                </div>
                <div class="charge-item-remark">
                    （システム使用料と登録データ60社分or120社分）
                </div>
            </div>
            <div class="charge-item">
                <div class="charge-item-title"></div>
                <div class="charge-item-content">
                    追加利用料金
                </div>
                <div class="charge-item-amount">
                    5,000円
                </div>
            </div>
        </div>
    </div>

    <!-- 表 -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>スタンダードプラン</th>
                    <th>プレミアムプラン</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>システム利用料金</td>
                    <!-- TODO: DBから取得した値を表示 -->
                    <td>55,000/月</td>
                    <td>132,000円/月</td>
                </tr>
                <tr>
                    <td>自社データ5期の比較</td>
                    <td>〇</td>
                    <td>〇</td>
                </tr>
                <tr>
                    <td>他社データ比較</td>
                    <td>〇</td>
                    <td>〇</td>
                </tr>
                <tr>
                    <td>財務指標評価</td>
                    <td>〇</td>
                    <td>〇</td>
                </tr>
                <tr>
                    <td>顧客管理ツール</td>
                    <td>―</td>
                    <td>〇</td>
                </tr>
                <tr>
                    <td>使用できる企業数</td>
                    <!-- TODO: DBから取得した値を表示 -->
                    <td>60社</td>
                    <td>120社</td>
                </tr>
                <tr>
                    <td>企業数の追加(1社あたり)</td>
                    <!-- TODO: DBから取得した値を表示 -->
                    <td>1,100円/月</td>
                    <td>1,100円/月</td>
                </tr>
                <tr>
                    <td>アプリ登録台数</td>
                    <td>無制限</td>
                    <td>無制限</td>
                </tr>
                <tr>
                    <td>担当者登録数</td>
                    <td>無制限</td>
                    <td>無制限</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="buttons">
        @if(count($errors) > 0)
            <div class="error-container">
                {{ $validations->commonMsgs() }}
            </div>
        @endif

        <div class="button-container">
            <button type="button" class="edit" onClick="history.back()">戻る</button>
            {{ Form::submit('確認画面') }}
        </div>
    </div>
{{ Form::close() }}


@endsection
