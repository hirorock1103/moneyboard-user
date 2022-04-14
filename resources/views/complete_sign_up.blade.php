@extends('layouts.header_footer_layout')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/complete_sign_up_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                メール送信完了
            </div>
            <div class="heading-image inversion"></div>
        </div>

        ご登録ありがとうございます。<br>
        登録されたメールアドレスとパスワードを使い「ログイン」ボタンからログインしてください。<br>

        <div class="back-button">
            <div class="back-button-text">ログインする</div>
            <a href="{{url('/login')}}"></a>
        </div>
    </div>
</div>


@endsection
