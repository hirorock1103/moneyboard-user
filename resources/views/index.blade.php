@extends('layouts.header_footer_layout')

@section('content')
<!-- CSS読み込み -->
<link rel="stylesheet" href="{{ asset('css/index_style.css') }}">


<!-- トップ概要 -->
<div class="page">
    <div class="top-container">
        <div class="top-items">
            <div class="top-instruction">
                <div class="top-instruction-contents">

                    <div class="top-instruction-method-title-container">
                        <div class="top-instruction-method-title-image"></div>
                        <div class="top-instruction-method-title top-instruction-normal">
                            営業サポート型
                        </div>
                        <div class="top-instruction-method-title-image reverce-image"></div>
                    </div>

                    <div class="top-instruction-tool">
                        財務ビジュアルツール
                    </div>
                    <div class="top-instruction-title-container">
                        <div class="app-logo-image for-top-image"></div>
                        <div class="top-instruction-title app-title-font">
                            MoneyBoard
                        </div>
                    </div>

                    <hr class="instruction-line">

                    <div class="point-container">
                        <div class="top-instruction-point point-heading-font fc-orange fs-30px">
                            Point!
                        </div>
                        <div class="point-container-contents">
                            <div class="point-heading-container">
                                <div class="point-heading-image"></div>
                                <div class="top-instruction-heading">
                                    営業担当者
                                </div>
                            </div>
                            <div class="top-instruction-normal point-contents-text">
                                顧客とともに財務状況を把握し、現状に合った提案ができる！
                            </div>
                        </div>
                    </div>
                    <div class="point-container">
                        <div class="top-instruction-point point-heading-font fc-orange fs-30px">
                            Point!
                        </div>
                        <div class="point-container-contents">
                            <div class="point-heading-container">
                                <div class="point-heading-image point-heading-image-second"></div>
                                <div class="top-instruction-heading">
                                    顧客・見込み客
                                </div>
                            </div>
                            <div class="top-instruction-normal point-contents-text">
                                財務状況をビジュアル化して経営に活用できる！
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-image"></div>
        </div>
    </div>


    <!-- お悩み一覧 -->
    <div class="base-container for-top ver-gray">
        <div class="draw-contents">
            <div class="problem-list-item">
                <div class="problem-heading-container">
                    <div class="problem-heading-text">こんな<span>悩み</span>はないですか？</div>
                    <div class="problem-heading-image"></div>
                </div>
                <div class="problem-items-container">
                    <div class="problem-item-container">
                        <div class="base-text text-underline-n">
                            新規顧客がなかなか増えない
                        </div>
                        <div class="problem-item-image"></div>
                    </div>
                    <div class="problem-item-container">
                        <div class="base-text text-underline-n">
                            顧客との間に壁を感じる
                        </div>
                        <div class="problem-item-image"></div>
                    </div>
                    <div class="problem-item-container">
                        <div class="base-text text-underline-n">
                            顧客との話がマンネリ化
                        </div>
                        <div class="problem-item-image"></div>
                    </div>
                </div>
            </div>

            <div class="problem-solution-arrow">
                <img src="{{ asset('/images/index/arrow_image.png') }}">
            </div>

            <div class="problem-list-item">
                <div class="problem-heading-container">
                    <div class="problem-heading-text"><span>MoneyBoard</span>を導入すると</div>
                    <div class="problem-heading-image problem-heading-image-second"></div>
                </div>
                <div class="problem-items-container">
                    <div class="problem-item-container">
                        <div class="base-text text-underline-p">
                            ドアノックツールに！
                        </div>
                        <div class="problem-item-image problem-item-image-second"></div>
                    </div>
                    <div class="problem-item-container">
                        <div class="base-text text-underline-p">
                            財務状況を共有し、信頼関係を築ける！
                        </div>
                        <div class="problem-item-image problem-item-image-second"></div>
                    </div>
                    <div class="problem-item-container">
                        <div class="base-text text-underline-p">
                            定期的な話題ができる！
                        </div>
                        <div class="problem-item-image problem-item-image-second"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MoneyBoardについて -->
    <div class="base-container for-top">
        <div class="draw-contents">
            <div class="heading heading-for-top">
                <div class="heading-image"></div>
                <div class="heading-text">
                    MoneyBoardとは
                </div>
                <div class="heading-image inversion"></div>
            </div>

            <div class="base-text">
                概況説明書を写真で撮って読み込むだけで財務状況を視覚化することができます<br>
                財務状況の確認や同業者データとの比較も行えます
            </div>

            <div class="about-moneyboard-container">
                <img src="{{ asset('/images/index/bg_image.png') }}" class="about-moneyboard-contents-bgimage">
                <div class="about-moneyboard-contents">
                    <img src="{{ asset('/images/index/app_image2.png') }}" class="about-moneyboard-contents-image">
                    <div class="about-moneyboard-contents-description">
                    <div class="about-moneyboard-contents-description-items">
                        <div class="base-items-index-text">
                            01
                        </div>
                        <div class="about-moneyboard-contents-description-items-description">
                            <div class="base-items-title-text title-text-margin-top-bottom">
                                わかりやすい
                            </div>
                            <div class="base-text">
                                会社の財務状況をビジュアル化
                            </div>
                        </div>

                    </div>

                    <div class="about-moneyboard-contents-description-items">
                        <div class="base-items-index-text">
                            02
                        </div>
                        <div class="about-moneyboard-contents-description-items-description">
                            <div class="base-items-title-text title-text-margin-top-bottom">
                                話しながら数分で完了
                            </div>
                            <div class="base-text">
                                データは税務署の提出書類を撮影し、基本情報を入力するだけ
                            </div>
                        </div>

                    </div>

                    <div class="about-moneyboard-contents-description-items">
                        <div class="base-items-index-text">
                            03
                        </div>
                        <div class="about-moneyboard-contents-description-items-description">
                            <div class="base-items-title-text title-text-margin-top-bottom">
                                定期的に会える
                            </div>
                            <div class="base-text">
                                同業他社データは３ヶ月ごとに最新データに更新
                            </div>
                        </div>

                    </div>
                </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- 機能の特徴 -->
    <div class="base-container for-top ver-gray">
        <div class="draw-contents">
            <div class="heading heading-for-top">
                <div class="heading-image"></div>
                <div class="heading-text">
                    機能の特徴
                </div>
                <div class="heading-image inversion"></div>
            </div>

            <div class="contents-container">
                <div class="contents-container-icon-start"></div>

                <div class="contens">
                    <div class="feature-contents-container">
                        <div class="feature-contents-container-row">
                            <div class="feature-items">
                                <img src="{{ asset('/images/index/feature_1.png') }}" class="feature-items-image">
                                <div class="feature-items-heading">
                                    <div class="base-items-index-text">01</div>
                                    <div class="base-items-title-text title-text-margin-left">
                                        担当者ごとの顧客管理
                                    </div>
                                </div>
                                <hr class="width-line">
                                <div class="base-text align-left">
                                    担当者ごとに顧客情報を登録でき、それぞれにパスワード設定を行います
                                </div>
                            </div>
                            <div class="feature-items">
                                <img src="{{ asset('/images/index/feature_2.png') }}" class="feature-items-image">
                                <div class="feature-items-heading">
                                    <div class="base-items-index-text">02</div>
                                    <div class="base-items-title-text title-text-margin-left">
                                        進行役による解説付き
                                    </div>
                                </div>
                                <hr class="width-line">
                                <div class="base-text align-left">
                                    画面左に進行役がいるため、指示に従うだけで初めての人も簡単に使用できます
                                </div>
                            </div>
                        </div>
                        <div class="feature-contents-container-row feature-second">
                            <div class="feature-items">
                                <img src="{{ asset('/images/index/feature_3.png') }}" class="feature-items-image">
                                <div class="feature-items-heading">
                                    <div class="base-items-index-text">03</div>
                                    <div class="base-items-title-text title-text-margin-left">
                                        サンプル機能でお試しOK
                                    </div>
                                </div>
                                <hr class="width-line">
                                <div class="base-text align-left">
                                    サンプルデータで、MoneyBoardの機能を体感してもらえます
                                </div>
                            </div>
                            <div class="feature-items">
                                <img src="{{ asset('/images/index/feature_4.png') }}" class="feature-items-image">
                                <div class="feature-items-heading">
                                    <div class="base-items-index-text">04</div>
                                    <div class="base-items-title-text title-text-margin-left">
                                        データ保存状態を選択可能
                                    </div>
                                </div>
                                <hr class="width-line">
                                <div class="base-text align-left">
                                    財務データを保存するかは顧客に選択してもらいます<br>
                                    試してみたいがデータを保存されたくない人にも対応
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contents-container-icon-end"></div>
            </div>

        </div>
    </div>


    <!-- ガイド/サンプル -->
    <div class="base-container for-top">
        <div class="draw-contents">
            <div class="g-s-item">
                <div class="g-s-heading">
                    <div class="g-s-heading-title">
                        使い方ガイド
                    </div>
                    <hr class="width-line non-margin">
                </div>
                <div class="g-s-guide-movie-container">
                    <div class="g-s-guide-movie">
                        <iframe
                        <!-- TODO: 動画変更 -->
                        <!-- src="該当URL" -->
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="g-s-item g-s-item-top-margin">
                <div class="g-s-heading">
                    <div class="g-s-heading-title">
                        サンプル画面
                    </div>
                    <hr class="width-line non-margin">
                </div>
                <div class="g-s-samples">
                    <img src="{{ asset('/images/index/sample_1.png') }}">
                    <img src="{{ asset('/images/index/sample_2.png') }}">
                    <img src="{{ asset('/images/index/sample_3.png') }}">
                </div>
                <ul class="g-s-sample-desctiptions">
                    <li class="g-s-sample-desctiption-container">
                        <div class="g-s-sample-desctiption-text">
                            過去５期の自社データの売上や資産などの推移をグラフで表示
                        </div>
                    </li>
                    <div class="g-s-sample-desctiption-container double">
                        <div class="g-s-sample-desctiption-text">
                            過去5期の「同業他社」との重要指標分析を5段階評価と折れ線チャートで表示
                        </div>
                    </li>
                </div>

            </div>
        </div>
    </div>


    <!-- 営業担当者も顧客もプラスに -->
    <div class="base-container for-top ver-gray">
        <div class="draw-contents">
            <div class="heading heading-for-top">
                <div class="heading-image"></div>
                <div class="heading-text">
                    営業担当者も顧客もプラスに
                </div>
                <div class="heading-image inversion"></div>
            </div>

            <div class="contents-container">
                <div class="contents-container-icon-start"></div>

                <div class="contens">
                    <div class="merit-container merit-container-top">
                        <img class="merit-image" src="{{ asset('/images/index/merit_1.png') }}">
                        <div class="merit-contents">
                            <div class="point-header">
                                <div class="point-text">
                                    Point!
                                </div>
                                <div class="point-title-container">
                                    <div class="point-heading-container">
                                        <div class="point-image"></div>
                                        <div class="point-title-text">
                                            営業担当者
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="merit-items">
                                <div class="merit-item">
                                    <div class="merit-item-index-text">01</div>
                                    <div class="base-text align-left">
                                        顧客との信頼関係を構築できる
                                    </div>
                                </div>

                                <div class="merit-item">
                                    <div class="merit-item-index-text">02</div>
                                    <div class="base-text align-left">
                                        会社の資金余剰を確認した上で、安心して提案を行える
                                    </div>
                                </div>

                                <div class="merit-item">
                                    <div class="merit-item-index-text">03</div>
                                    <div class="base-text align-left">
                                        顧客の財務データを一括管理ができる
                                    </div>
                                    <div class="merit-item-remarks-text">
                                        ※プレミアムプランのみ
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contens">
                    <div class="merit-container">
                        <div class="merit-contents">
                            <div class="point-header">
                                <div class="point-text">
                                    Point!
                                </div>
                                <div class="point-title-container">
                                    <div class="point-heading-container">
                                        <div class="point-image-second"></div>
                                        <div class="point-title-text">
                                            顧客・見込み客
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="merit-items">
                                <div class="merit-item">
                                    <div class="merit-item-index-text">01</div>
                                    <div class="base-text align-left">
                                        財務状況を過去から現在までの推移を確認することで今後の方向性を確認できる
                                    </div>
                                </div>

                                <div class="merit-item">
                                    <div class="merit-item-index-text">02</div>
                                    <div class="base-text align-left">
                                        同業他社との利益率や資金繰りなど重要指標を比較し、業界内でのポジションを確認できる
                                    </div>
                                </div>

                                <div class="merit-item">
                                    <div class="merit-item-index-text">03</div>
                                    <div class="base-text align-left">
                                        決算ごとに最新のデータを取り込み状況確認を行える
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img class="merit-image" src="{{ asset('/images/index/merit_2.png') }}">
                    </div>
                </div>

                <div class="contents-container-icon-end"></div>


                <!-- 活用事例 -->
                <div class="examples">
                    <div class="example-title">
                        <img class="example-title-icon" src="{{ asset('/images/index/example_icon.png') }}">
                        <div class="example-title-text">活用事例</div>
                    </div>

                    <hr class="width-line">

                    <div class="example-contents">
                        <img class="example-contents-image" src="{{ asset('/images/index/example_image.png') }}">
                        <div class="example-contents-items">

                            <div class="example-contents-item example-contents-item-top">
                                <img class="example-contents-item-icon" src="{{ asset('/images/index/example_item_icon.png') }}">
                                <div class="base-text align-left">コンサルティング先での簡易財務分析</div>
                            </div>

                            <div class="example-contents-item">
                                <img class="example-contents-item-icon" src="{{ asset('/images/index/example_item_icon.png') }}">
                                <div class="base-text align-left">不動産デベロッパーの営業</div>
                            </div>

                            <div class="example-contents-item">
                                <img class="example-contents-item-icon" src="{{ asset('/images/index/example_item_icon.png') }}">
                                <div class="base-text align-left">保険代理店の営業</div>
                            </div>

                            <div class="example-contents-item">
                                <img class="example-contents-item-icon" src="{{ asset('/images/index/example_item_icon.png') }}">
                                <div class="base-text align-left">金融商品の営業</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 利用料金 -->
    <div class="base-container for-top">
        <div class="draw-contents">
            <div class="heading heading-for-top">
                <div class="heading-image"></div>
                <div class="heading-text">
                    利用料金
                </div>
                <div class="heading-image inversion"></div>
            </div>

            <div class="plan-instruction-text">
                <div class="base-text textsize-twenty text-underline-p bold">登録月は無料！</div>
                <div class="base-text">
                    月初登録が無料日数が多く、お得です
                </div>
            </div>
            

            <div class="plans">
                <div class="plan">
                    <div class="plan-heading">
                        <div class="plan-heading-text">
                          スタンダードプラン
                        </div>
                    </div>

                    <div class="plan-items">
                        <div class="plan-price-container">
                            <div class="base-text">
                                システム利用料金
                            </div>
                            <div class="plan-prices">
                                <div class="plan-price-text">
                                    55,000
                                </div>
                                <div class="plan-price-text2-container">
                                    円/月
                                </div>
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    自社データ5期の比較
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    他社データ比較
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    財務指標評価
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    顧客管理ツール
                                </div>
                            </div>
                            <div class="plan-item-content">
                                -
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    使用できる企業数
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                60社
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    企業数の追加(1社あたり)
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                1,100円/月
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    アプリ登録台数
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                無制限
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    担当者登録数
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                無制限
                            </div>
                        </div>
                    </div>
                </div>

                <div class="plan">
                    <div class="plan-heading">
                        <div class="plan-heading-text">
                          プレミアムプラン
                        </div>
                    </div>

                    <div class="plan-items">
                        <div class="plan-price-container">
                            <div class="base-text">
                                システム利用料金
                            </div>
                            <div class="plan-prices">
                                <div class="plan-price-text">
                                    132,000
                                </div>
                                <div class="plan-price-text2-container">
                                    円/月
                                </div>
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    自社データ5期の比較
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    他社データ比較
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    財務指標評価
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    顧客管理ツール
                                </div>
                            </div>
                            <div class="plan-item-content">
                                〇
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    使用できる企業数
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                120社
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    企業数の追加(1社あたり)
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                1,100円/月
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    アプリ登録台数
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                無制限
                            </div>
                        </div>

                        <div class="plan-item">
                            <div class="plan-item-title">
                                <div class="base-text">
                                    担当者登録数
                                </div>
                            </div>
                            <div class="base-items-title-text base-items-title-text-center">
                                無制限
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 決済方法 -->
    <div class="base-container for-top ver-gray">
        <div class="draw-contents">
            <div class="heading heading-for-top">
                <div class="heading-image"></div>
                <div class="heading-text">
                    決済方法
                </div>
                <div class="heading-image inversion"></div>
            </div>
            <div class="base-text">
                クレジットカード<br>
                (月末に翌月分を支払う前払い)<br>
            </div>

            <div class="cards">
                <div class="cards-row">
                    <div class="card">
                        <img src="{{ asset('/images/index/credit_card/visa.png') }}" class="card-image">
                        <div class="card-name">
                            Visa
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('/images/index/credit_card/master.png') }}" class="card-image">
                        <div class="card-name">
                            Mastercard
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('/images/index/credit_card/amex.gif') }}" class="card-image">
                        <div class="card-name">
                            American Express
                        </div>
                    </div>
                </div>
                <div class="cards-row">
                    <div class="card">
                        <img src="{{ asset('/images/index/credit_card/discover.gif') }}" class="card-image">
                        <div class="card-name">
                            Discover
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('/images/index/credit_card/diners.gif') }}" class="card-image">
                        <div class="card-name">
                            Diners Club
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('/images/index/credit_card/jcb.gif') }}" class="card-image">
                        <div class="card-name">
                            JCB
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
