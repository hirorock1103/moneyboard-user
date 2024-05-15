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
                            カード情報の変更確認
                        </h2>
                    </div>

                    <div
                        v-if="getCard.number"
                        class="[ padding--24 padding-large--48 ] bg-white"
                    >
                        以下の内容で登録します
                    </div>

                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>

                    <form
                        v-on:submit.prevent="changeCard"
                        v-if="getCard.number"
                    >
                        <article
                            class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--48 margin-bottom-large--88 ] ]"
                        >
                            <div
                                class="[ padding--24 padding-large--48 ] bg-white"
                            >
                                <h4>
                                    <span
                                        class="[ icon solid ] fa-credit-card padding-right--12 text-accent"
                                    ></span>
                                    クレジットカード情報（更新用）
                                </h4>
                                <hr />
                                <div class="table-scrollable padding-right--8">
                                    <table class="table width-50">
                                        <tbody>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    番号
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    <span class="form-column"
                                                        >**** **** ****
                                                        {{
                                                            getCard.number
                                                        }}</span
                                                    >
                                                </td>
                                            </tr>

                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    有効期限
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    <span class="form-column"
                                                        >{{
                                                            getCard.valid_month
                                                        }}
                                                        /
                                                        {{
                                                            getCard.valid_year
                                                        }}</span
                                                    >
                                                </td>
                                            </tr>

                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    セキュリティコード
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    ***
                                                </td>
                                            </tr>

                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    名義
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    {{ getCard.name }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>

                        <div class="text-center">
                            <router-link
                                :to="{ name: 'mypage-card_edit' }"
                                class="[ btn btn--outline ] [ margin-right-medium--24 margin-right-large--24 ]"
                                >戻る</router-link
                            >
                            <input
                                type="submit"
                                class="[ btn btn--accent ]"
                                value="クレカ更新"
                            />
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from "../../../src/plugins/axios.js";
import axios2 from "../../../src/plugins/axios2.js";
import Loading from "vue-loading-overlay";
import SideMenu from "../../../components/SideMenuComponent.vue";
import { mapActions } from "vuex";

export default {
    components: {
        SideMenu,
        Loading,
    },
    data() {
        return {
            message: "",
            loadingStatus: false,
        };
    },

    computed: {
        getCompany() {
            return this.$store.getters["auth/company"];
        },
        getCard() {
            return this.$store.getters["auth/card"];
        },
    },
    created: function () {
        this.GetCardInfo();
    },
    mounted: function () {
        document.title = "カード情報の変更確認 | MoneyBoard";
    },
    methods: {
        ...mapActions("auth", ["updateTemps", "resetTemps"]),

        // クレカ変更処理（カードID取得、クレカ削除、クレカ登録、顧客更新）
        async changeCard() {
            this.loadingStatus = true;
            let stripe_id = this.getCompany.stripe_id;
            let stripe_token = this.getCard.stripe_token;
            const headers = {
                Authorization:
                    "Bearer " + process.env.MIX_VUE_APP_STRIPE_PRIVATE_KEY,
                "Content-Type": "application/x-www-form-urlencoded",
            };
            //カードIDの取得
            let url = process.env.MIX_VUE_STRIPE_API_URL + "/" + stripe_id;
            try {
                let response = null;
                let card_id = null;
                if (stripe_id) {
                    response = await axios2.get(url, { headers: headers });
                    card_id = response.data.default_source;
                }

                if (
                    response == null ||
                    response.status != "200" ||
                    card_id == null
                ) {
                    //カード情報がない場合は作成する
                    //カード作成
                    let url = process.env.MIX_VUE_STRIPE_API_URL;

                    let params = new URLSearchParams();
                    params.append("name", this.getCard.name);
                    params.append("source", this.getCard.stripe_token);

                    let response = await axios2.post(url, params, {
                        headers: headers,
                    });

                    if (response.status != "200") {
                        if (typeof response.data.message === "undefined") {
                            this.message =
                                "更新に失敗しました。申し訳ございませんが、別のクレジットカードを登録してください";
                        } else {
                            this.message = response.data.message;
                        }
                        setTimeout(() => {
                            this.message = false;
                            this.$router.push({ name: "mypage-card" });
                        }, 2000);
                    }

                    //companyテーブルにstripe_idを登録する
                    let url2 =
                        process.env.MIX_VUE_APP_API_URL +
                        "app/company/stripe_id_change";
                    let params2 = new URLSearchParams();
                    params2.append(
                        "company_code",
                        this.getCompany.company_code
                    );
                    params2.append("stripe_id", response.data.id);
                    this.$store.commit("auth/setStripeID", response.data.id);

                    const headers2 = {
                        Authorization:
                            "Bearer " + localStorage.getItem("authToken"),
                    };

                    const response2 = await axios.post(url2, params2, {
                        headers: headers2,
                    });

                    if (response2.statusText == "NG") {
                        this.loadingStatus = false;
                        this.message = response2.status;
                        setTimeout(() => {
                            this.message = false;
                        }, 2000);
                    } else {
                        setTimeout(() => {
                            this.message = false;
                            this.$router.push({
                                name: "mypage-card",
                                query: { a: 0 },
                            });
                        }, 2000);
                    }
                } else {
                    //カード作成
                    let url =
                        process.env.MIX_VUE_STRIPE_API_URL +
                        "/" +
                        stripe_id +
                        "/sources";
                    let params = new URLSearchParams();
                    params.append("source", stripe_token);

                    let response = await axios2.post(url, params, {
                        headers: headers,
                    });
                    if (response.status != "200") {
                        this.loadingStatus = false;
                        if (typeof response.data.message === "undefined") {
                            this.message =
                                "更新に失敗しました。申し訳ございませんが、別のクレジットカードを登録してください";
                        } else {
                            this.message = response.data.message;
                        }
                        setTimeout(() => {
                            this.message = false;
                            this.$router.push({ name: "mypage-card" });
                        }, 2000);
                    } else {
                        //カード削除
                        let url =
                            process.env.MIX_VUE_STRIPE_API_URL +
                            "/" +
                            stripe_id +
                            "/sources/" +
                            card_id;
                        let response = await axios2.delete(url, {
                            headers: headers,
                        });

                        if (1) {
                            //カード削除は失敗しても作成でデフォルトが変わってるので、そのまま顧客名義の更新APIを呼ぶ
                            //顧客名義の更新
                            let url =
                                process.env.MIX_VUE_STRIPE_API_URL +
                                "/" +
                                stripe_id;
                            let params = new URLSearchParams();
                            params.append("name", this.getCard.name);

                            let response = await axios2.post(url, params, {
                                headers: headers,
                            });
                            if (response.status != "200") {
                                this.message = response.data.message;
                                setTimeout(() => {
                                    this.message = false;
                                }, 2000);
                            } else {
                                this.resetTemps();
                                this.$router.push({
                                    name: "mypage-card",
                                    query: { a: 1 },
                                });
                            }
                        }
                    }
                }
            } catch (e) {
                console.log(e);
                this.message = e;
                this.message =
                    "更新に失敗しました。申し訳ございませんが、別のクレジットカードを登録してください";
                setTimeout(() => {
                    this.message = false;
                    this.$router.push({ name: "mypage-card" });
                }, 2000);

                //カード情報のクリア
                const card_initial = {
                    number: "",
                    valid_year: "",
                    valid_month: "",
                    security_code: "",
                    name: "",
                    stripe_token: "",
                };
                this.$store.commit("auth/setCard", card_initial);
            }
        },

        async GetCardInfo() {
            let token = this.getCard.stripe_token;

            //カード情報の取得
            let url = "https://api.stripe.com/v1/tokens/" + token;
            const headers = {
                Authorization:
                    "Bearer " + process.env.MIX_VUE_APP_STRIPE_PRIVATE_KEY,
                "Content-Type": "application/x-www-form-urlencoded",
            };

            try {
                let response = await axios2.get(url, { headers: headers });
                let valid_month = response.data.card.exp_month;
                let valid_year = response.data.card.exp_year;
                let number = response.data.card.last4;

                this.getCard.valid_month = ("00" + valid_month).slice(-2);
                this.getCard.valid_year = ("" + valid_year).slice(-2);
                this.getCard.number = number;

                if (response.status != "200") {
                    this.message = response.data.message;
                    setTimeout(() => {
                        this.message = false;
                    }, 2000);
                } else {
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
};

// ToDo:クレジットカードの登録
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
