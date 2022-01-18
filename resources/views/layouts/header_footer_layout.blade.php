<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <!-- CSS読み込み -->
        <link rel="stylesheet" href="{{ asset('css/common_style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/header_footer_style.css') }}">
        <!-- サイトタイトル -->
        <title>MoneyBoard</title>
    </head>

    <body>
        <header class="header">
            <div class="header-title-container">

            <a href="{{url('/')}}">
                <div class="app-logo-image"></div>
                <div class="header-title app-title-font">
                    MoneyBoard
                </div>
            </a>
                <div class="header-subtitle app-sub-title-font">Finance × Technology × Laboratory</div>

            </div>

            <div class="header-menu-container">
                <a class="login" href="{{url('/login')}}">ログイン</a>
                <div class="sign-up">
                    <div class="sign-up-text">新規登録</div>
                    <a href="{{url('/sign_up')}}"> </a>
                </div>
            </div>

        </header>

        <div class="contents">

        <!-- 各画面表示 -->
        @yield('content')

        </div>

        <footer class="footer">
            <div class="about-tool">

                <div class="footer-title-contaner">
                    <div class="footer-title">MoneyBoard</div>
                    <div class="footer-subtitle">Finance × Technology × Laboratory</div>
                </div>

                <div class="footer-menu-contaner">
                    <!-- TODO: リンク先が仮のままです -->
                    <a class="footer-link-text" href="{{url('/index')}}">プライバシーポリシー</a>
                    <a class="footer-link-text" href="{{url('/index')}}">利用規約</a>
                </div>

            </div>

            <div class="about-operating-company">
                [ 運営会社 ]<br>
                <div class="company-name">株式会社PPFパートナーズ</div>
                〒530-0041<br>
                大阪府大阪市北区天神橋1丁目7番17号 イケガミノースハウス4階<br>
                TEL : 06-6314-6685<br>
            </div>

        </footer>

    </body>

</html>
