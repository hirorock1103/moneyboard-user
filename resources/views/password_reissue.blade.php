@extends('layouts.header_footer_layout')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/password_reissue_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                パスワードの再発行
            </div>
            <div class="heading-image inversion"></div>
        </div>

        <div class="discription">登録されているメールアドレスを入力して下さい</div>

        {{ Form::open(['action' => ['SendMailController@sendMailForNewPassword'], 'method' => 'post']) }}
            {{ Form::token() }}<!--CSRFトークン-->

            <!-- メールアドレス -->
            <div class="items-container">

                <div class="item-heading">
                    <img src="{{ asset('/images/login/email_address.png') }}">
                    <div class="item-heading-title">メールアドレス</div>
                </div>

                {{ Form::email('email') }}
                {{ Form::submit('メール送信') }}
            </div>

        {{ Form::close() }}

    </div>
</div>


@endsection
