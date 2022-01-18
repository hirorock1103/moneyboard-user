@extends('layouts.home_base_layout')

@inject('plans', 'App\Http\Controllers\PlansController')

@section('content')

<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/plan_change_confirm_style.css') }}">

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

<!-- 変更後のプラン -->
<div class="main-container main-container-top">
    <div class="item-heading">
        <img src="{{ asset('/images/plan_change/money.png') }}" class="item-heading-icon">
        <div class="item-heading-title">
            変更後のプラン
        </div>
    </div>

    <div class="current-plans">
        <div class="current-plan">
            <div class="current-plan-heading">
                現在の料金プラン
            </div>
            <div class="current-plan-content">
                {{ Form::hidden('plan_id', $confirm["plan_id"], ['readonly']) }}
                {{ $plans->getPlanName($confirm["plan_id"]) }}
            </div>
        </div>
        <div class="current-plan">
            <div class="current-plan-heading">
                追加された現在のデータ
            </div>
            <div class="current-plan-content">
                <!-- TODO: DBから取得した値を表示 -->
                60社
            </div>
        </div>
    </div>

    <div class="item-heading">
        <div class="item-heading-title">
            <!-- TODO: DBから取得した値を表示 -->
            現在の月額料金<span>55,000</span>円
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
        </div>
        <div class="charge-item">
            <div class="charge-item-title"></div>
            <div class="charge-item-content">
                追加利用料金
            </div>
            <div class="charge-item-amount">
                1,100円
            </div>
        </div>
    </div>
</div>

<div class="change-button">
    <div class="change-button-text">変更</div>
    <a href="{{url('/plan_change')}}"></a>
 </div>


@endsection