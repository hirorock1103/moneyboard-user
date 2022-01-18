@extends('layouts.header_footer_layout')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/complete_send_mail_style.css') }}">

<div class="base-container ver-white">
    <div class="draw-contents">
        <div class="heading">
            <div class="heading-image"></div>
            <div class="heading-text">
                メール送信完了
            </div>
            <div class="heading-image inversion"></div>
        </div>

        メールが送信されました。メールのURLから登録手続きをお願いします。

        <div class="back-button">
            <div class="back-button-text">戻る</div>
            <a href="{{url('/')}}"></a>
        </div>
    </div>
</div>


@endsection
