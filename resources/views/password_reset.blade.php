@extends('layouts.header_footer_layout')

@inject('validations', 'App\Http\Controllers\ValidationsController')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/password_reset_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                パスワードの設定
            </div>
            <div class="heading-image inversion"></div>
        </div>

        <div class="discription">新しく設定するパスワードを入力して下さい</div>

        
        {{ Form::open(['action' => ['AccountController@resetPassword'], 'method' => 'post']) }}
            {{ Form::token() }}<!--CSRFトークン-->

            <!-- パスワードの設定 -->
            <div class="items-container">
                <div class="item-heading-title-container">
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
                        <div class="item-content">
                            {{ Form::password('password') }}
                        </div>
                    </div>

                    <div class="item">
                        <div class="item-title title-long">パスワード　確認用</div>
                        <div class="item-content">
                            {{ Form::password('password_confirmation') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-container">
                @if(count($errors) > 0)
                    <div class="error-container">
                        {{ $validations->commonMsgs() }}
                    </div>
                @endif
                {{ Form::submit('登録') }}
            </div>
           
        {{ Form::close() }}

    </div>
</div>

@endsection
