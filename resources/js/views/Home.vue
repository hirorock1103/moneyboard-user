<template>
    <main>
        <section class="hp-jumbotron display-flex">
            <article
                class="hp-jumbotron__content [ [ flex-container-center flex-column ] [ flex-row-large justify-content-center-large ] ] [ margin-top--48 margin-bottom--48 ]"
            >
                <div
                    class="card__container bg-white [ margin-bottom--8 margin-bottom-large--0 margin-right-large--16 ] hp-jumbotron__content-textbox"
                >
                    <div class="hp-jumbotron-header text-center">
                        <span
                            class="hp-heading__small margin-bottom--8 display-block"
                            >営業サポート型</span
                        >
                        <span class="hp-heading__mid text-accent display-block"
                            >財務ビジュアルツール</span
                        >
                        <h1
                            class="hp-heading__big [ flex-container-center justify-content-center ]"
                        >
                            <img
                                src="images/common/logo.svg"
                                class="margin-right--8"
                            />
                            <span class="[ logo logo__font-main ]"
                                >MoneyBoard</span
                            >
                        </h1>
                        <hr />
                    </div>
                    <div>
                        <h4
                            class="[ hp-heading__pointed hp-heading__pointed--left ]"
                        >
                            <img
                                src="images/home_page/svg/handshake.svg"
                                alt="握手アイコン"
                                class="padding-right--12"
                            />
                            営業担当者
                        </h4>
                        <p class="padding-left--24">
                            顧客とともに財務状況を把握し、現状に合った提案ができる！
                        </p>
                    </div>
                    <div>
                        <h4
                            class="[ hp-heading__pointed hp-heading__pointed--left ]"
                        >
                            <img
                                src="images/home_page/svg/heart_on_hand.svg"
                                alt="手持ちのハートアイコン"
                                class="padding-right--12"
                            />
                            顧客・見込み客
                        </h4>
                        <p class="padding-left--24">
                            財務状況をビジュアル化して経営に活用できる！
                        </p>
                    </div>
                </div>
                <picture>
                    <source
                        media="(min-width:992px)"
                        srcset="images/home_page/app_image.png"
                    />
                    <img
                        src="images/home_page/app_image.png"
                        alt="Money Boardのアプリのサンプル画像"
                        style="width: 100%"
                        class="image margin-left-large--16 hp-jumbotron__content-imgbox flex-container-center"
                    />
                </picture>
            </article>
        </section>
        <section
            class="hp-section bg-gray [ [ padding-left-large--24 padding-left-xlarge--0 ] [ padding-right-large--24 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h2 class="text-center">
                    こんな<span class="text-accent">悩み</span
                    >はないですか？<img
                        src="images/home_page/svg/twister.svg"
                    />
                </h2>
                <div
                    class="display-flex [ [ flex-column flex-row-large ] [ justify-content-between ] ]"
                >
                    <div class="[ hp-card hp-card--flex hp-card--tab ]">
                        <span
                            class="[ icon regular ] fa-sad-tear hp-card--tab__icon"
                        ></span>
                        <p class="hp-card--tab__text">
                            <span
                                class="[ hp-text-underlined hp-text-underlined--grey ]"
                                >新規顧客がなかなか増えない</span
                            >
                        </p>
                    </div>
                    <div
                        class="[ hp-card hp-card--flex hp-card--tab ] [ margin-right-large--24 margin-left-large--24 ]"
                    >
                        <span
                            class="[ icon regular ] fa-sad-tear hp-card--tab__icon"
                        ></span>
                        <p class="hp-card--tab__text">
                            <span
                                class="[ hp-text-underlined hp-text-underlined--grey ]"
                                >顧客との間に壁を感じる</span
                            >
                        </p>
                    </div>
                    <div class="[ hp-card hp-card--flex hp-card--tab ]">
                        <span
                            class="[ icon regular ] fa-sad-tear hp-card--tab__icon"
                        ></span>
                        <p class="hp-card--tab__text">
                            <span
                                class="[ hp-text-underlined hp-text-underlined--grey ]"
                                >顧客との話題がマンネリ化</span
                            >
                        </p>
                    </div>
                </div>
                <p
                    class="[ [ icon solid ] fa-caret-down ] text-center margin-bottom--16"
                ></p>
                <p class="[ [ icon solid ] fa-caret-down ] text-center"></p>
                <h2 class="text-center">
                    <span class="text-accent">MoneyBoard</span>を導入すると<img
                        src="images/home_page/svg/bulb.svg"
                        alt="電球アイコン"
                        class="padding-left--12"
                    />
                </h2>
                <div
                    class="display-flex [ [ flex-column flex-row-large ] [ justify-content-between ] ]"
                >
                    <div class="[ hp-card hp-card--flex hp-card--tab ]">
                        <span
                            class="[ icon regular ] fa-laugh hp-card--tab__icon"
                        ></span>
                        <p class="hp-card--tab__text">
                            <span
                                class="[ hp-text-underlined hp-text-underlined--yellow ]"
                                >ドアノックツールに！</span
                            >
                        </p>
                    </div>
                    <div
                        class="[ hp-card hp-card--flex hp-card--tab ] [ margin-right-large--24 margin-left-large--24 ]"
                    >
                        <span
                            class="[ icon regular ] fa-laugh hp-card--tab__icon"
                        ></span>
                        <p class="hp-card--tab__text">
                            <span
                                class="[ hp-text-underlined hp-text-underlined--yellow ]"
                                >財務状況を共有し、信頼関係を築ける！</span
                            >
                        </p>
                    </div>
                    <div class="[ hp-card hp-card--flex hp-card--tab ]">
                        <span
                            class="[ icon regular ] fa-laugh hp-card--tab__icon"
                        ></span>
                        <p class="hp-card--tab__text">
                            <span
                                class="[ hp-text-underlined hp-text-underlined--yellow ]"
                                >定期的な話題ができる！</span
                            >
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="hp-section [ [ padding-left-large--24 padding-left-xlarge--0 ] [ padding-right-large--24 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h2 class="text-center heading-primary">MoneyBoardとは</h2>
                <p class="text-center-large">
                    概要説明書を写真で撮って読み込むだけで財務状況を視覚化することができます<br />
                    財務状況の確認や同業他社データとの比較も行えます
                </p>
                <div class="row">
                    <div class="col-large-6">
                        <img
                            src="images/home_page/app_left_side.png"
                            alt="昇順の列の画像"
                            style="width: 100%"
                        />
                    </div>
                    <div class="col-large-6">
                        <ol class="hp-list-counted hp-list-fullwidth">
                            <li class="border-bottom">
                                <span
                                    class="font-weight-bold display-inline-block margin-bottom--8"
                                    >わかりやすい</span
                                >
                                <p>会社の財務状況をビジュアル化</p>
                            </li>
                            <li class="border-bottom">
                                <span
                                    class="font-weight-bold display-inline-block margin-bottom--8"
                                    >話ながら数分で完了</span
                                >
                                <p>
                                    データは税務署の提出書類を撮影し、基本情報を入力するだけ
                                </p>
                            </li>
                            <li class="border-bottom">
                                <span
                                    class="font-weight-bold display-inline-block margin-bottom--8"
                                    >定期的に会える</span
                                >
                                <p>
                                    同業他社データは３ヶ月ごとに最新データに更新
                                </p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="hp-section bg-gray [ [ padding-left-large--80 padding-left-xlarge--0 ] [ padding-right-large--80 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h2 class="text-center heading-primary">機能の特徴</h2>
                <div class="[ hp-container hp-container--bg ]">
                    <div
                        class="display-flex [ [ flex-column flex-row-large ] [ justify-content-between ] ]"
                    >
                        <div
                            class="text-center [ card hp-card hp-card--img-top ] bg-white margin-right-large--48"
                        >
                            <img
                                src="images/home_page/features/feature_1.png"
                                alt="担当者ごとの顧客管理するイメージ"
                                style="width: 100%"
                            />
                            <h3>
                                <span
                                    class="hp-text-ordinal-number padding-right--8"
                                    >01</span
                                >担当者ごとの顧客管理
                            </h3>
                            <hr />
                            <p class="text-center-medium text-left">
                                担当者ごとに顧客情報を登録でき、それぞれにパスワード設定を行います
                            </p>
                        </div>
                        <div
                            class="text-center [ card hp-card hp-card--img-top ] bg-white margin-left-large--48"
                        >
                            <img
                                src="images/home_page/features/feature_2.png"
                                alt="進行役による解説付きイメージ"
                                style="width: 100%"
                            />
                            <h3 class="text-center">
                                <span
                                    class="hp-text-ordinal-number padding-right--8"
                                    >02</span
                                >進行役による解説付き
                            </h3>
                            <hr />
                            <p class="text-center-medium text-left">
                                画面右に進行役がいるため、指示に従うだけで初めての人も簡単に使用できます
                            </p>
                        </div>
                    </div>
                    <div
                        class="display-flex [ [ flex-column flex-row-large ] [ justify-content-between ] ]"
                    >
                        <div
                            class="text-center [ card hp-card hp-card--img-top ] bg-white [ margin-right-large--48 margin-bottom--0 ]"
                        >
                            <img
                                src="images/home_page/features/feature_3.png"
                                alt="サンプル機能でお試しする人のイメージ"
                                style="width: 100%"
                            />
                            <h3>
                                <span
                                    class="hp-text-ordinal-number padding-right--8"
                                    >03</span
                                >サンプル機能でお試しOK
                            </h3>
                            <hr />
                            <p class="text-center-medium text-left">
                                サンプルデータで、Money Boardの機能を体感して<br />もらえます
                            </p>
                        </div>
                        <div
                            class="text-center [ card hp-card hp-card--img-top ] bg-white [ margin-left-large--48 margin-bottom--0 ]"
                        >
                            <img
                                src="images/home_page/features/feature_4.png"
                                alt="データ保存状態を選択する人のイメージ"
                                style="width: 100%"
                            />
                            <h3 class="text-center">
                                <span
                                    class="hp-text-ordinal-number padding-right--8"
                                    >04</span
                                >データ保存状態を選択可能
                            </h3>
                            <hr />
                            <p class="text-center-medium text-left">
                                財務データを保存するかは顧客に選択してもらいます<br />
                                試してみたいがデータを保存されたくない人にも対応
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="hp-section [ [ padding-left-large--24 padding-left-xlarge--0 ] [ padding-right-large--24 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h4>使い方ガイド</h4>
                <hr class="margin-bottom--48" />
                <div
                    class="[ hp-container ] margin-bottom--48 margin-bottom-large--80"
                >
                    <video
                        src="videos/movie.mp4"
                        controls
                        style="width: 100%"
                    ></video>
                </div>
                <h4>サンプル画面</h4>
                <hr class="margin-bottom--48" />
                <Carousel class="display-none-large" />
                <table
                    class="[ table hp-table--image ] [ display-none display-block-large ]"
                >
                    <thead>
                        <tr>
                            <th>
                                <img
                                    src="images/home_page/sample_1.png"
                                    alt="Money Boardのアプリのサンプルイメージ"
                                    class="image"
                                />
                            </th>
                            <th>
                                <img
                                    src="images/home_page/sample_2.png"
                                    alt="Money Boardのアプリのサンプルイメージ"
                                    class="image"
                                />
                            </th>
                            <th>
                                <img
                                    src="images/home_page/sample_3.png"
                                    alt="Money Boardのアプリのサンプルイメージ"
                                    class="image"
                                />
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>
                                    過去５期の自社データの売上や資産などの推移をグラフで表示
                                </span>
                            </td>
                            <td colspan="2">
                                <span class="text-center">
                                    過去５期の「同業他社」との重要指標分析を5段階評価と折れ線チャートで表示
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section
            class="hp-section bg-gray [ [ padding-left-large--80 padding-left-xlarge--0 ] [ padding-right-large--80 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h2 class="text-center heading-primary">
                    <span>営業担当者も顧客もプラスに</span>
                </h2>
                <div class="[ hp-container hp-container--bg ]">
                    <article
                        class="[ hp-card hp-card--flex hp-card--img-side ] [ margin-bottom--48 margin-bottom-large--80 ]"
                    >
                        <div class="hp-card--img-side__meta">
                            <div
                                class="hp-card--img-side__photo"
                                style="
                                    background-image: url(images/home_page/merits/merit_1.png);
                                "
                            ></div>
                        </div>
                        <div
                            class="[ hp-card--img-side__text hp-card--img-side__text--padding-large ]"
                        >
                            <h3 class="text-center margin-bottom--24">
                                <span
                                    class="[ hp-heading__pointed hp-heading__pointed--center ]"
                                >
                                    <img
                                        src="images/home_page/svg/handshake.svg"
                                        alt="握手アイコン"
                                        class="padding-right--8"
                                    />
                                    営業担当者</span
                                >
                            </h3>
                            <ol class="hp-list-counted hp-list-fullwidth">
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom"
                                >
                                    顧客との信頼関係を構築できる
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom"
                                >
                                    会社の資金余剰を確認したうえで、安心して提案を行える
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom"
                                >
                                    顧客の財務データを一括管理ができる<br
                                        class="display-none-large"
                                    /><small>※プレミアムプランのみ</small>
                                </li>
                            </ol>
                        </div>
                    </article>
                    <article
                        class="[ hp-card hp-card--flex hp-card--img-side ] alt [ margin-bottom--48 margin-bottom-large--80 ]"
                    >
                        <div class="hp-card--img-side__meta">
                            <div
                                class="hp-card--img-side__photo"
                                style="
                                    background-image: url(images/home_page/merits/merit_2.png);
                                "
                            ></div>
                        </div>
                        <div
                            class="[ hp-card--img-side__text hp-card--img-side__text--padding-large ]"
                        >
                            <h3 class="text-center margin-bottom--24">
                                <span
                                    class="[ hp-heading__pointed hp-heading__pointed--center ]"
                                >
                                    <img
                                        src="images/home_page/svg/heart_on_hand.svg"
                                        alt="手持ちのハートアイコン"
                                        class="padding-right--8"
                                    />
                                    顧客・見込み客</span
                                >
                            </h3>
                            <ol class="hp-list-counted hp-list-fullwidth">
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom"
                                >
                                    財務状況を過去から現在までの推移を確認することで今後の方向性を確認できる
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom"
                                >
                                    同業他社との利益率や資金繰りなど重要指標を比較し、業界内でのポジションを確認できる
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom"
                                >
                                    決算ごとに最新のデータを取り込み状況確認を行える
                                </li>
                            </ol>
                        </div>
                    </article>
                </div>
                <article class="[ hp-card hp-card--padded ]">
                    <h3 class="margin-bottom--16">
                        <img
                            src="images/home_page/svg/bulb_dark.svg"
                            alt="電球のアイコン"
                            class="padding-right--8"
                        />活用事例
                    </h3>
                    <hr class="margin-bottom-large--24" />
                    <div class="[ hp-card hp-card--flex hp-card--img-side ]">
                        <div class="hp-card--img-side__meta">
                            <div
                                class="hp-card--img-side__photo"
                                style="
                                    background-image: url(images/home_page/merits/example_image.png);
                                "
                            ></div>
                        </div>
                        <div
                            class="[ hp-card--img-side__text hp-card--img-side__text--padding-small ]"
                        >
                            <ul class="hp-list-fullwidth">
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom hp-list-imaged"
                                >
                                    コンサルティング先での簡易財務分析
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom hp-list-imaged"
                                >
                                    不動産デベロッパーの営業
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom hp-list-imaged"
                                >
                                    保険代理店の営業
                                </li>
                                <li
                                    class="[ padding-bottom--16 padding-bottom-large--24 ] border-bottom hp-list-imaged"
                                >
                                    金融商品の営業
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <section
            id="lp_price"
            class="hp-section [ [ padding-left-large--24 padding-left-xlarge--0 ] [ padding-right-large--24 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h2 class="text-center heading-primary">利用料金</h2>
                <!-- <h4 class="text-center">
                    <span
                        class="[ hp-text-underlined hp-text-underlined--yellow ]"
                        >登録月は無料！</span
                    >
                </h4>
                <p class="text-center">月初登録が無料日数が多くお得</p> -->
                <div
                    class="[ hp-container hp-container--flex ] flex-container-center"
                >
                    <article
                        class="hp-table--blue [ flex-container-center flex-column ]"
                        style="width: 100%"
                    >
                        <div class="hp-table--blue__header">
                            <h2>スタンダードプラン</h2>
                        </div>
                        <div
                            class="hp-table--blue__row hp-table--blue__row--big"
                        >
                            <h3 class="text-center">
                                システム利用料金<br />
                                <span class="td-title__price td-title--big"
                                    >55,000</span
                                >
                                <span class="td-title__price">円/月</span>
                            </h3>
                        </div>
                        <p class="hp-table--blue__row">
                            <label class="label">登録企業数</label>
                            <span class="span">60社</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">企業数の追加料金</label>
                            <span class="span">1,100円/月</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">自社データ比較</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">財務指標評価</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">他社データ比較</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">端末顧客管理ツール</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">WEB顧客管理ツール</label>
                            <span class="span">ー</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">必要なもの</label>
                            <span class="span">iPad・ネット環境</span>
                        </p>
                    </article>
                    <article
                        class="hp-table--blue [ flex-container-center flex-column ]"
                        style="width: 100%"
                    >
                        <div class="hp-table--blue__header">
                            <h2>プレミアムプラン</h2>
                        </div>
                        <div
                            class="hp-table--blue__row hp-table--blue__row--big"
                        >
                            <h3 class="text-center">
                                システム利用料金<br />
                                <span class="td-title__price td-title--big"
                                    >132,000</span
                                >
                                <span class="td-title__price">円/月</span>
                            </h3>
                        </div>
                        <p class="hp-table--blue__row">
                            <label class="label">登録企業数</label>
                            <span class="span">120社</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">企業数の追加料金</label>
                            <span class="span">1,100円/月</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">自社データ比較</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">財務指標評価</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">他社データ比較</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">端末顧客管理ツール</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">WEB顧客管理ツール</label>
                            <span class="span">〇</span>
                        </p>
                        <p class="hp-table--blue__row">
                            <label class="label">必要なもの</label>
                            <span class="span">iPad・PC・ネット環境</span>
                        </p>
                    </article>
                </div>
            </div>
        </section>
        <section
            id="lp_payment"
            class="hp-section bg-gray [ [ padding-left-large--24 padding-left-xlarge--0 ] [ padding-right-large--24 padding-right-xlarge--0 ] ]"
        >
            <div class="container">
                <h2 class="text-center heading-primary">決済方法</h2>
                <p class="text-center margin-bottom-large--48">
                    口座振替<br />銀行振込<br />
                    （下旬に当月分をお支払）
                </p>

                <p class="text-center margin-bottom-large--48">
                    クレジットカード<br />
                    （月初に先月分をお支払い）
                </p>
                <div
                    class="[ hp-container hp-container--width-lg ] [ flex-container-center flex-column ]"
                >
                    <div
                        class="hp-container hp-row--custom-margin [ flex-container-center justify-content-between ]"
                    >
                        <div
                            class="hp-width--33 [ flex-container-center flex-column ]"
                        >
                            <img
                                src="images/home_page/credit_card/visa.png"
                                class="hp-img--center"
                            />
                            <div class="hp-text-center">Visa</div>
                        </div>
                        <div
                            class="hp-width--33 [ flex-container-center flex-column ]"
                        >
                            <img
                                src="images/home_page/credit_card/master.png"
                                class="hp-img--center"
                            />
                            <div class="hp-text-center">Mastercard</div>
                        </div>
                        <div
                            class="hp-width--33 [ flex-container-center flex-column ]"
                        >
                            <img
                                src="images/home_page/credit_card/amex.png"
                                class="hp-img--center"
                            />
                            <div class="hp-text-center">American Express</div>
                        </div>
                    </div>
                    <div
                        class="hp-container hp-row--custom-margin [ flex-container-center justify-content-between ]"
                    >
                        <div
                            class="hp-width--33 [ flex-container-center flex-column ]"
                        >
                            <img
                                src="images/home_page/credit_card/discover.png"
                                class="hp-img--center"
                            />
                            <div class="hp-text-center">Discover</div>
                        </div>
                        <div
                            class="hp-width--33 [ flex-container-center flex-column ]"
                        >
                            <img
                                src="images/home_page/credit_card/diners.png"
                                class="hp-img--center"
                            />
                            <div class="hp-text-center">Diners Club</div>
                        </div>
                        <div
                            class="hp-width--33 [ flex-container-center flex-column ]"
                        >
                            <img
                                src="images/home_page/credit_card/jcb.png"
                                class="hp-img--center"
                            />
                            <div class="hp-text-center">JCB</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import Carousel from "../components/CarouselComponent.vue";

export default {
    name: "home",
    components: {
        Carousel,
    },
    computed: {
        getCompany() {
            return this.$store.getters["auth/company"];
        },
    },
    methods: {
        clearAuthToken() {
            localStorage.removeItem("authToken");
        },
    },
    created() {
        if (localStorage.getItem("authToken") && this.getCompany === null) {
            this.clearAuthToken();
        }
    },
    mounted: function () {
        document.title = "MoneyBoard";
    },
};

// ToDo:画像の差し替え（秘書の女性の画像変更）→依頼済み
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_home-page.scss";
</style>
