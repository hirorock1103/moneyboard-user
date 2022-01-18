@extends('layouts.header_footer_layout')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/password_reset_complete_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                パスワード設定完了
            </div>
            <div class="heading-image inversion"></div>
        </div>

        パスワードの設定が完了いたしました。

        <div class="back-button">
            <div class="back-button-text">ログインする</div>
            <a href="{{url('/login')}}"></a>
        </div>
    </div>
</div>


@endsection
