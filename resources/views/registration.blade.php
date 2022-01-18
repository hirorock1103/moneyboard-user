@extends('layouts.header_footer_layout')

@inject('validations', 'App\Http\Controllers\ValidationsController')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/registration_style.css') }}">

@php
$register_token = session()->get('register_token');
$register_mail_address = session()->get('register_mail_address');
@endphp

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

        <div class="submit-button-container">
            @if(count($errors) > 0)
                <div class="error-container">
                    {{ $validations->commonMsgs() }}
                    <ul style="list-style: none;text-align: left;">
                        @foreach ($errors->all() as $error)
                          <li style="color:red">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>



        {{ Form::open(['action' => ['RegistrationController@baseInfoConfirm'], 'method' => 'post']) }}
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
                            {{ Form::text('company_name') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">住所</div>
                        <div class="item-content">
                            {{ Form::text('address') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">電話番号</div>
                        <div class="item-content">
                            {{ Form::text('phone_number') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">担当者名</div>
                        <div class="item-content">
                            {{ Form::text('company_rep') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title">携帯番号</div>
                        <div class="item-content">
                            {{ Form::text('mobile_number') }}
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-title">メールアドレス</div>
                        <div class="item-content">
                            <!-- TODO: URLでデータ持ってくる -->
                            {{ Form::text('email_address', $register_mail_address, ['readonly']) }}
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
                    <div class="item-heading-remark">
                        10文字以上（半角アルファベット大文字、小文字、半角数字の３種類を組み合わせ）
                    </div>
                </div>

                <hr class="width-line">

                <div class="items">
                    <div class="item">
                        <div class="item-title title-long">パスワード</div>
                        <div class="item-content content-password">
                            {{ Form::password('password') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title title-long">パスワード　確認用</div>
                        <div class="item-content content-password">
                            {{ Form::password('password_confirmation') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 料金について -->
            <div class="items-container">

                <div class="item-heading-title-container ">
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
                        {{ Form::radio('plan_id', 0, true, ['id' => 'standerd']) }}
                        <label for="standerd" class="radio">スタンダードプラン</label>
                        {{ Form::radio('plan_id', 1, false, ['id' => 'premium']) }}
                        <label for="premium" class="radio">プレミアムプラン</label>
                    </div>
                </div>

                <div class="about-charges-items">
                    <div class="item-title title-long">
                        企業データの追加
                    </div>
                    <div class="about-charges-items-content">
                        <div class="companies-count">
                            {{ Form::number('addtional_number_of_company') }}
                        </div>
                        <div class="companies-count-text">
                            社
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

            <!-- プラン表 -->
            <div class="plan-list">
                 <div class="plan-list-items plan-list-heading">
                    <div class="plan-list-title"></div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">スタンダードプラン</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">プレミアムプラン</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">システム利用料金</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">55,000円/月</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">132,000円/月</div>
                    </div>
                </div>

                 <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">自社データ5期の比較</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">他社データ比較</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">財務指標評価</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">顧客管理ツール</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">―</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">〇</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">使用できる企業数</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">60社</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">120社</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">企業数の追加(1社あたり)</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">1,100円/月</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">1,100円/月</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">アプリ登録台数</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">無制限</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">無制限</div>
                    </div>
                </div>

                <div class="plan-list-items">
                    <div class="plan-list-title">
                        <div class="plan-list-title-text">担当者登録数</div>
                    </div>
                    <!-- DBからとってくる -->
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">無制限</div>
                    </div>
                    <div class="plan-list-plan">
                        <div class="plan-list-plan-text">無制限</div>
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

                <div class="radio-list-items">
                    <div class="radio-list">
                        {{ Form::radio('motivated_by', '弊社営業担当', true, ['id' => '1']) }}
                        <label for="1" class="radio">弊社営業担当</label>
                        {{ Form::radio('motivated_by', 'インターネット検索', false, ['id' => '2']) }}
                        <label for="2" class="radio">インターネット検索</label>
                        {{ Form::radio('motivated_by', 'リーフレット', false, ['id' => '3']) }}
                        <label for="3" class="radio">リーフレット</label>
                    </div>
                    <div class="radio-and-text">
                        <div class="radio-container">
                            {{ Form::radio('motivated_by', '紹介', false, ['id' => '4']) }}
                            <label for="4" class="radio">紹介</label>
                        </div>
                        <div class="radio-text-container">
                            <div class="radio-text">紹介者</div>
                            {{ Form::text('introducer') }}
                        </div>
                    </div>
                    <div class="radio-and-text">
                        <div class="radio-container radio-block-top">
                            {{ Form::radio('motivated_by', 'その他', false, ['id' => '5']) }}
                            <label for="5" class="radio">その他</label>
                        </div>
                        <div class="radio-text-container">
                            {{ Form::textarea('other', null, ['rows' => '6']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit-button-container">
                @if(count($errors) > 0)
                    <div class="error-container">
                        {{ $validations->commonMsgs() }}
                    </div>
                @endif
                {{ Form::submit('確認画面') }}
            </div>

        {{ Form::close() }}

    </div>
</div>


@endsection
