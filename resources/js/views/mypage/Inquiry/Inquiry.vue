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
            <section
                class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
            >
                <div class="container">
                    <div
                        class="[ display-flex justify-content-between-large align-items-baseline [ flex-column flex-row-large ] ] [ padding-left--16 padding-right-16 padding-medium--0 ] [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] margin-bottom--24 ] border-bottom"
                    >
                        <h2
                            class="[ margin-bottom--4 margin-bottom-large--16 ]"
                        >
                            お問い合わせ一覧
                        </h2>
                    </div>
                    <div class="text-center [ padding--24 ]">
                        <router-link
                            to="/mypage/inquiry_new"
                            class="[ btn btn--accent ]"
                            >新規お問い合わせ</router-link
                        >
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <article class="">
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <div v-if="pagenation.total > pagenation.per_page">
                                <p style="font-size: 14px">
                                    <span style="font-size: 20px">{{
                                        pagenation.current_page
                                    }}</span
                                    >ページ目／{{
                                        pagenation.last_page
                                    }}ページ（合計：{{ pagenation.total }}件）
                                </p>
                                <button
                                    v-if="pagenation.current_page !== 1"
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="fetchItems(1)"
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
                                    v-on:click="
                                        fetchItems(pagenation.prev_page)
                                    "
                                >
                                    前へ
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.prev_page)
                                    "
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
                                    v-on:click="
                                        fetchItems(pagenation.next_page)
                                    "
                                >
                                    次へ
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.next_page)
                                    "
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
                                    v-on:click="
                                        fetchItems(pagenation.last_page)
                                    "
                                >
                                    最後
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.last_page)
                                    "
                                >
                                    最後
                                </button>
                            </div>
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>お問い合わせ種別</th>
                                        <th>最新メッセージ本文</th>
                                        <th>最終送信者</th>
                                        <th>最新送信日時</th>
                                        <th>状態</th>
                                        <th>詳細</th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length">
                                    <tr
                                        v-for="item in items"
                                        :key="item._id"
                                        :class="{
                                            'fixed-record-background':
                                                item.type === 5 ||
                                                item.type === 6,
                                        }"
                                    >
                                        <!-- <td>{{ item.id }}</td> -->
                                        <td class="nowrap">
                                            {{ type[item.type] }}
                                        </td>
                                        <td v-if="item.body.length > 6">
                                            {{ item.body.substr(0, 6) }}...
                                        </td>
                                        <td v-else>{{ item.body }}</td>
                                        <td v-if="item.attribute === 0">
                                            お客様
                                        </td>
                                        <td v-else>運営</td>
                                        <td>{{ item.delivery_time }}</td>
                                        <td class="nowrap">
                                            {{ status[item.status] }}
                                        </td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'mypage-inquiry_show',
                                                    params: { id: item.id },
                                                }"
                                                class="[ btn btn--small btn--outline ] margin-right--16 margin-left--16"
                                                >詳細</router-link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>お問い合わせはありません</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--48 margin-bottom-large--88 ] ]"
                    >
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <h4>
                                <span
                                    class="[ icon solid ] fa-phone-alt padding-right--12 text-accent"
                                ></span>
                                電話での問い合わせ
                            </h4>
                            <hr />
                            <div class="table-scrollable padding-right--8">
                                <table class="table margin-bottom--8">
                                    <tbody>
                                        <tr>
                                            <th
                                                class="[ display-table-row display-table-cell-large ]"
                                            >
                                                問い合わせ窓口TEL　06-6379-5615
                                            </th>
                                            <td
                                                class="[ display-table-row display-table-cell-large ]"
                                            ></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td
                                                class="[ display-table-row display-table-cell-large ]"
                                            >
                                                　運営元　　株式会社マネーボード
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="[ display-table-row display-table-cell-large ]"
                                            >
                                                　住　所　　大阪市北区天満4丁目3番5号 中之島四季ビル5階8号室
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from "../../../src/plugins/axios.js";
import { mapActions } from "vuex";
import SideMenu from "../../../components/SideMenuComponent.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    components: {
        SideMenu,
        Loading,
    },
    data() {
        return {
            items: [],
            message: null,
            type: {
                0: "料金について",
                1: "プランについて",
                2: "使い方について",
                3: "ご意見・ご要望",
                4: "その他",
                5: "利用料のご請求について",
                6: "運営からのご連絡",
            },
            status: {
                0: "対応中",
                1: "完了",
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
        };
    },
    created: function () {
        this.fetchItems(1);
    },
    mounted: function () {
        document.title = "お問い合わせ/一覧 | MoneyBoard";
    },
    methods: {
        ...mapActions("auth", ["updateTemps", "resetTemps"]),
        async fetchItems(page) {
            this.loadingStatus = true;
            this.resetTemps();
            let url =
                process.env.MIX_VUE_APP_API_URL +
                "com/inquiry/index" +
                "?page=" +
                page;
            try {
                const response = await axios.get(url, {
                    params: {
                        user_id: this.$store.state.auth.user.id,
                        site: "user",
                    },
                });

                if (
                    typeof response.data.error_code === "undefined" ||
                    response.data.error_code === "null" ||
                    response.data.error_code === ""
                ) {
                    let items = response.data.data.data_list.data;
                    items = this.moveSpecialTypesToFront(items);
                    this.items = items;

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
                        this.pagenation.current_page ===
                        this.pagenation.last_page
                    ) {
                        this.pagenation.next_page = this.pagenation.last_page;
                    } else {
                        this.pagenation.next_page =
                            this.pagenation.current_page + 1;
                    }
                } else {
                    this.$router.push({ name: "logoff" });
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
        moveSpecialTypesToFront(items) {
            const fixedItems = items.filter(
                (item) => item.type === 5 || item.type === 6
            ); // 固定のタイプ(5,6)を取得する
            const otherItems = items.filter(
                (item) => item.type !== 5 && item.type !== 6
            ); // それ以外のタイプを取得する
            // 固定のタイプを前にして全アイテムを結合
            let combinedArray = fixedItems.concat(otherItems);
            return combinedArray;
        },
    },
};
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
