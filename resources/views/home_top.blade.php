@extends('layouts.home_base_layout')

@section('content')

<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/home_top_layout.css') }}">

<!-- 画面見出し -->
<div class="heading-container">
    <div class="heading-id">
        <!-- TODO: DBから受け取った値を表示 -->
        ID 0123456789
    </div>
    <div class="heading-company-info-container">
        <div class="heading-company-name">
            <!-- TODO: DBから受け取った値を表示 -->
            株式会社サンプルカンパニー
        </div>
        <div class="heading-remained">
            <div class="heading-remained-count">
                <!-- TODO: DBから受け取った値を表示 -->
                登録可能データ残り<span>12</span>件/120件
            </div>
        </div>
    </div>
</div>

<!-- アプリダウンドードについて -->
<div class="main-container main-container-top">
    <div class="item-heading">
        <img src="{{ asset('/images/top/qrcode.png') }}" class="item-heading-icon">
        <div class="item-heading-title">
            アプリダウンロードについて
        </div>
    </div>

    <div class="about-app">
        <!-- QRコード画像差し替え -->
        <img src="{{ asset('/images/top/app_qrcode.png') }}" class="about-app-qrcode">
        <div class="about-app-discription">
            iPadでQRコードを読み込んでいただくと、MoneyBoardアプリをダウンロード・インストールをすることができます。<br>
            1アカウントでの登録台数は無制限となっています。
        </div>
    </div>
</div>

<!-- お知らせ -->
<div class="main-container">
    <div class="item-heading news-header">
        <img src="{{ asset('/images/top/news.png') }}" class="item-heading-icon">
        <div class="item-heading-title">
            お知らせ
        </div>
    </div>

    <div class="news-container">
        <!-- TODO: 　ここforeachに変えて取得したデータを表示 -->
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
        <div class="news-item">
            <div class="date">2020/01/01</div>
            <div class="news-title">ニュースだよ</div>
        </div>
    </div>

</div>



@endsection
