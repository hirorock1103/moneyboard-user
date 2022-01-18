@extends('layouts.header_footer_layout')

@inject('validations', 'App\Http\Controllers\ValidationsController')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/login_style.css') }}">

<div class="page">
    <div class="base-container"><div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
                <div class="heading-text">
                  ログイン
                </div>
            <div class="heading-image inversion"></div>
        </div>

        <div class="main-container">
            <div class="content">

                {{ Form::open(['action' => ['LoginController@login'], 'method' => 'post', 'novalidate']) }}
                {{ Form::token() }}<!--CSRFトークン-->
                    <div class="content-heading">
                        <img src="{{ asset('/images/login/email_address.png') }}">
                        <div class="content-heading-title">
                            メールアドレス
                        </div>
                    </div>
                    {{ Form::email('email_address') }}

                    <div class="content-heading">
                        <img src="{{ asset('/images/login/password.png') }}">
                        <div class="content-heading-title">
                            パスワード
                        </div>
                    </div>
                    {{ Form::password('password') }}

                    
                    @if(count($errors) > 0)
                        <div class="error-container">
                            {{ $validations->commonMsgs() }}
                        </div>
                    @endif
                    {{ Form::submit('ログイン') }}

                {{ Form::close() }}

                <a class="reset-password" href="{{url('/password_reissue')}}">パスワードを忘れた場合</a>
            </div>
        </div>
    </div>
    
</div>


@endsection
