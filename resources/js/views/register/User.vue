<template>
    <main>
        <section
            class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
        >
            <div class="container">
                <h2 class="text-center heading-primary">新規登録</h2>
                <form @submit.prevent="register">
                    <ProgressBar :current-step="currentStep" />
                    <p class="text-center margin-bottom--48">
                        下記項目をすべてご記入ください
                    </p>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <div class="padding--24 bg-white">
                            <h4>
                                <span
                                    class="[ icon solid ] fa-pencil-alt padding-right--12 text-accent"
                                ></span>
                                基本情報
                            </h4>
                            <hr />
                            <div class="form-row">
                                <label
                                    for="company-name"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    会社名
                                </label>
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="company-name"
                                        class="form-input"
                                        v-model="getUser.company_name"
                                        @input="v$.getUser.company_name.$touch"
                                        v-bind:class="[
                                            v$.getUser.company_name.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.company_name.$error"
                            >
                                {{
                                    v$.getUser.company_name.$errors[0].$message
                                }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="post_number"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    郵便番号
                                </label>
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="post_number"
                                        class="form-input"
                                        v-model="getUser.post_number"
                                        @input="
                                            searchAddress();
                                            v$.getUser.post_number.$touch();
                                        "
                                        v-bind:class="[
                                            v$.getUser.post_number.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                                <!-- <button type="button" class="[ btn btn--small btn--accent ]" @click="searchAddress">住所自動入力</button> -->
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.post_number.$error"
                            >
                                {{ v$.getUser.post_number.$errors[0].$message }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="address"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    住所
                                </label>
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="address"
                                        class="form-input"
                                        v-model="getUser.address"
                                        @input="v$.getUser.address.$touch"
                                        v-bind:class="[
                                            v$.getUser.address.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.address.$error"
                            >
                                {{ v$.getUser.address.$errors[0].$message }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="phone-number"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    電話番号
                                </label>
                                <span class="form-column">
                                    <input
                                        type="tel"
                                        id="phone-number"
                                        class="form-input"
                                        autocomplete="tel"
                                        v-model="getUser.phone_number"
                                        @input="v$.getUser.phone_number.$touch"
                                        v-bind:class="[
                                            v$.getUser.phone_number.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.phone_number.$error"
                            >
                                {{
                                    v$.getUser.phone_number.$errors[0].$message
                                }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="company-rep"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    担当者名
                                </label>
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="company-rep"
                                        class="form-input"
                                        v-model="getUser.company_rep"
                                        @input="v$.getUser.company_rep.$touch"
                                        v-bind:class="[
                                            v$.getUser.company_rep.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.company_rep.$error"
                            >
                                {{ v$.getUser.company_rep.$errors[0].$message }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="mobile-number"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    携帯番号
                                </label>
                                <span class="form-column">
                                    <input
                                        type="tel"
                                        id="mobile-number"
                                        class="form-input"
                                        autocomplete="tel"
                                        v-model="getUser.mobile_number"
                                        @input="v$.getUser.mobile_number.$touch"
                                        v-bind:class="[
                                            v$.getUser.mobile_number.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.mobile_number.$error"
                            >
                                {{
                                    v$.getUser.mobile_number.$errors[0].$message
                                }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="email-address"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    メールアドレス
                                </label>
                                {{ this.$store.state.auth.temps }}
                            </div>
                        </div>
                    </article>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <!-- <article class="padding--16  bg-gray  [ margin-left-medium--48  margin-right-medium--48 ]"> -->
                        <div
                            class="padding--24 bg-white"
                            role="radiogroup"
                            aria-labelledby="motivation-radio-group"
                        >
                            <h4>
                                <span
                                    class="[ icon solid ] fa-question-circle padding-right--12 text-accent"
                                ></span>
                                支払方法
                            </h4>
                            <hr />

                            <div
                                class="form-row"
                                role="radio-group"
                                aria-labelledby="plan-radio-group"
                            >
                                <label
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    支払方法
                                </label>
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        id="payment-type-3"
                                        class="form-radio"
                                        name="payment-group"
                                        value="3"
                                        v-model="getUser.payment_type"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="payment-type-3"
                                        >口座振替</label
                                    >
                                </span>
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        id="payment-type-2"
                                        class="form-radio"
                                        name="payment-group"
                                        value="2"
                                        v-model="getUser.payment_type"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="payment-type-2"
                                        >銀行振込</label
                                    >
                                </span>

                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="true"
                                        id="payment-type-1"
                                        class="form-radio"
                                        name="payment-group"
                                        value="1"
                                        v-model="getUser.payment_type"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="payment-type-1"
                                        >クレジットカード</label
                                    >
                                </span>
                            </div>
                        </div>
                    </article>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <div class="padding--24 bg-white">
                            <div
                                class="[ display-flex justify-content-between-large align-items-baseline [ flex-column flex-row-large ] ] margin-bottom--24 border-bottom"
                            >
                                <h4
                                    class="[ margin-bottom--4 margin-bottom-large--16 ]"
                                >
                                    <span
                                        class="[ icon solid ] fa-key padding-right--12 text-accent"
                                    ></span>
                                    パスワードの設定
                                </h4>
                                <h5 class="margin-bottom--16 padding-left--24">
                                    10文字以上（半角アルファベット大文字、小文字、半角数字の3種類を組み合わせ）
                                </h5>
                            </div>
                            <div class="form-row">
                                <label
                                    for="password"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    パスワード
                                </label>
                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-input"
                                        v-model="getUser.password"
                                        @input="v$.getUser.password.$touch"
                                        v-bind:class="[
                                            v$.getUser.password.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.password.$error"
                            >
                                {{ v$.getUser.password.$errors[0].$message }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="password-confirm"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    パスワード　確認用
                                </label>
                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="password-confirm"
                                        class="form-input"
                                        v-model="getUser.password_confirm"
                                        @input="
                                            v$.getUser.password_confirm.$touch
                                        "
                                        v-bind:class="[
                                            v$.getUser.password_confirm.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.password_confirm.$error"
                            >
                                {{
                                    v$.getUser.password_confirm.$errors[0]
                                        .$message
                                }}
                            </div>
                        </div>
                    </article>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <div class="padding--24 bg-white">
                            <div
                                class="[ display-flex justify-content-between-large align-items-baseline [ flex-column flex-row-large ] ] margin-bottom--24 border-bottom"
                            >
                                <h4
                                    class="[ margin-bottom--4 margin-bottom-large--16 ]"
                                >
                                    <span
                                        class="[ icon solid ] fa-key padding-right--12 text-accent"
                                    ></span>
                                    アプリログイン　パスワードの設定
                                </h4>
                                <h5 class="margin-bottom--16 padding-left--24">
                                    8文字以上（半角アルファベット大文字、小文字、半角数字の3種類を組み合わせ）
                                </h5>
                            </div>
                            <div class="form-row">
                                <label
                                    for="app-password"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    パスワード
                                </label>
                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="app-password"
                                        class="form-input"
                                        v-model="getUser.app_password"
                                        @input="v$.getUser.app_password.$touch"
                                        v-bind:class="[
                                            v$.getUser.app_password.$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.app_password.$error"
                            >
                                {{
                                    v$.getUser.app_password.$errors[0].$message
                                }}
                            </div>
                            <div class="form-row">
                                <label
                                    for="app-password-confirm"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    パスワード　確認用
                                </label>
                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="app-password-confirm"
                                        class="form-input"
                                        v-model="getUser.app_password_confirm"
                                        @input="
                                            v$.getUser.app_password_confirm
                                                .$touch;
                                        "
                                        v-bind:class="[
                                            v$.getUser.app_password_confirm
                                                .$error
                                                ? 'form-error'
                                                : null,
                                        ]"
                                    />
                                </span>
                            </div>
                            <div
                                class="form-text text-danger [ margin-bottom--24 margin-left-large--164 ] padding-left-large--48"
                                v-if="v$.getUser.app_password_confirm.$error"
                            >
                                {{
                                    v$.getUser.app_password_confirm.$errors[0]
                                        .$message
                                }}
                            </div>
                        </div>
                    </article>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <div class="padding--24 bg-white">
                            <h4>
                                <span class="padding-right--12 vertical-middle">
                                    <img src="/images/common/money-icon.svg" />
                                </span>
                                料金について
                                <small
                                    class="float-right-large font-weight-normal display-block padding-left--24"
                                    >価格はすべて税込表記</small
                                >
                            </h4>
                            <hr />
                            <div
                                class="form-row"
                                role="radio-group"
                                aria-labelledby="plan-radio-group"
                            >
                                <label
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    プラン選択
                                </label>
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="true"
                                        tabindex="0"
                                        id="plan-id-0"
                                        class="form-radio"
                                        name="radio-group"
                                        value="1"
                                        v-model="getUser.plan_id"
                                        @change="changePlan(55000)"
                                        checked
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="plan-id-0"
                                        >スタンダードプラン</label
                                    >
                                </span>
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        tabindex="-1"
                                        id="plan-id-1"
                                        class="form-radio"
                                        name="radio-group"
                                        value="2"
                                        v-model="getUser.plan_id"
                                        @change="changePlan(132000)"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="plan-id-1"
                                        >プレミアムプラン</label
                                    >
                                </span>
                            </div>
                            <div class="form-row margin-bottom--48">
                                <label
                                    for="additional-licenses"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    企業データの追加
                                </label>
                                <span class="form-column">
                                    <input
                                        type="number"
                                        min="0"
                                        max="120"
                                        oninput="validity.valid||(value='');"
                                        id="additional-licenses"
                                        class="[ form-input form-input--short ]"
                                        v-model="getUser.additional_licenses"
                                    />
                                    <span>社</span>
                                </span>
                            </div>
                            <h4>
                                月額料金は
                                <span
                                    class="h2 [ text-accent text-kerning-small ] [ padding-right--4 padding-left--4 ]"
                                    >{{ $filters.addComma(totalAmount) }}</span
                                >
                                円です
                            </h4>
                            <hr />
                            <table class="table table-fixed">
                                <tbody>
                                    <tr class="display-none-large">
                                        <th>内訳</th>
                                        <td></td>
                                        <td
                                            class="[ display-none display-table-cell-medium ]"
                                        ></td>
                                    </tr>
                                    <tr>
                                        <th
                                            class="[ display-none display-table-cell-large ]"
                                        >
                                            内訳
                                        </th>
                                        <td>基本料金</td>
                                        <td style="text-align: right">
                                            {{
                                                $filters.addComma(planAmount)
                                            }}円
                                        </td>
                                        <td
                                            class="[ display-none display-table-cell-large ]"
                                        >
                                            （システム使用料と登録データ{{
                                                companyAmount
                                            }}社分）
                                        </td>
                                        <td
                                            class="[ display-none display-table-cell-medium display-none-large ]"
                                        ></td>
                                    </tr>
                                    <tr class="display-none-large">
                                        <td colspan="2">
                                            （システム使用料と登録データ{{
                                                companyAmount
                                            }}社分）
                                        </td>
                                        <td
                                            class="[ display-none display-table-cell-medium ]"
                                        ></td>
                                    </tr>
                                    <tr v-if="getUser.additional_licenses > 0">
                                        <th
                                            class="[ display-none display-table-cell-large ]"
                                        ></th>
                                        <td>追加利用料金</td>
                                        <td style="text-align: right">
                                            {{
                                                $filters.addComma(
                                                    addLicensesAmount
                                                )
                                            }}円
                                        </td>
                                        <td
                                            class="[ display-none display-table-cell-medium ]"
                                        ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                    <article
                        class="[ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <table class="[ table table--bordered ] align-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>スタンダードプラン</th>
                                    <th>プレミアムプラン</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>システム利用料金(税込)</td>
                                    <td>55,000円/月</td>
                                    <td>132,000円/月</td>
                                </tr>
                                <tr>
                                    <td>登録企業数</td>
                                    <td>60社</td>
                                    <td>120社</td>
                                </tr>
                                <tr>
                                    <td>企業数の追加料金(税込)</td>
                                    <td>1,100円/社</td>
                                    <td>1,100円/社</td>
                                </tr>

                                <tr>
                                    <td>自社データ比較</td>
                                    <td>〇</td>
                                    <td>〇</td>
                                </tr>
                                <tr>
                                    <td>財務指標評価</td>
                                    <td>〇</td>
                                    <td>〇</td>
                                </tr>
                                <tr>
                                    <td>他社データ比較</td>
                                    <td>〇</td>
                                    <td>〇</td>
                                </tr>
                                <tr>
                                    <td>端末顧客管理ツール</td>
                                    <td>〇</td>
                                    <td>〇</td>
                                </tr>
                                <tr>
                                    <td>WEB顧客管理ツール</td>
                                    <td>―</td>
                                    <td>〇</td>
                                </tr>
                                <tr>
                                    <td>必要なもの</td>
                                    <td>iPad・ネット環境</td>
                                    <td>iPad・PC・ネット環境</td>
                                </tr>
                            </tbody>
                        </table>
                    </article>

                    <article
                        class="padding--16 bg-gray [ margin-left-medium--48 margin-right-medium--48 ]"
                    >
                        <div
                            class="padding--24 bg-white"
                            role="radiogroup"
                            aria-labelledby="motivation-radio-group"
                        >
                            <h4>
                                <span
                                    class="[ icon solid ] fa-question-circle padding-right--12 text-accent"
                                ></span>
                                MoneyBoardを知ったきっかけを教えてください（任意）
                            </h4>
                            <hr />
                            <div class="form-row">
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        tabindex="-1"
                                        id="motivation-one"
                                        class="form-radio"
                                        value="弊社営業担当"
                                        v-model="getUser.motivated_by"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="motivation-one"
                                        >弊社営業担当</label
                                    >
                                </span>
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        tabindex="-1"
                                        id="motivation-two"
                                        class="form-radio"
                                        value="インターネット検索"
                                        v-model="getUser.motivated_by"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="motivation-two"
                                        >インターネット検索</label
                                    >
                                </span>
                                <span class="form-column">
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        tabindex="-1"
                                        id="motivation-three"
                                        class="form-radio"
                                        value="リーフレット"
                                        v-model="getUser.motivated_by"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="motivation-three"
                                        >リーフレット</label
                                    >
                                </span>
                            </div>
                            <div class="form-row">
                                <span
                                    class="[ form-column form-column--100 ] [ display-table-row display-table-cell-medium ]"
                                >
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        tabindex="-1"
                                        id="motivation-four"
                                        class="form-radio"
                                        value="紹介"
                                        v-model="getUser.motivated_by"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="motivation-four"
                                        >紹介</label
                                    >
                                </span>
                                <label
                                    for="recommendation-name"
                                    class="[ [ form-column form-column--100 ] form-label--inline-medium ] [ display-table-row display-table-cell-medium ]"
                                >
                                    紹介者名
                                </label>
                                <span
                                    class="form-column display-table-cell-medium [ margin-top--8 margin-top-medium--0 ]"
                                >
                                    <input
                                        type="text"
                                        id="recommendation_name"
                                        class="form-input"
                                        v-model="recommendatorName"
                                    />
                                </span>
                            </div>
                            <div class="form-row">
                                <span
                                    class="[ form-column form-column--120 ] vertical-top"
                                >
                                    <input
                                        type="radio"
                                        role="radio"
                                        aria-checked="false"
                                        tabindex="-1"
                                        id="motivation-five"
                                        class="form-radio"
                                        value="その他"
                                        v-model="getUser.motivated_by"
                                    />
                                    <label
                                        class="form-radio-label"
                                        for="motivation-five"
                                        >その他</label
                                    >
                                </span>
                                <span class="form-column">
                                    <span class="form-col form-input--inline">
                                        <textarea
                                            class="form-textarea"
                                            v-model="recommendationText"
                                        ></textarea>
                                    </span>
                                </span>
                            </div>
                            <div
                                class="form-text text-danger"
                                v-if="v$.getUser.motivated_by.$error"
                            >
                                {{
                                    v$.getUser.motivated_by.$errors[0].$message
                                }}
                            </div>
                        </div>
                    </article>
                    <div
                        class="text-center [ [ margin-top--48 margin-top-large--80 ] [ margin-bottom--48 margin-bottom-large--140 ] ]"
                    >
                        <p v-show="v$.$error" class="text-danger">
                            入力に誤りがあります
                        </p>
                        <div class="text-center" v-if="message">
                            <p class="text-danger">{{ message }}</p>
                        </div>
                        <button type="submit" class="btn btn--accent">
                            確認画面
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {
    required,
    minLength,
    maxLength,
    decimal,
    sameAs,
    helpers,
} from "@vuelidate/validators";
import containsNumber from "../../customValidators/containsNumber";
import containsUppercase from "../../customValidators/containsUppercase";
import containsLowercase from "../../customValidators/containsLowercase";
import ProgressBar from "../../components/ProgressBarComponent.vue";
import { mapActions } from "vuex";

const jsonpAdapter = require("axios-jsonp");

export default {
    name: "register-user",
    components: {
        ProgressBar,
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            planAmount: null,
            currentStep: 0,
            recommendator: null,
            recommendation: null,
            message: "",
        };
    },
    validations() {
        return {
            getUser: {
                company_name: {
                    required: helpers.withMessage(
                        "会社名を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "50文字以下で入力してください",
                        maxLength(50)
                    ),
                },
                post_number: {
                    required: helpers.withMessage(
                        "郵便番号を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "7文字で入力してください",
                        maxLength(7)
                    ),
                    minLength: helpers.withMessage(
                        "7文字で入力してください",
                        minLength(7)
                    ),
                    decimal: helpers.withMessage(
                        "半角数字で入力してください",
                        decimal
                    ),
                },
                address: {
                    required: helpers.withMessage(
                        "企業住所を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "200文字以下で入力してください",
                        maxLength(200)
                    ),
                },
                phone_number: {
                    required: helpers.withMessage(
                        "電話番号を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "10文字以下で入力してください",
                        maxLength(10)
                    ),
                    decimal: helpers.withMessage(
                        "半角数字で入力してください",
                        decimal
                    ),
                },
                company_rep: {
                    required: helpers.withMessage(
                        "担当者名を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "50文字以下で入力してください",
                        maxLength(50)
                    ),
                },
                mobile_number: {
                    required: helpers.withMessage(
                        "携帯電話番号を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "11文字以下で入力してください",
                        maxLength(11)
                    ),
                    decimal: helpers.withMessage(
                        "半角数字で入力してください",
                        decimal
                    ),
                },
                password: {
                    required: helpers.withMessage(
                        "パスワードを入力してください",
                        required
                    ),
                    minLength: helpers.withMessage(
                        "10文字以上を入力してください",
                        minLength(10)
                    ),
                    maxLength: helpers.withMessage(
                        "20文字以下で入力してください",
                        maxLength(20)
                    ),
                    containsNumber: helpers.withMessage(
                        "半角数字を含めてください",
                        containsNumber
                    ),
                    containsUppercase: helpers.withMessage(
                        "大文字を含めてください",
                        containsUppercase
                    ),
                    containsLowercase: helpers.withMessage(
                        "小文字を含めてください",
                        containsLowercase
                    ),
                },
                password_confirm: {
                    required: helpers.withMessage(
                        "確認パスワードを入力してください",
                        required
                    ),
                    sameAs: helpers.withMessage(
                        "確認パスワードはパスワードと違います",
                        sameAs(this.getUser.password)
                    ),
                },
                app_password: {
                    required: helpers.withMessage(
                        "アプリログイン　パスワードを入力してください",
                        required
                    ),
                    minLength: helpers.withMessage(
                        "8文字以上を入力してください",
                        minLength(8)
                    ),
                    maxLength: helpers.withMessage(
                        "20文字以下で入力してください",
                        maxLength(20)
                    ),
                    containsNumber: helpers.withMessage(
                        "半角数字を含めてください",
                        containsNumber
                    ),
                    containsUppercase: helpers.withMessage(
                        "大文字を含めてください",
                        containsUppercase
                    ),
                    containsLowercase: helpers.withMessage(
                        "小文字を含めてください",
                        containsLowercase
                    ),
                },
                app_password_confirm: {
                    required: helpers.withMessage(
                        "確認アプリログイン　パスワードを入力してください",
                        required
                    ),
                    sameAs: helpers.withMessage(
                        "確認アプリログイン　パスワードはパスワードと違います",
                        sameAs(this.getUser.app_password)
                    ),
                    minLength: helpers.withMessage(
                        "8文字以上を入力してください",
                        minLength(8)
                    ),
                },
                motivated_by: {
                    maxLength: helpers.withMessage(
                        "50文字以下で入力してください",
                        maxLength(50)
                    ),
                },
            },
        };
    },
    computed: {
        totalAmount() {
            return this.planAmount + this.getUser.additional_licenses * 1100;
        },
        companyAmount() {
            return this.planAmount == 55000 ? "60" : "120";
        },
        addLicensesAmount() {
            return this.getUser.additional_licenses * 1100;
        },
        getUser() {
            return this.$store.getters["auth/user"];
        },
        recommendatorName: {
            get() {
                return this.recommendator;
            },
            set(value) {
                this.recommendator = value;
            },
        },
        recommendationText: {
            get() {
                return this.recommendation;
            },
            set(value) {
                this.recommendation = value;
            },
        },
        getMailAddress() {
            this.getUser.email_address = this.$route.params.email;
        },
        getToken() {
            this.getUser.token = localStorage.getItem("authToken");
        },
    },
    methods: {
        ...mapActions("auth", ["updateUser"]),
        setPlan() {
            this.getUser.plan_id = 1;
            this.getUser.plan_id == 1
                ? ((this.planAmount = 55000),
                  (this.planName = "スタンダードプラン"))
                : ((this.planAmount = 132000),
                  (this.planName = "プレミアムプラン"));
        },
        updateMotivation() {
            if (
                this.getUser.motivated_by == "紹介" &&
                this.recommendator !== null
            ) {
                this.getUser.motivated_by = "紹介:" + this.recommendator;
            } else if (
                this.getUser.motivated_by == "その他" &&
                this.recommendation !== null
            ) {
                this.getUser.motivated_by = "その他:" + this.recommendation;
            }
        },
        setMotivation() {
            if (this.getUser.motivated_by.indexOf("紹介:") !== -1) {
                this.recommendator = this.getUser.motivated_by.substring(3);
                this.getUser.motivated_by = "紹介";
            } else if (this.getUser.motivated_by.indexOf("その他:") !== -1) {
                this.recommendation = this.getUser.motivated_by.substring(4);
                this.getUser.motivated_by = "その他";
            }
        },
        changePlan(value) {
            this.planAmount = value;
        },
        searchAddress() {
            const zipCode = this.getUser.post_number;
            if (this.getUser.post_number.length != 7) {
                return;
            }
            axios
                .get(`https://api.zipaddress.net/?zipcode=${zipCode}`, {
                    adapter: jsonpAdapter,
                })
                .then((rs) => {
                    const response = rs.data;
                    console.log(response);
                    if (response.code === 400 || response.code === 404) {
                        this.$store.commit("auth/setAddress", "");
                    } else {
                        let address =
                            response.pref + response.city + response.town;
                        this.$store.commit("auth/setAddress", address);
                    }
                });
        },
        async register() {
            this.updateMotivation();
            this.v$.$touch();
            if (this.v$.$error) return;
            this.updateUser(this.getUser);
            try {
                let url =
                    process.env.MIX_VUE_APP_API_URL + "com/register-validate";
                const datas = {
                    ...this.getUser,
                    register_token: localStorage.getItem("registerToken"),
                };
                delete datas.company_code;
                delete datas.user_type;
                let response = await axios.post(url, datas);
                if (response.data.status == "NG") {
                    console.log(response);
                    this.message = response.data.message;
                    setTimeout(() => {
                        this.message = false;
                    }, 2000);
                } else {
                    this.$router.push({ name: "register-user-confirm" });
                }
            } catch (e) {
                console.log(e);
                this.message = e;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }
        },
    },
    beforeMount() {
        this.setPlan();
        this.setMotivation();
    },

    mounted: function () {
        document.title = "新規登録 | MoneyBoard";
    },
};
</script>
