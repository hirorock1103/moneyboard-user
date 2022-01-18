@extends('layouts.header_footer_layout')

@inject('plans', 'App\Http\Controllers\PlansController')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/registration_confirm_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                新規登録
            </div>
            <div class="heading-image inversion"></div>
        </div>

        <div class="discription">下記項目をすべてご記入ください</div>

        {{ Form::open(['action' => ['RegistrationController@creditCardRegistration'], 'method' => 'post']) }}
            {{ Form::token() }}<!--CSRFトークン-->

            <!-- 基本情報 -->
            <div class="items-container first-item">

                <div class="item-heading">
                    <img src="{{ asset('/images/registration/base_info.png') }}">
                    <div class="item-heading-title">基本情報</div>
                </div>

                <hr class="width-line">

                <div class="items">
                    <div class="item">
                        <div class="item-title">名前</div>
                        <div class="item-content">
                            <div class="common-font">
                                {{ $confirm["company_name"] }}
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">住所</div>
                        <div class="item-content">
                            <div class="common-font">
                                {{ $confirm["address"] }}
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">電話番号</div>
                        <div class="item-content">
                            <div class="common-font">
                                {{ $confirm["phone_number"] }}
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">担当者名</div>
                        <div class="item-content">
                            <div class="common-font">
                                {{ $confirm["company_rep"] }}
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">携帯番号</div>
                        <div class="item-content">
                            <div class="common-font">
                                {{ $confirm["mobile_number"] }}
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-title">メールアドレス</div>
                        <div class="item-content">
                            <div class="common-font">
                                {{ $confirm["email_address"] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- パスワードの設定 -->
            <div class="items-container">

                <div class="item-heading-title-container ">
                    <div class="item-heading">
                        <img src="{{ asset('/images/registration/base_info.png') }}">
                        <div class="item-heading-title">パスワードの設定</div>
                    </div>
                </div>

                <hr class="width-line">

                <div class="items">
                    <div class="item">
                        <div class="item-title title-long">パスワード</div>
                        <div class="item-content content-password">
                            <div class="common-font">
                                {{ Form::hidden('code', $confirm["password"], ['readonly']) }}
                                ********
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 料金について -->
            <div class="items-container">

                <div class="item-heading-title-container">
                    <div class="item-heading">
                        <img src="{{ asset('/images/registration/about_charges.png') }}">
                        <div class="item-heading-title">料金について</div>
                    </div>
                    <div class="item-heading-remark">
                        価格はすべて税込み表記
                    </div>
                </div>

                <hr class="width-line">

                <div class="about-charges-items">
                    <div class="item-title title-long">
                        プラン選択
                    </div>
                    <div class="about-charges-items-content">
                        <div class="common-font">
                            {{ Form::hidden('plan_id', $confirm["plan_id"], ['readonly']) }}
                            {{ $plans->getPlanName($confirm["plan_id"]) }}
                        </div>
                    </div>
                </div>

                <div class="about-charges-items">
                    <div class="item-title title-long">
                        企業データの追加
                    </div>
                    <div class="about-charges-items-content">
                        <div class="common-font">
                            {{ $confirm["addtional_number_of_company"] }}社
                        </div>
                    </div>
                </div>

                <div class="sum-charge-container">
                    <div class="sum-charge-text">
                        月額料金は
                    </div>
                    <!-- TODO: 計算する -->
                    <div class="sum-charge-text charge-text">56,100円</div>
                    <div class="sum-charge-text">
                        です
                    </div>
                </div>

                <hr class="width-line">

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
                            （システム使用料と登録データ60社分）
                        </div>
                    </div>

                    <div class="charge-item">
                        <div class="charge-item-title">

                        </div>
                        <div class="charge-item-content">
                            追加利用料金
                        </div>
                        <div class="charge-item-amount">
                            1,100円
                        </div>
                    </div>
                </div>
            </div>

            <!-- アンケート -->
            <div class="items-container">
                <div class="item-heading-title-container ">
                    <div class="item-heading">
                        <img src="{{ asset('/images/registration/question.png') }}">
                        <div class="item-heading-title">MoneyBoardを知ったきっかけを教えて下さい（任意）</div>
                    </div>
                </div>

                <hr class="width-line">

                <div class="items">
                    <div class="common-font">
                        {{ $confirm["motivated_by"] }}
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button type="button" class="edit" onClick="history.back()">内容修正</button>
                {{ Form::submit('登録') }}
            </div>

        {{ Form::close() }}

    </div>
</div>


@endsection
