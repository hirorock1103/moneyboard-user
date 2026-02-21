<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <!-- CSS読み込み -->
        <link rel="stylesheet" href="{{ asset('css/common_style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home_base_style.css') }}">
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

        </header>

        <div class="contents">
            <div class="home-contents">
                <!-- サイドメニュー -->
                <!-- TODO: メニューの間の空白をあける（時間かかったのでいったん飛ばし） -->
                <div class="menu">
                    <div class="menu-items">
                         <!-- TODO: 遷移先仮です -->
                        <a href="{{ url('/home_top') }}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/my_page_top.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            マイページTOP
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/account_edit.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            登録情報の確認・変更
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/rep_edit.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            担当者情報の登録・変更・削除
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/company.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            登録企業の担当者変更・削除
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ url('/plan_confirmation') }}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/plan.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            プラン変更/使用会社数の増減
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/premium.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            スタンダードプラン
                                        </div>
                                        <div class="menu-item-subtitle">
                                            (顧客情報管理)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/mail.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            メールアドレスの変更
                                        </div>
                                        <div class="menu-item-subtitle">
                                            (管理者サイトログインID)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/password.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            パスワードの変更
                                        </div>
                                        <div class="menu-item-subtitle">
                                            (管理者サイトログインパス)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <!-- 下部メニュー -->
                    <div class="menu-items-f">
                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item-f">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/opinion.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            ご意見・ご要望
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item-f">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/hint.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            お問い合わせ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- TODO: 遷移先仮です -->
                        <a href="{{url('/index')}}">
                            <div class="menu-item-f">
                                <div class="menu-item-container">
                                    <img src="{{ asset('/images/home_base/logout.png') }}" class="menu-item-image">
                                    <div class="menu-item-titles">
                                        <div class="menu-item-title">
                                            ログアウト
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="main">
                    <!-- 各画面表示 -->
                    @yield('content')
                </div>
            </div>
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
                <div class="company-name">株式会社マネーボード</div>
                〒574-0042<br>
                大阪府大東市大野１丁目５番９号<br>
                
            </div>

        </footer>

    </body>

</html>
