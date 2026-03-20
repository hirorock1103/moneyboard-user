<template>
    <div class="display-flex">
        <loading
            v-model:active="loadingStatus"
            :can-cancel="false"
            :is-full-page="false"
            :color="'#2FBCED'"
            :height="90"
            :width="100"
        />

        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 ] margin-bottom-large--48">
                <div
                    class="[ display-flex justify-content-between-large align-items-baseline [ flex-column flex-row-large ] ] [ padding-left--16 padding-right-16 padding-medium--0 ] [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] margin-bottom--24 ] border-bottom"
                >
                    <h2 class="[ margin-bottom--4 margin-bottom-large--16 ]">
                        スタンダードプラン（顧客情報管理）
                    </h2>
                </div>

                <form
                    v-show="show"
                    v-if="blur_flg === 2"
                    v-on:submit.prevent="clientSearch(1)"
                    style="margin-bottom: 10px; font-size: 16px"
                >
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] ]"
                    >
                        <div class="bg-white">
                            <div class="[ padding--16 ] bg-white display-flex">
                                <h4>
                                    <span
                                        class="[ icon solid ] fa-search padding-right--12 text-accent"
                                    ></span>
                                    検索
                                </h4>
                                <div id="button">
                                    <button
                                        style="margin: 0 0 0 0"
                                        type="submit"
                                        class="[ btn btn--small btn--accent ] margin-right--16"
                                    >
                                        検索
                                    </button>
                                    <button
                                        style="margin: 0 0 0 0"
                                        type="button"
                                        @click="clear()"
                                        class="[ btn btn--small btn--accent ] margin-right--16"
                                    >
                                        クリア
                                    </button>

                                    <button
                                        type="button"
                                        style="margin: 5px"
                                        class="[ btn btn--small btn--outline ] margin-left--16"
                                        v-on:click="output_csv"
                                    >
                                        CSV出力
                                    </button>
                                </div>
                            </div>

                            <table>
                                <tr>
                                    <th style="padding: 0 5px 0 20px">
                                        <label>企業名</label>
                                    </th>
                                    <td>
                                        <input
                                            v-model="search_params.client_name"
                                            class="form-input"
                                            placeholder=""
                                        />
                                    </td>
                                    <th style="padding: 0 5px 0 20px">
                                        <label>担当者名</label>
                                    </th>
                                    <td>
                                        <select
                                            v-model="search_params.user_name"
                                            class="form-input"
                                        >
                                            <option v-for="user in user_list">
                                                {{ user.user_name }}
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            </table>

                            <table style="margin: 5px 0 10px 0">
                                <tr>
                                    <th style="padding: 0 5px 0 20px">
                                        <label>決算月</label>
                                    </th>
                                    <td style="font-size: 16px !important">
                                        <span
                                            style="
                                                margin: 0 5px;
                                                white-space: nowrap;
                                            "
                                            v-for="(
                                                term_month, i
                                            ) in term_month_list"
                                            :key="i"
                                        >
                                            <input
                                                :id="'term_month' + i"
                                                type="checkbox"
                                                :value="term_month"
                                                v-model="
                                                    search_params.term_month
                                                "
                                            />
                                            <label :for="'term_month' + i"
                                                >{{ term_month }}月</label
                                            >
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <tr style="color: darkblue; font-size: 16px">
                                    <th style="padding: 0 5px 0 20px">
                                        <label>並び順：第1</label>
                                    </th>
                                    <td
                                        class="[ display-table-row display-table-cell-large ]"
                                    >
                                        <select
                                            v-model="search_params.sort01_key"
                                            class="form-input"
                                        >
                                            <!-- ★ v-modelに初期値オブジェクトを設定 -->
                                            <option
                                                v-for="info in sort_list"
                                                :value="info"
                                            >
                                                <!-- ★ valueにinfoというオブジェクトを設定 -->
                                                {{ info.name }}
                                            </option>
                                        </select>
                                        <input
                                            type="radio"
                                            id="sort01_asc"
                                            class="form-radio"
                                            value="true"
                                            name="sort01"
                                            v-model="search_params.sort01"
                                        />
                                        <label
                                            class="form-radio-label margin-bottom--8 margin-right--8"
                                            for="sort01_asc"
                                            >昇順
                                        </label>
                                        <input
                                            type="radio"
                                            id="sort01_desc"
                                            class="form-radio"
                                            value="false"
                                            name="sort01"
                                            v-model="search_params.sort01"
                                        />
                                        <label
                                            class="form-radio-label margin-bottom--8"
                                            for="sort01_desc"
                                            >降順
                                        </label>
                                    </td>

                                    <th style="padding: 0 5px 0 20px">
                                        <label>第2</label>
                                    </th>
                                    <td
                                        class="[ display-table-row display-table-cell-large ]"
                                    >
                                        <select
                                            v-model="search_params.sort02_key"
                                            class="form-input"
                                        >
                                            <!-- ★ v-modelに初期値オブジェクトを設定 -->
                                            <option
                                                v-for="info in sort_list"
                                                :value="info"
                                            >
                                                <!-- ★ valueにinfoというオブジェクトを設定 -->
                                                {{ info.name }}
                                            </option>
                                        </select>

                                        <input
                                            type="radio"
                                            id="sort02_asc"
                                            class="form-radio"
                                            value="true"
                                            name="sort02"
                                            v-model="search_params.sort02"
                                        />
                                        <label
                                            class="form-radio-label margin-bottom--8 margin-right--8"
                                            for="sort02_asc"
                                            >昇順 <br
                                        /></label>
                                        <input
                                            type="radio"
                                            id="sort02_desc"
                                            class="form-radio"
                                            value="false"
                                            name="sort02"
                                            v-model="search_params.sort02"
                                        />
                                        <label
                                            class="form-radio-label margin-bottom--8"
                                            for="sort02_desc"
                                            >降順 <br
                                        /></label>
                                    </td>

                                    <th style="padding: 0 5px 0 20px">
                                        <label>第3</label>
                                    </th>
                                    <td
                                        class="[ display-table-row display-table-cell-large ]"
                                    >
                                        <select
                                            v-model="search_params.sort03_key"
                                            class="form-input"
                                        >
                                            <!-- ★ v-modelに初期値オブジェクトを設定 -->
                                            <option
                                                v-for="info in sort_list"
                                                :value="info"
                                            >
                                                <!-- ★ valueにinfoというオブジェクトを設定 -->
                                                {{ info.name }}
                                            </option>
                                        </select>

                                        <input
                                            type="radio"
                                            id="sort03_asc"
                                            class="form-radio"
                                            value="true"
                                            name="sort03"
                                            v-model="search_params.sort03"
                                        />
                                        <label
                                            class="form-radio-label margin-bottom--8 margin-right--8"
                                            for="sort03_asc"
                                            >昇順 <br
                                        /></label>
                                        <input
                                            type="radio"
                                            id="sort03_desc"
                                            class="form-radio"
                                            value="false"
                                            name="sort03"
                                            v-model="search_params.sort03"
                                        />
                                        <label
                                            class="form-radio-label margin-bottom--8"
                                            for="sort03_desc"
                                            >降順 <br
                                        /></label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </article>
                </form>

                <article class="">
                    <div
                        class="[ margin-left-medium--48 margin-left-large--48 ] [ margin-right-medium--48 margin-right-large--48 ] bg-white"
                    >
                        <div v-if="pagenation.total > pagenation.per_page">
                            <span style="font-size: 20px">{{
                                pagenation.current_page
                            }}</span
                            ><span style="font-size: 14px"
                                >ページ目／{{
                                    pagenation.last_page
                                }}ページ（合計：{{ pagenation.total }}件）</span
                            >

                            <button
                                v-if="pagenation.current_page !== 1"
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(1)"
                            >
                                最初
                            </button>
                            <button
                                v-else
                                disabled
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                            >
                                最初
                            </button>

                            <button
                                v-if="pagenation.current_page !== 1"
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(pagenation.prev_page)"
                            >
                                前へ
                            </button>
                            <button
                                v-else
                                disabled
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(pagenation.prev_page)"
                            >
                                前へ
                            </button>

                            <button
                                v-if="
                                    pagenation.current_page !==
                                    pagenation.last_page
                                "
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(pagenation.next_page)"
                            >
                                次へ
                            </button>
                            <button
                                v-else
                                disabled
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(pagenation.next_page)"
                            >
                                次へ
                            </button>

                            <button
                                v-if="
                                    pagenation.current_page !==
                                    pagenation.last_page
                                "
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(pagenation.last_page)"
                            >
                                最後
                            </button>
                            <button
                                v-else
                                disabled
                                style="margin: 5px"
                                class="[ btn btn--small btn--outline ]"
                                v-on:click="clientSearch(pagenation.last_page)"
                            >
                                最後
                            </button>
                        </div>

                        <div
                            v-if="items.length"
                            v-bind:class="{
                                blur: blur_flg !== 2,
                                '': blur_flg == 2,
                            }"
                        >
                            <p
                                v-if="sticky"
                                id="toggle_sticky"
                                @click="toggle_sticky"
                            >
                                固定解除
                            </p>
                            <p v-else id="toggle_sticky" @click="toggle_sticky">
                                列固定
                            </p>
                            <div class="fixed-header-container" ref="fixedHeader"></div>
                            <div class="table_box" ref="tableBox">
                            <table
                                oncopy="return false"
                                class="table--bordered"
                                style="white-space: nowrap;"
                            >
                                <colgroup>
                                    <col style="width:80px"><!-- 並び① -->
                                    <col style="width:80px"><!-- 並び② -->
                                    <col style="width:160px"><!-- 企業名 -->
                                    <col style="width:80px"><!-- 決算月 -->
                                    <col style="width:160px"><!-- 担当者 -->
                                    <col style="width:100px"><!-- R有無 -->
                                    <col style="width:100px"><!-- 更新日 -->
                                    <col style="width:100px"><!-- 決算期 -->
                                    <col style="width:100px"><!-- 最新の取込決済期 -->
                                    <col style="width:100px"><!-- 余剰金目安 -->
                                    <col style="width:100px"><!-- 現金預金 -->
                                    <col style="width:100px"><!-- 差額 -->
                                    <col style="width:100px"><!-- 売上高 -->
                                    <col style="width:100px"><!-- 代表者役員報酬 -->
                                    <col style="width:130px"><!-- 代表者役員報酬前営業利益 -->
                                    <col style="width:100px"><!-- 翌期繰越欠損金額 -->
                                    <col style="width:100px"><!-- 金融機関借入残 -->
                                    <col style="width:100px"><!-- 年商比 -->
                                    <col style="width:100px"><!-- 総合評価 -->
                                    <col style="width:100px"><!-- 安全性 -->
                                    <col style="width:100px"><!-- 収益性 -->
                                    <col style="width:100px"><!-- 資金効率性 -->
                                    <col style="width:100px"><!-- 借入金対策: 対策必要額 -->
                                    <col style="width:100px"><!-- 借入金対策: 不足額 -->
                                    <col style="width:100px"><!-- 運転資金対策: 対策必要金(3ヶ月) -->
                                    <col style="width:100px"><!-- 運転資金対策: 不足額(3ヶ月) -->
                                    <col style="width:100px"><!-- 運転資金対策: 対策必要金(6ヶ月) -->
                                    <col style="width:100px"><!-- 運転資金対策: 不足額(6ヶ月) -->
                                    <col style="width:100px"><!-- 退職金対策: 代表者年齢 -->
                                    <col style="width:100px"><!-- 退職金対策: 退職年齢 -->
                                    <col style="width:100px"><!-- 退職金対策: 相続人数 -->
                                    <col style="width:100px"><!-- 退職金対策: 相続財産額 -->
                                    <col style="width:100px"><!-- 退職金対策: 生命保険 -->
                                    <col style="width:100px"><!-- 退職金対策: 同族株式 -->
                                    <col style="width:100px"><!-- 退職金対策: 会社へ貸付 -->
                                    <col style="width:100px"><!-- 退職金対策: 会社からの借入 -->
                                    <col style="width:100px"><!-- 退職金対策: 対策必要金 -->
                                    <col style="width:100px"><!-- 退職金対策: 預貯金残高 -->
                                    <col style="width:100px"><!-- 退職金対策: 相続税 -->
                                    <col style="width:100px"><!-- 承継対策: 有無 -->
                                    <col style="width:100px"><!-- 承継対策: 後継者 割合(%) -->
                                    <col style="width:100px"><!-- 承継対策: 後継者 必要金 -->
                                    <col style="width:100px"><!-- 承継対策: 相続人 割合(%) -->
                                    <col style="width:100px"><!-- 承継対策: 相続人 必要金 -->
                                    <col style="width:100px"><!-- 承継対策: 対策必要金 -->
                                    <col style="width:100px"><!-- 年齢・人数: 代表者年齢 -->
                                    <col style="width:100px"><!-- 年齢・人数: 従業員平均年齢 -->
                                    <col style="width:100px"><!-- 年齢・人数: 従業員数 -->
                                    <col style="width:100px"><!-- 代表者: 役員報酬 -->
                                    <col style="width:100px"><!-- 代表者: 代表者借入残 -->
                                    <col style="width:100px"><!-- 相続対策: 代表者の債務 -->
                                    <col style="width:100px"><!-- 相続対策: 純資産の額 -->
                                    <col style="width:100px"><!-- 相続対策: 計 -->
                                    <col style="width:100px"><!-- 業種 -->
                                    <col style="width:100px"><!-- 法人番号 -->
                                    <col style="width:100px"><!-- 年商 -->
                                    <col style="width:100px"><!-- 資本金 -->
                                    <col style="width:100px"><!-- 成約可能性: 今回 -->
                                    <col style="width:100px"><!-- 成約可能性: 前回 -->
                                    <col style="width:100px"><!-- 成約可能性: 前々回 -->
                                    <col style="width:100px"><!-- 面談場所 -->
                                    <col style="width:100px"><!-- コメント -->
                                </colgroup>
                                <thead>
                                    <tr>
                                        <!-- 並び順①〜担当者 -->
                                        <th
                                            colspan="5"
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 0px;
                                                text-align: left;
                                                background: #ddd;
                                            "
                                        >
                                            <span
                                                class="clearOrder"
                                                v-on:click="clearOrder(1)"
                                            >
                                                並び①クリア</span
                                            >
                                            <span
                                                class="clearOrder"
                                                v-on:click="clearOrder(2)"
                                            >
                                                並び②クリア</span
                                            >
                                        </th>

                                        <!-- R有無 -->
                                        <th colspan="1" style="width: 100px; min-width: 100px; max-width: 100px;"></th>

                                        <!-- 更新日時 -->
                                        <th colspan="1"></th>

                                        <!-- 決算期 -->
                                        <th colspan="1"></th>

                                        <!-- 最新の取込決済期 -->
                                        <th colspan="1"></th>

                                        <!-- 資金繰り -->
                                        <th colspan="3">
                                            資金繰り
                                        </th>

                                        <!-- 業績 -->
                                        <th colspan="4">
                                            業績
                                        </th>

                                        <!-- 金融機関融資(定期、逓減型) -->
                                        <th colspan="2">
                                            金融機関融資
                                        </th>

                                        <!-- 指標-->
                                        <th colspan="4">
                                            指標
                                        </th>

                                        <!-- 借入金対策 -->
                                        <th colspan="2">
                                            借入金対策
                                        </th>

                                        <!-- 運転資金対策 -->
                                        <th colspan="4">
                                            運転資金対策
                                        </th>

                                        <!-- 退職金対策 -->
                                        <th colspan="11">
                                            退職金対策
                                        </th>

                                        <!-- 承継対策 -->
                                        <th colspan="6">
                                            承継対策（割合　良：0%、悪：100%）
                                        </th>

                                        <!-- 年齢・人数(医療保険、福利厚生) -->
                                        <th colspan="3">
                                            年齢・人数
                                        </th>

                                        <!-- 代表者(就業不能) -->
                                        <th colspan="2">
                                            代表者
                                        </th>

                                        <!-- 相続対策(一時払い終身) -->
                                        <th colspan="3">
                                            相続対策
                                        </th>

                                        <!-- 業種 -->
                                        <th colspan="1" class=""></th>

                                        <!-- 法人番号 -->
                                        <th colspan="1" class=""></th>

                                        <!-- 年商 -->
                                        <th colspan="1" class=""></th>

                                        <!-- 資本金 -->
                                        <th colspan="1" class=""></th>

                                        <!-- 成約可能性-->
                                        <th colspan="3">
                                            成約の可能性<br />(<span>「A：可能性大」~「E：厳しい」</span>)
                                        </th>

                                        <!-- 面談場所 -->
                                        <th></th>

                                        <!-- コメント-->
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th
                                            v-on:click="changeOrder(1)"
                                            :class="{
                                                isActive:
                                                    search_params.is_no1_on,
                                                sticky: sticky,
                                            }"
                                            class="stickyeee order_column order_no1"
                                            style="background: #ddd;"
                                            rowspan="2"
                                        >
                                            並び①
                                        </th>
                                        <th
                                            v-on:click="changeOrder(2)"
                                            :class="{
                                                isActive:
                                                    search_params.is_no2_on,
                                                sticky: sticky,
                                            }"
                                            class="stickyeee order_column order_no2"
                                            style="background: #ddd;"
                                            rowspan="2"
                                        >
                                            並び②
                                        </th>
                                        <th
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 160px;
                                                background: #ddd;
                                                border: none !important;
                                                text-align: center !important;
                                                color: rgba(0, 0, 0, 70%);
                                            "
                                            rowspan="2"
                                        >
                                            企業名
                                        </th>
                                        <th
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 320px;
                                                background: #ddd;
                                                border: none !important;
                                                text-align: center !important;
                                                min-width: 80px;
                                                max-width: 80px;
                                                color: rgba(0, 0, 0, 70%);
                                            "
                                            rowspan="2"
                                        >
                                            決算月
                                        </th>
                                        <th
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 400px;
                                                background: #ddd;
                                                text-align: center !important;
                                                min-width: 160px;
                                                max-width: 160px;
                                                color: rgba(0, 0, 0, 70%);
                                            "
                                            rowspan="2"
                                        >
                                            担当者
                                        </th>
                                        <th class="" rowspan="2" style="width: 100px; min-width: 100px; max-width: 100px;">R有無</th>
                                        <th class="" rowspan="2">更新日</th>

                                        <!-- 決算期 -->
                                        <th class="" rowspan="2">決算期</th>

                                        <!-- 最新の取込決済期 -->
                                        <th class="" rowspan="2">最新の<br />取込決済期</th>

                                        <!-- 資金繰り -->
                                        <th class="" rowspan="2">余剰金目安</th>
                                        <th class="" rowspan="2">現金預金</th>
                                        <th class="" rowspan="2">差額</th>

                                        <!-- 業績 -->
                                        <th class="" rowspan="2">売上高</th>
                                        <th class="" rowspan="2">代表者<br />役員報酬</th>
                                        <th class="" rowspan="2">代表者役員報酬前<br />営業利益</th>
                                        <th class="" rowspan="2">翌期繰越<br />欠損金額</th>

                                        <!-- 金融機関融資(定期、逓減型) -->
                                        <th class="" rowspan="2">金融機関<br />借入残</th>
                                        <th class="" rowspan="2">
                                            年商比<br />(<span>融資上限50%</span>)
                                        </th>

                                        <!-- 指標-->
                                        <th class="" rowspan="2">総合評価</th>
                                        <th class="" rowspan="2">安全性</th>
                                        <th class="" rowspan="2">収益性</th>
                                        <th class="" rowspan="2">資金<br />効率性</th>

                                        <!-- 借入金対策 -->
                                        <th class="" rowspan="2" style="background-color: yellow;">対策必要額</th>
                                        <th class="" rowspan="2" style="background-color: yellow;">不足額<br />(<span>△:不足なし</span>)</th>

                                        <!-- 運転資金対策 -->
                                        <th class="" rowspan="2" style="background-color: yellow;">対策必要金<br />(<span>3ヶ月</span>)</th>
                                        <th class="" rowspan="2" style="background-color: yellow;">不足額<br />(<span>△:不足なし</span>)</th>
                                        <th class="" rowspan="2" style="background-color: yellow;">対策必要金<br />(<span>6ヶ月</span>)</th>
                                        <th class="" rowspan="2" style="background-color: yellow;">不足額<br />(<span>△:不足なし</span>)</th>

                                        <!-- 退職金対策 -->
                                        <th class="" rowspan="2">代表者年齢<br />(<span>取込時</span>)</th>
                                        <th class="" rowspan="2">退職年齢<br />(<span>取込時</span>)</th>
                                        <th class="" rowspan="2">相続人数</th>
                                        <th class="" rowspan="2">相続財産額</th>
                                        <th class="" colspan="4">財産詳細（一部）</th>
                                        <th class="" rowspan="2" style="background-color: yellow;">対策必要金</th>
                                        <th class="" colspan="2">詳細</th>

                                        <!-- 承継対策 -->
                                        <th class="" rowspan="2">承継対策<br />の有無</th>
                                        <th class="" colspan="2">後継者問題</th>
                                        <th class="" colspan="2">相続人問題</th>
                                        <th class="" rowspan="2" style="background-color: yellow;">対策<br />必要金</th>

                                        <!-- 年齢・人数(医療保険、福利厚生) -->
                                        <th class="" rowspan="2">代表者年齢</th>
                                        <th class="" rowspan="2">従業員<br />平均年齢</th>
                                        <th class="" rowspan="2">従業員数</th>

                                        <!-- 代表者(就業不能) -->
                                        <th class="" rowspan="2">役員報酬</th>
                                        <th class="" rowspan="2">代表者<br />借入残</th>

                                        <!-- 相続対策(一時払い終身) -->
                                        <th class="" rowspan="2">代表者の債務</th>
                                        <th class="" rowspan="2">
                                            純資産の額<br />(<span>100％所有時</span>)
                                        </th>
                                        <th class="" rowspan="2">計</th>

                                        <th class="" rowspan="2">業種</th>
                                        <th class="" rowspan="2">法人番号</th>
                                        <th class="" rowspan="2">年商</th>
                                        <th class="" rowspan="2">資本金</th>

                                        <th class="" rowspan="2">今回</th>
                                        <th class="" rowspan="2">前回</th>
                                        <th class="" rowspan="2">前々回</th>

                                        <th class="" rowspan="2">面談場所</th>

                                        <th class="" rowspan="2">コメント</th>
                                    </tr>
                                    <!-- 3行目: 財産詳細サブヘッダー -->
                                    <tr>
                                        <th class="">生命保険</th>
                                        <th class="">同族株式</th>
                                        <th class="">会社へ貸付</th>
                                        <th class="">会社からの<br />借入</th>
                                        <th class="">預貯金残高</th>
                                        <th class="">相続税</th>
                                        <!-- 承継対策サブ列 -->
                                        <th class="">割合(%)</th>
                                        <th class="" style="background-color: yellow;">必要金</th>
                                        <th class="">割合(%)</th>
                                        <th class="" style="background-color: yellow;">必要金</th>
                                    </tr>
                                </thead>
                                <tbody
                                    v-if="items.length"
                                    v-bind:class="{
                                        blur: blur_flg !== 2,
                                        '': blur_flg == 2,
                                    }"
                                    oncopy="return false"
                                >
                                    <tr v-for="item in items" :key="item._id">
                                        <td
                                            v-if="!item.updated_at"
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 0px;
                                                background: #eee;
                                                min-width: 80px;
                                                max-width: 80px;
                                            "
                                        ></td>
                                        <td
                                            v-else
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 0px;
                                                background: #eee;
                                                min-width: 80px;
                                                max-width: 80px;
                                            "
                                        >
                                            <select
                                                v-on:change="
                                                    selectChangeOrder(
                                                        1,
                                                        item.id,
                                                        $event
                                                    )
                                                "
                                                style="
                                                    color: rgb(78, 78, 78);
                                                    padding: 4px;
                                                    text-align: center;
                                                    font-size: 14px;
                                                "
                                            >
                                                <option
                                                    v-if="item.sort_1 == 99"
                                                    value="99"
                                                    selected
                                                >
                                                    未設定
                                                </option>
                                                <option v-else value="99">
                                                    未設定
                                                </option>

                                                <option
                                                    v-if="item.sort_1 == 1"
                                                    value="1"
                                                    selected
                                                >
                                                    1
                                                </option>
                                                <option v-else value="1">
                                                    1
                                                </option>

                                                <option
                                                    v-if="item.sort_1 == 2"
                                                    value="2"
                                                    selected
                                                >
                                                    2
                                                </option>
                                                <option v-else value="2">
                                                    2
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 3"
                                                    value="3"
                                                    selected
                                                >
                                                    3
                                                </option>
                                                <option v-else value="3">
                                                    3
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 4"
                                                    value="4"
                                                    selected
                                                >
                                                    4
                                                </option>
                                                <option v-else value="4">
                                                    4
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 5"
                                                    value="5"
                                                    selected
                                                >
                                                    5
                                                </option>
                                                <option v-else value="5">
                                                    5
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 6"
                                                    value="6"
                                                    selected
                                                >
                                                    6
                                                </option>
                                                <option v-else value="6">
                                                    6
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 7"
                                                    value="7"
                                                    selected
                                                >
                                                    7
                                                </option>
                                                <option v-else value="7">
                                                    7
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 8"
                                                    value="8"
                                                    selected
                                                >
                                                    8
                                                </option>
                                                <option v-else value="8">
                                                    8
                                                </option>
                                                <option
                                                    v-if="item.sort_1 == 9"
                                                    value="9"
                                                    selected
                                                >
                                                    9
                                                </option>
                                                <option v-else value="9">
                                                    9
                                                </option>
                                            </select>
                                        </td>
                                        <td
                                            v-if="!item.updated_at"
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 80px;
                                                background: #eee;
                                                min-width: 80px;
                                                max-width: 80px;
                                                /* width: 80px; */
                                            "
                                        ></td>
                                        <td
                                            v-else
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 80px;
                                                background: #eee;
                                                min-width: 80px;
                                                max-width: 80px;
                                                /* width: 80px; */
                                            "
                                        >
                                            <select
                                                v-on:change="
                                                    selectChangeOrder(
                                                        2,
                                                        item.id,
                                                        $event
                                                    )
                                                "
                                                style="
                                                    color: rgb(78, 78, 78);
                                                    padding: 4px;
                                                    text-align: center;
                                                    font-size: 14px;
                                                "
                                            >
                                                <option
                                                    value="99"
                                                    v-if="item.sort_2 == 99"
                                                    selected
                                                >
                                                    未設定
                                                </option>
                                                <option v-else value="99">
                                                    未設定
                                                </option>

                                                <option
                                                    value="1"
                                                    v-if="item.sort_2 == 1"
                                                    selected
                                                >
                                                    1
                                                </option>
                                                <option v-else>1</option>

                                                <option
                                                    value="2"
                                                    v-if="item.sort_2 == 2"
                                                    selected
                                                >
                                                    2
                                                </option>
                                                <option v-else>2</option>
                                                <option
                                                    value="3"
                                                    v-if="item.sort_2 == 3"
                                                    selected
                                                >
                                                    3
                                                </option>
                                                <option v-else>3</option>
                                                <option
                                                    value="4"
                                                    v-if="item.sort_2 == 4"
                                                    selected
                                                >
                                                    4
                                                </option>
                                                <option v-else>4</option>
                                                <option
                                                    value="5"
                                                    v-if="item.sort_2 == 5"
                                                    selected
                                                >
                                                    5
                                                </option>
                                                <option v-else>5</option>
                                                <option
                                                    value="6"
                                                    v-if="item.sort_2 == 6"
                                                    selected
                                                >
                                                    6
                                                </option>
                                                <option v-else>6</option>
                                                <option
                                                    value="7"
                                                    v-if="item.sort_2 == 7"
                                                    selected
                                                >
                                                    7
                                                </option>
                                                <option v-else>7</option>
                                                <option
                                                    value="8"
                                                    v-if="item.sort_2 == 8"
                                                    selected
                                                >
                                                    8
                                                </option>
                                                <option v-else>8</option>
                                                <option
                                                    value="9"
                                                    v-if="item.sort_2 == 9"
                                                    selected
                                                >
                                                    9
                                                </option>
                                                <option v-else>9</option>
                                            </select>
                                        </td>

                                        <td
                                            class="stickyeee item-string"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 160px;
                                                background: #eee;
                                            "
                                        >
                                            {{ truncate(item.client_name, 10) }}
                                        </td>
                                        <td
                                            class="stickyeee"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 320px;
                                                background: #eee;
                                                text-align: center;
                                                min-width: 80px;
                                                max-width: 80px;
                                            "
                                        >
                                            {{
                                                item.term_month == null
                                                    ? ""
                                                    : item.term_month + "月"
                                            }}
                                        </td>
                                        <td
                                            class="stickyeee item-string"
                                            :class="{
                                                sticky: sticky,
                                            }"
                                            style="
                                                left: 400px;
                                                background: #eee;
                                                min-width: 161px !important;
                                                max-width: 161px !important;
                                                width: 161px !important;
                                            "
                                        >
                                            {{ truncate(item.user_name, 7) }}
                                        </td>

                                        <!-- R有無 -->
                                        <td style="width: 100px; min-width: 100px; max-width: 100px;">
                                            {{ item.risk_management_id ? '有' : '' }}
                                        </td>

                                        <td>
                                            {{
                                                !item.updated_at
                                                    ? ""
                                                    : formatDate(
                                                          item.updated_at
                                                      )
                                            }}
                                        </td>

                                        <!-- 決算期 (risk_management.fiscal_year_end) -->
                                        <td>
                                            {{ item.rm_fiscal_year_end != null ? item.rm_fiscal_year_end + '月' : '' }}
                                        </td>

                                        <!-- 最新の取込決済期 -->
                                        <td>
                                            {{
                                                !item.term_year
                                                    ? ""
                                                    : item.term_year + "/"
                                            }}
                                            {{
                                                !item.term_month
                                                    ? ""
                                                    : item.term_month
                                            }}
                                        </td>

                                        <!-- 資金繰り -->
                                        <td>
                                            <!-- 余剰金目安 -->
                                            {{
                                                item.surplus_guideline != null
                                                    ? Number(
                                                          item.surplus_guideline
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- 現金預金 -->
                                            {{
                                                item.cash_depositcash_deposit !=
                                                null
                                                    ? Number(
                                                          item.cash_depositcash_deposit
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- 差額（現金預金 - 余剰金目安） -->
                                            {{
                                                Number(
                                                    (item.cash_depositcash_deposit != null ? Number(item.cash_depositcash_deposit) : 0) -
                                                    (item.surplus_guideline != null ? Number(item.surplus_guideline) : 0)
                                                ).toLocaleString()
                                            }}千円
                                        </td>

                                        <!-- 業績 -->
                                        <td>
                                            <!-- 売上高 (summary_reports.sales_amount) -->
                                            {{
                                                item.sales_amount != null
                                                    ? Number(item.sales_amount).toLocaleString()
                                                    : ''
                                            }}
                                        </td>
                                        <td>
                                            <!-- 代表者役員報酬 (summary_reports.directors_fee) -->
                                            {{
                                                item.directors_fee != null
                                                    ? Number(item.directors_fee).toLocaleString()
                                                    : ''
                                            }}
                                        </td>
                                        <td>
                                            <!-- 代表者役員報酬前営業利益 = 営業損益 + 役員報酬 -->
                                            {{
                                                (item.rm_operating_income != null || item.directors_fee != null)
                                                    ? Number(
                                                        (item.rm_operating_income != null ? Number(item.rm_operating_income) : 0) +
                                                        (item.directors_fee != null ? Number(item.directors_fee) : 0)
                                                    ).toLocaleString()
                                                    : ''
                                            }}
                                        </td>
                                        <td>
                                            <!-- 翌期繰越欠損金額 (risk_management.loss_carryforward) -->
                                            {{
                                                item.rm_carried_forward_deficit != null
                                                    ? Number(item.rm_carried_forward_deficit).toLocaleString()
                                                    : ''
                                            }}
                                        </td>

                                        <!-- 金融機関融資(定期、逓減型) -->
                                        <td>
                                            <!-- 金融機関借入残 -->
                                            {{
                                                item.other_debt != null
                                                    ? Number(
                                                          item.other_debt
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- {{ 年商比 }}  -->
                                            {{
                                                item.annual_sales_ratio != null
                                                    ? Number(
                                                          item.annual_sales_ratio
                                                      ).toLocaleString()
                                                    : 0
                                            }}%
                                        </td>

                                        <!-- 指標-->
                                        <td>{{ item.important_index }}</td>
                                        <td>{{ item.bankruptcy_risk }}</td>
                                        <td>{{ item.earning_power }}</td>
                                        <td>
                                            {{ item.money_efficiency }}
                                        </td>

                                        <!-- 借入金対策 -->
                                        <td style="background-color: yellow;">
                                            {{ item.rm_countermeasure_required_amount != null ? Number(item.rm_countermeasure_required_amount).toLocaleString() : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            {{ item.rm_shortage_amount != null ? Number(item.rm_shortage_amount).toLocaleString() : '' }}
                                        </td>

                                        <!-- 運転資金対策 -->
                                        <td style="background-color: yellow;">
                                            {{ item.rm_working_capital_required_3m != null ? Number(item.rm_working_capital_required_3m).toLocaleString() : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            {{ item.rm_working_capital_shortage_3m != null ? Number(item.rm_working_capital_shortage_3m).toLocaleString() : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            {{ item.rm_working_capital_required_6m != null ? Number(item.rm_working_capital_required_6m).toLocaleString() : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            {{ item.rm_working_capital_shortage_6m != null ? Number(item.rm_working_capital_shortage_6m).toLocaleString() : '' }}
                                        </td>

                                        <!-- 退職金対策 -->
                                        <td>
                                            <!-- 代表者年齢 (risk_management.representative_retirement_age) -->
                                            {{ item.rm_retirement_ceo_age != null ? item.rm_retirement_ceo_age : '' }}
                                        </td>
                                        <td>
                                            <!-- 退職年齢 (risk_management.retirement_age) -->
                                            {{ item.rm_retirement_age_tax != null ? item.rm_retirement_age_tax : '' }}
                                        </td>
                                        <td>
                                            <!-- 相続人数 (risk_management.number_of_heirs) -->
                                            {{ item.rm_heir_count != null ? item.rm_heir_count : '' }}
                                        </td>
                                        <td>
                                            <!-- 相続財産額 = 自社株 + 債権 + 預貯金 + 有価証券 + 不動産 + その他 - 債務(自社) - 債務 + 生命保険 + 調整額 -->
                                            {{
                                                item.risk_management_id
                                                    ? Number(
                                                        (Number(item.rm_family_stock) || 0) +
                                                        (Number(item.rm_loan_to_company) || 0) +
                                                        (Number(item.rm_savings_liquid_assets) || 0) +
                                                        (Number(item.rm_rep_securities) || 0) +
                                                        (Number(item.rm_rep_real_estate) || 0) +
                                                        (Number(item.rm_rep_other_assets) || 0) -
                                                        (Number(item.rm_loan_from_company) || 0) -
                                                        (Number(item.rm_rep_liabilities) || 0) +
                                                        (Number(item.rm_life_insurance) || 0) +
                                                        (Number(item.rm_rep_adjustment_amount) || 0)
                                                    ).toLocaleString()
                                                    : ''
                                            }}
                                        </td>
                                        <td>
                                            <!-- 生命保険 (risk_management.rep_life_insurance_amount) -->
                                            {{ item.rm_life_insurance != null ? Number(item.rm_life_insurance).toLocaleString() : '' }}
                                        </td>
                                        <td>
                                            <!-- 同族株式 (risk_management.rep_company_shares) -->
                                            {{ item.rm_family_stock != null ? Number(item.rm_family_stock).toLocaleString() : '' }}
                                        </td>
                                        <td>
                                            <!-- 会社へ貸付 (risk_management.rep_claims_against_company) -->
                                            {{ item.rm_loan_to_company != null ? Number(item.rm_loan_to_company).toLocaleString() : '' }}
                                        </td>
                                        <td>
                                            <!-- 会社からの借入 (risk_management.rep_debt_to_company) -->
                                            {{ item.rm_loan_from_company != null ? Number(item.rm_loan_from_company).toLocaleString() : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            <!-- 対策必要金 ※計算値（未実装） -->
                                            {{ item.rm_retirement_required_amount != null ? Number(item.rm_retirement_required_amount).toLocaleString() : '' }}
                                        </td>
                                        <td>
                                            <!-- 預貯金流動資産 (risk_management.rep_bank_deposits) -->
                                            {{ item.rm_savings_liquid_assets != null ? Number(item.rm_savings_liquid_assets).toLocaleString() : '' }}
                                        </td>
                                        <td>
                                            <!-- 相続税 (risk_management.inheritance_tax) -->
                                            {{ item.rm_inheritance_tax != null ? Number(item.rm_inheritance_tax).toLocaleString() : '' }}
                                        </td>

                                        <!-- 承継対策 -->
                                        <td>
                                            <!-- 承継対策の有無 (risk_management.business_succession_flag) -->
                                            {{ item.rm_succession_flag != null ? (item.rm_succession_flag == 1 ? '有' : '無') : '' }}
                                        </td>
                                        <td>
                                            <!-- 後継者問題 割合(%) (risk_management.successer_status) -->
                                            {{ item.rm_successer_status != null ? item.rm_successer_status : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            <!-- 後継者問題 必要金 ※計算値（未実装） -->
                                            {{ item.rm_successor_required != null ? Number(item.rm_successor_required).toLocaleString() : '' }}
                                        </td>
                                        <td>
                                            <!-- 相続人問題 割合(%) (risk_management.heir_relationship) -->
                                            {{ item.rm_heir_relationship != null ? item.rm_heir_relationship : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            <!-- 相続人問題 必要金 ※計算値（未実装） -->
                                            {{ item.rm_heir_required != null ? Number(item.rm_heir_required).toLocaleString() : '' }}
                                        </td>
                                        <td style="background-color: yellow;">
                                            <!-- 承継対策 対策必要金 ※計算値（未実装） -->
                                            {{ item.rm_succession_required_amount != null ? Number(item.rm_succession_required_amount).toLocaleString() : '' }}
                                        </td>

                                        <!-- 年齢・人数(医療保険、福利厚生) -->
                                        <td>{{ item.ceo_age }}歳</td>
                                        <td>{{ item.average_age }}歳</td>
                                        <td>
                                            {{ item.number_of_employees }}人
                                        </td>

                                        <!-- 代表者(就業不能) -->
                                        <td>
                                            <!-- 役員報酬 -->
                                            {{
                                                item.directors_fee != null
                                                    ? Number(
                                                          item.directors_fee
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- 代表者借入残 -->
                                            {{
                                                item.rep_debt != null
                                                    ? Number(
                                                          item.rep_debt
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>

                                        <!-- 相続対策(一時払い終身) -->
                                        <td>
                                            <!-- {{ 代表者の債務(in_house_4_1_assets_debt_defference) }} -->
                                            {{
                                                item.in_house_4_1_assets_debt_defference !=
                                                null
                                                    ? Number(
                                                          item.in_house_4_1_assets_debt_defference
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- {{ 純資産の額 }} -->
                                            {{
                                                item.in_house_3_1_net_assets !=
                                                null
                                                    ? Number(
                                                          item.in_house_3_1_net_assets
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- {{ 計(total_inheritance) }} -->
                                            {{
                                                item.total_inheritance != null
                                                    ? Number(
                                                          item.total_inheritance
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>

                                        <td>
                                            <!-- 業種 -->
                                            {{
                                                business_type_list[
                                                    item.business_type
                                                ]
                                            }}
                                        </td>
                                        <td>
                                            <!-- 法人番号 -->
                                            {{ item.corporate_number }}
                                        </td>
                                        <td>
                                            <!-- 年商 -->
                                            {{
                                                item.sales_amount != null
                                                    ? Number(
                                                          item.sales_amount
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>
                                        <td>
                                            <!-- 資本金 -->
                                            {{
                                                item.capital != null
                                                    ? Number(
                                                          item.capital
                                                      ).toLocaleString()
                                                    : 0
                                            }}千円
                                        </td>

                                        <td>
                                            {{ item.close_possibility_now }}
                                        </td>
                                        <td>
                                            {{
                                                item.close_possibility_previous
                                            }}
                                        </td>
                                        <td>
                                            {{ item.close_possibility_befpre }}
                                        </td>
                                        <td class="item-string">
                                            {{ item.interview_place }}
                                        </td>
                                        <td class="item-string">
                                            {{ item.comment }}
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            スタンダードプラン情報はありません
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div v-else-if="blur_flg === 1">
                            顧客情報管理画面はスタンダードプランのみの表示となります
                        </div>
                        <div v-else>スタンダードプラン情報はありません</div>
                    </div>
                </article>
                <div id="overlay" v-show="showContent">
                    <div id="content">
                        <div class="header__logo text-center">
                            <span class="header__logo-image">
                                <img src="/images/header_logo.png" />
                            </span>
                            <span
                                class="header__logo-title [ logo logo__font-main ]"
                                >MoneyBoard</span
                            >
                        </div>
                        <div
                            class="text-center [ padding--24 padding-large--48 ] bg-white"
                        >
                            <p>
                                内容を表示するにはスタンダードプランへの変更が必要です
                            </p>
                            <p>
                                スタンダードプランに変更をご希望の方は
                                <router-link
                                    style="text-decoration: underline"
                                    to="/mypage/company/plan"
                                    >こちら</router-link
                                >
                                <br />※毎月1日〜10日まで変更可能
                            </p>
                        </div>
                        <div class="text-center padding--12 bg-white">
                            <button
                                class="[ btn btn--small btn--accent ] margin-right--16"
                                style="background-color: gray !important"
                                v-on:click="closeModal"
                            >
                                閉じる
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from "../../../src/plugins/axios.js";
import dayjs from "dayjs";
import SideMenu from "../../../components/SideMenuComponent.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import { saveAs } from "file-saver";
import Encoding from "encoding-japanese";

export default {
    components: {
        SideMenu,
        Loading,
    },
    data() {
        return {
            items: [],
            user_list: [],
            showContent: false,
            blur_flg: 1,
            term_month_list: [
                "1",
                "2",
                "3",
                "4",
                "5",
                "6",
                "7",
                "8",
                "9",
                "10",
                "11",
                "12",
            ],
            sort_list: [
                { key: "", name: "なし" }, //company_clients
                { key: "client_name", name: "企業名" }, //company_clients
                { key: "term_month", name: "決算月" }, //client_graph_data
                { key: "user_name", name: "担当者名" }, //users
                { key: "updated_at", name: "更新日時" }, //company_clients
                { key: "term_year", name: "最新の取込決済期" }, //client_graph_data
                { key: "surplus_guideline", name: "余剰金目安" }, //client_graph_data
                { key: "cash_depositcash_deposit", name: "現金預金" }, //summary_reports

                { key: "other_debt", name: "金融機関借入残" }, //summary_reports
                { key: "annual_sales_ratio", name: "年商比" }, //summary_reports

                { key: "ceo_age", name: "代表者年齢" }, //company_clients
                { key: "average_age", name: "従業員平均年齢" }, //company_clients
                { key: "number_of_employees", name: "従業員数" }, //company_clients

                { key: "directors_fee", name: "役員報酬" }, //summary_reports
                { key: "rep_debt", name: "代表者借入残" }, //summary_reports
                {
                    key: "in_house_4_1_assets_debt_defference",
                    name: "代表者の債務",
                }, //client_graph_data
                { key: "in_house_3_1_net_assets", name: "純資産の額" }, //client_graph_data
                { key: "total_inheritance", name: "計" }, //summary_reports

                { key: "important_index", name: "重要指標" }, //company_clients
                { key: "bankruptcy_risk", name: "安全性指標" }, //client_graph_data
                { key: "earning_power", name: "収益性指標" }, //client_graph_data
                { key: "money_efficiency", name: "資金効率性指標" }, //client_graph_data
                { key: "business_type", name: "業種" }, //company_clients
                { key: "corporate_number", name: "法人番号" }, //company_clients
                { key: "sales_amount", name: "年商" }, //summary_reports
                { key: "capital", name: "資本金" }, //company_clients
                { key: "interview_place", name: "面談場所" }, //company_clients
                { key: "close_possibility_now", name: "成約の可能性(今回)" }, //company_clients
                {
                    key: "close_possibility_previous",
                    name: "成約の可能性(前回)",
                },
                {
                    key: "close_possibility_befpre",
                    name: "成約の可能性(前々回)",
                },
            ],

            business_type_list: {
                1: "製造業",
                2: "建設業",
                3: "飲食業",
                4: "卸売業",
                5: "小売業",
                6: "全業種",
            },
            pagenation: {
                prev_page: 0,
                next_page: 0,
                current_page: 0,
                last_page: 0,
                total: 0,
                per_page: 0,
            },
            loadingStatus: true,
            search_params: {
                client_name: "",
                user_name: "",
                term_month: ["0"],
                sort01_key: { key: "", name: "なし" },
                sort02_key: { key: "", name: "なし" },
                sort03_key: { key: "", name: "なし" },
                sort01: true,
                sort02: true,
                sort03: true,
                is_no1_on: true,
                is_no2_on: true,
            },
            show: true, //検索項目の表示・非表示切替
            sticky: true, //一覧項目の列固定・解除切替
        };
    },
    computed: {
        getCompany() {
            return this.$store.getters["auth/company"];
        },
    },
    created: function () {
        if (this.getCompany === null || this.getCompany.use_status === null) {
            localStorage.removeItem("authToken");
            this.$router.push({ name: "logoff" });
        } else if (
            this.getCompany.use_status === 98 ||
            this.getCompany.use_status === 99
        ) {
            this.$router.push({ name: "mypage-home" });
        } else {
            if (sessionStorage.hasOwnProperty("premium-search-params")) {
                this.search_params = JSON.parse(
                    sessionStorage.getItem("premium-search-params")
                );
            }

            this.fetchItems(1);
            this.blur_flg = this.$store.state.auth.contract.plan_id;
        }
    },
    mounted: function () {
        document.title = "スタンダードプラン | MoneyBoard";
    },
    updated: function () {
        this.$nextTick(function () {
            this.setupFixedHeader();
        });
    },
    beforeUnmount: function () {
        if (this._scrollHandler && this.$refs.tableBox) {
            this.$refs.tableBox.removeEventListener('scroll', this._scrollHandler);
        }
    },
    methods: {
        setupFixedHeader: function () {
            var tableBox = this.$refs.tableBox;
            var fixedHeader = this.$refs.fixedHeader;
            if (!tableBox || !fixedHeader) return;
            // 既にヘッダーテーブルが存在する場合はスキップ
            if (fixedHeader.querySelector('table')) return;

            var table = tableBox.querySelector('table');
            if (!table || !table.querySelector('thead')) return;

            // colgroup合計幅を計算してテーブルに設定（table-layout:fixedに必須）
            var cols = table.querySelectorAll('colgroup col');
            var totalWidth = 0;
            for (var i = 0; i < cols.length; i++) {
                totalWidth += parseInt(cols[i].style.width) || 0;
            }
            table.style.width = totalWidth + 'px';

            // テーブルごとクローン（thead+同じ列構造を保証）
            var headerTable = table.cloneNode(true);
            // tbody を削除（thead + colgroup だけ残す）
            var clonedTbody = headerTable.querySelector('tbody');
            if (clonedTbody) headerTable.removeChild(clonedTbody);
            // ヘッダーテーブルのスクロールバー元クラスを除去 & 幅設定
            // 注意: overflow:hiddenはposition:stickyをブロックするので設定しない
            headerTable.classList.remove('table-scrollable');
            headerTable.style.width = totalWidth + 'px';

            fixedHeader.innerHTML = '';
            fixedHeader.appendChild(headerTable);

            // 元テーブルのtheadを非表示にする（colgroupが列幅を維持するのでdisplay:noneで安全）
            var thead = table.querySelector('thead');
            thead.style.display = 'none';

            // 横スクロール同期
            this._scrollHandler = function () {
                fixedHeader.scrollLeft = tableBox.scrollLeft;
            };
            tableBox.addEventListener('scroll', this._scrollHandler);
        },
        //検索項目の表示・非表示切替
        toggle: function () {
            this.show = !this.show;
        },
        //一覧の列固定・解除の切替
        toggle_sticky: function () {
            this.sticky = !this.sticky;
            // クローンヘッダーのstickyクラスも同期
            var fixedHeader = this.$refs.fixedHeader;
            if (fixedHeader) {
                var stickyEls = fixedHeader.querySelectorAll('.stickyeee');
                for (var i = 0; i < stickyEls.length; i++) {
                    if (this.sticky) {
                        stickyEls[i].classList.add('sticky');
                    } else {
                        stickyEls[i].classList.remove('sticky');
                    }
                }
            }
        },
        //並び①並び②列の各カラムの設定をクリアする
        clearOrder(no) {
            if (
                window.confirm(
                    "並びの設定が全てクリアされます。本当にクリアしますか？"
                )
            ) {
                // OKが選択された時の処理
                this.clearSort(no);
            }
        },
        //並び①並び②列の各カラムの設定をクリアする
        async clearSort(no) {
            this.loadingStatus = true;

            let url = process.env.MIX_VUE_APP_API_URL + "app/client/clear_sort";
            try {
                const response = await axios.post(url, {
                    no: no,
                });
            } catch (e) {
                console.log(e);
                this.message = e;
                this.loadingStatus = false;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }
            this.$router.go({
                path: this.$router.currentRoute.path,
                force: true,
            });

            this.loadingStatus = false;
        },
        //並び①並び②の有効・無効の切替
        changeOrder(no) {
            // if (no === 1) {
            //     this.search_params.is_no1_on = !this.search_params.is_no1_on;
            // } else {
            //     this.search_params.is_no2_on = !this.search_params.is_no2_on;
            // }
            // this.clientSearch(1);
            // this.$router.go({
            //     path: this.$router.currentRoute.path,
            //     force: true,
            // });
        },

        //並び①並び②列の各カラムの値を更新
        selectChangeOrder(no, id, event) {
            this.changeSort(no, id, event.target.value);
        },

        //並び①並び②列の各カラムの値を更新
        async changeSort(no, id, val) {
            this.loadingStatus = true;

            let url =
                process.env.MIX_VUE_APP_API_URL + "app/client/change_sort";
            try {
                const response = await axios.post(url, {
                    no: no,
                    id: id,
                    val: val,
                });
            } catch (e) {
                console.log(e);
                this.message = e;
                this.loadingStatus = false;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }
            this.$router.go({
                path: this.$router.currentRoute.path,
                force: true,
            });

            this.loadingStatus = false;
        },

        truncate(str, len) {
            if (str == null || str == "") {
                return str;
            } else {
                return str.length <= len ? str : str.substr(0, len) + "...";
            }
        },
        openModal: function () {
            this.showContent = true;
        },
        closeModal: function () {
            this.showContent = false;
        },
        output_csv: function () {
            this.outputCsv();
        },

        async outputCsv(page) {
            this.loadingStatus = true;

            let url =
                process.env.MIX_VUE_APP_API_URL + "com/client/output_csv_prem";
            try {
                const response = await axios.post(url, {
                    company_id: this.$store.state.auth.user.id,
                    type: 2,
                    user_name: this.search_params.user_name,
                    client_name: this.search_params.client_name,
                    search_params: this.search_params,
                });

                if (response.status === 200) {
                    const unicodeList = Encoding.stringToCode(response.data);
                    const shiftJisCodeList = Encoding.convert(
                        unicodeList,
                        "utf8",
                        "unicode"
                    );
                    const shiftJisString = new Uint8Array(shiftJisCodeList);

                    // save
                    var now = new Date();
                    var year = now.getFullYear();
                    var mon = now.getMonth() + 1;
                    var day = now.getDate();
                    var hour = now.getHours();
                    var min = now.getMinutes();
                    var sec = now.getSeconds();
                    const fileName =
                        year.toString() +
                        mon.toString() +
                        day.toString() +
                        "_" +
                        hour.toString() +
                        min.toString() +
                        sec.toString() +
                        "_premium.csv";

                    const bom = new Uint8Array([0xef, 0xbb, 0xbf]);

                    let blob = new Blob([bom, shiftJisString], {
                        type: "text/csv;charset=utf8",
                    });

                    saveAs(blob, fileName);
                    alert("CSVを出力しました");
                } else {
                    alert("CSVの出力に失敗しました");
                }
            } catch (e) {
                console.log(e);
                this.message = e;
                this.loadingStatus = false;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }

            this.loadingStatus = false;
        },

        formatDate: (dateStr) => dayjs(dateStr).format("YYYY/MM/DD"),
        async fetchItems(page) {
            this.loadingStatus = true;

            let url =
                process.env.MIX_VUE_APP_API_URL +
                "com/client/index_prem" +
                "?page=" +
                page;
            try {
                const response = await axios.post(url, {
                    company_id: this.$store.state.auth.user.id,
                    type: 2,
                    user_name: this.search_params.user_name,
                    client_name: this.search_params.client_name,
                    search_params: this.search_params,
                });
                this.items = response.data.data.data_list.data;
                this.user_list = response.data.data.user_list;

                //ライトの場合
                if (this.$store.state.auth.contract.plan_id === 1) {
                    for (var i = 0; i < this.items.length; i++) {
                        this.items[i]["client_name"] = "ダミー会社";
                        this.items[i]["corporate_number"] = 99999;
                        this.items[i]["user_name"] = "ダミー太郎";
                        this.items[i]["business_type"] = 1;
                        this.items[i]["anualsales"] = 1000;
                        this.items[i]["capital"] = 10000;
                        this.items[i]["interview_place"] = "喫茶店";
                        this.items[i]["ceo_age"] = 40;
                        this.items[i]["average_age"] = 30;
                        this.items[i]["important_index"] = 0;
                        this.items[i]["safety_index"] = 0;
                        this.items[i]["profit_index"] = 0;
                        this.items[i]["fund_efficiency_index"] = 0;
                        this.items[i]["surplus_guideline"] = 0;
                        this.items[i]["close_possibility_now"] = 0;
                        this.items[i]["close_possibility_previous"] = 0;
                        this.items[i]["close_possibility_befpre"] = 0;
                        this.items[i]["comment"] =
                            "ダミーデータです。スタンダードプランに申し込んでください";
                    }
                }

                this.showContent =
                    this.$store.state.auth.contract.plan_id == 2 ? false : true;

                //ページネーション情報の設定
                this.pagenation.per_page =
                    response.data.data.data_list.per_page;
                this.pagenation.current_page =
                    response.data.data.data_list.current_page;
                this.pagenation.last_page =
                    response.data.data.data_list.last_page;
                this.pagenation.total = response.data.data.data_list.total;
                if (this.pagenation.current_page === 1) {
                    this.pagenation.prev_page = 1;
                } else {
                    this.pagenation.prev_page =
                        this.pagenation.current_page - 1;
                }
                if (
                    this.pagenation.current_page === this.pagenation.last_page
                ) {
                    this.pagenation.next_page = this.pagenation.last_page;
                } else {
                    this.pagenation.next_page =
                        this.pagenation.current_page + 1;
                }
            } catch (e) {
                console.log(e);
                this.message = e;
                this.loadingStatus = false;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }

            this.loadingStatus = false;
        },
        async clientSearch(page) {
            if (!localStorage.getItem("authToken")) {
                this.$router.push({ name: "logoff" });
            }

            sessionStorage.setItem(
                "premium-search-params",
                JSON.stringify(this.search_params)
            );

            this.loadingStatus = true;

            let url =
                process.env.MIX_VUE_APP_API_URL +
                "com/client/index_prem" +
                "?page=" +
                page;
            try {
                const response = await axios.post(url, {
                    company_id: this.$store.state.auth.user.id,
                    type: 2,
                    user_name: this.search_params.user_name,
                    client_name: this.search_params.client_name,
                    search_params: this.search_params,
                });
                this.items = response.data.data.data_list.data;
                this.user_list = response.data.data.user_list;

                //ライトの場合
                if (this.$store.state.auth.contract.plan_id === 1) {
                    for (var i = 0; i < this.items.length; i++) {
                        this.items[i]["client_name"] = "ダミー会社";
                        this.items[i]["corporate_number"] = 99999;
                        this.items[i]["user_name"] = "ダミー太郎";
                        this.items[i]["business_type"] = 1;
                        this.items[i]["anualsales"] = 1000;
                        this.items[i]["capital"] = 10000;
                        this.items[i]["interview_place"] = "喫茶店";
                        this.items[i]["ceo_age"] = 40;
                        this.items[i]["average_age"] = 30;
                        this.items[i]["important_index"] = 0;
                        this.items[i]["safety_index"] = 0;
                        this.items[i]["profit_index"] = 0;
                        this.items[i]["fund_efficiency_index"] = 0;
                        this.items[i]["surplus_guideline"] = 0;
                        this.items[i]["close_possibility_now"] = 0;
                        this.items[i]["close_possibility_previous"] = 0;
                        this.items[i]["close_possibility_befpre"] = 0;
                        this.items[i]["comment"] =
                            "ダミーデータです。スタンダードプランに申し込んでください";
                    }
                }

                //ページネーション情報の設定
                this.pagenation.per_page =
                    response.data.data.data_list.per_page;
                this.pagenation.current_page =
                    response.data.data.data_list.current_page;
                this.pagenation.last_page =
                    response.data.data.data_list.last_page;
                this.pagenation.total = response.data.data.data_list.total;
                if (this.pagenation.current_page === 1) {
                    this.pagenation.prev_page = 1;
                } else {
                    this.pagenation.prev_page =
                        this.pagenation.current_page - 1;
                }
                if (
                    this.pagenation.current_page === this.pagenation.last_page
                ) {
                    this.pagenation.next_page = this.pagenation.last_page;
                } else {
                    this.pagenation.next_page =
                        this.pagenation.current_page + 1;
                }
            } catch (e) {
                console.log(e);
                this.message = e;

                this.loadingStatus = false;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }

            this.loadingStatus = false;
        },

        clear() {
            this.search_params = {
                client_name: "",
                user_name: "",
                term_month: ["0"],
                sort01_key: { key: "", name: "なし" },
                sort02_key: { key: "", name: "なし" },
                sort03_key: { key: "", name: "なし" },
                sort01: true,
                sort02: true,
                sort03: true,
                is_no1_on: true,
                is_no2_on: true,
            };

            this.clientSearch(1);

            if (!localStorage.getItem("authToken")) {
                this.$router.push({ name: "logoff" });
            }

            sessionStorage.setItem(
                "premium-search-params",
                JSON.stringify(this.search_params)
            );
        },
    },
};
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
<style scoped>
/* 固定ヘッダーコンテナ */
.fixed-header-container {
    overflow-x: auto;
    overflow-y: hidden;
    border-bottom: 2px solid #ccc;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.fixed-header-container::-webkit-scrollbar {
    display: none;
}
.fixed-header-container :deep(table) {
    border-collapse: collapse !important;
    border-spacing: 0 !important;
    table-layout: fixed;
}
.fixed-header-container :deep(tr) {
    border-left: none;
    border-right: none;
}
.fixed-header-container :deep(th) {
    vertical-align: middle;
    border: 1px solid #ddd;
    white-space: nowrap;
    font-size: 14px;
    line-height: 16px;
    padding: 5px;
    background-color: #EEEEEE;
}
.fixed-header-container :deep(th span) {
    text-align: center;
    font-size: 11px;
    line-height: 11px;
}
.fixed-header-container :deep(th.stickyeee) {
    border: none;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    min-width: 160px;
    max-width: 160px;
}
.fixed-header-container :deep(.sticky) {
    position: sticky;
    position: -webkit-sticky;
    left: 0;
    z-index: 2;
}

/* テーブル本体 */
.table_box {
    overflow: auto !important;
    -webkit-overflow-scrolling: touch !important;
    max-height: calc(100vh - 350px);
}

.table_box table {
    border-collapse: collapse !important;
    border-spacing: 0 !important;
    table-layout: fixed;
}

.table_box tr {
    border-left: none;
    border-right: none;
}

.table_box th,
.table_box td {
    vertical-align: middle;
    border: 1px solid #ddd;
    white-space: nowrap;
    font-size: 14px;
    line-height: 16px;
}
.table_box td {
    border: 1px solid #ddd;
}
.table_box th {
    /* font-weight: bold; */
    padding: 5px;
}

.table_box th span {
    text-align: center;
    font-size: 11px;
    line-height: 11px;
}

.table_box th.stickyeee,
.table_box td.stickyeee {
    border: none;
    min-width: 160px;
    max-width: 160px;
}

.table_box th.stickyeee {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

.table_box .sticky {
    position: sticky;
    position: -webkit-sticky;
    top: 0 !important;
    left: 0;
    min-width: 160px;
    max-width: 160px;
}

.table_box .sticky::before {
    content: "" !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    z-index: -1 !important;
}

label {
    white-space: nowrap;
}

.table_box td {
    text-align: right;
    padding: 5px;
}
.table_box .item-string {
    text-align: left;
}
.isActive {
    color: rgba(0, 0, 0, 70%) !important;
}
/* .isActive:after {
    content: "↓";
    color: blue;
    font-weight: 900;
} */
span.clearOrder:hover {
    cursor: pointer;
    text-decoration: underline;
}
.order_column {
    color: lightgray;
    background: #ddd;
    border: none !important;
    text-align: center !important;
    min-width: 80px !important;
    max-width: 80px !important;
}
/* .order_column:hover {
    cursor: pointer;
} */
.order_no1 {
    left: 0px;
}
.order_no2 {
    left: 80px !important;
}

#open_close {
    line-height: 20px;
    margin-bottom: 0px;
    margin-left: 25px;
    width: 20px;
    float: left;
    text-align: center !important;
    border: 1px solid black;
    background: black;
    color: white;
}
#open_close:hover {
    cursor: pointer;
}
#toggle_sticky {
    line-height: 20px;
    margin-bottom: 0px;
    width: 60px;
    font-size: 12px;
    text-align: center !important;
    border: 1px solid #2fbced;
    background: #2fbced;
    color: white;
}
#toggle_sticky:hover {
    cursor: pointer;
    background-color: rgba(47, 188, 237, 0.8);
    color: #ffffff;
}

span.clearOrder {
    color: red;
    font-size: 10px;
    font-weight: normal;
    display: inline-block;
    width: 80px;
}

#button {
    position: absolute;
    left: 500px;
    top: 200px;
}

/*　画面サイズが990px以下の場合、ここから　*/
@media screen and (max-width: 990px) {
    #button {
        left: auto;
        right: 70px;
        top: 185px;
    }
}

/*　画面サイズが760px以下の場合、ここから　*/
@media screen and (max-width: 760px) {
    #open_close {
        margin-left: 0px;
    }
    #button {
        left: auto;
        right: 20px;
        top: 165px;
    }
}
</style>
