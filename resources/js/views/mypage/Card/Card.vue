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
                            支払情報
                        </h2>
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--48 margin-bottom-large--88 ] ]"
                    >
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <h4 v-if="getCompany.payment_type == 1">
                                <span
                                    class="[ icon solid ] fa-credit-card padding-right--12 text-accent"
                                ></span>
                                クレジットカード情報
                            </h4>
                            <h4 v-else>
                                <span
                                    class="[ icon solid ] fa-credit-card padding-right--12 text-accent"
                                ></span>
                                支払情報
                            </h4>
                            <hr />
                            <div
                                v-if="getCompany.payment_type == 1"
                                class="table-scrollable padding-right--8"
                                style="min-height: 450px"
                            >
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
                                                **** **** ****
                                                {{ getCard.number }}
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
                                                {{ getCard.valid_month }} /
                                                {{ getCard.valid_year }}
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

                                <p>
                                    <br />
                                    お客様のお支払方法は、<span
                                        style="font-weight: bold"
                                        >クレジットカード決済</span
                                    >となっております。<br />
                                    <br />
                                    当月の10日23時59分59秒のご利用プランの利用料がご請求金額（翌月1日決済）です。<br />
                                    前日までにクレジットカードの有効期限の確認をお願いいします。<br />
                                </p>

                                <p>
                                    ご請求額は、毎月20日までに
                                    <a class="[ btn btn--link ]" href="inquiry"
                                        >「お問い合わせ一覧」</a
                                    >
                                    の利用料のご請求についてでお知らせします。
                                </p>
                                <p>
                                    現在の月額料金は、<a
                                        class="[ btn btn--link ]"
                                        href="company/plan"
                                        >ご利用プラン</a
                                    >で確認できます。
                                </p>
                            </div>
                            <div v-else-if="getCompany.payment_type == 2">
                                <p>
                                    お客様のお支払方法は、<span
                                        style="font-weight: bold"
                                        >銀行振込</span
                                    >となっております。
                                </p>
                                <p>
                                    当月の10日23時59分59秒のご利用プランの利用料がご請求金額（当月末日が振込期限）です。
                                </p>
                                <p>
                                    月末までに下記の口座にお振込下さい。<br />
                                    <span style="font-weight: bold"
                                        >「大阪シティ信用金庫（1635）/住道支店（015）/普通預金/No.8142786/株式会社マネーボード」</span
                                    ><br />
                                </p>
                                <p>
                                    ご請求額は、毎月20日までに
                                    <a class="[ btn btn--link ]" href="inquiry"
                                        >「お問い合わせ一覧」</a
                                    >
                                    の利用料のご請求についてでお知らせします。
                                </p>
                                <p>
                                    現在の月額料金は、<a
                                        class="[ btn btn--link ]"
                                        href="company/plan"
                                        >ご利用プラン</a
                                    >で確認できます。
                                </p>
                            </div>
                            <div v-else>
                                <p>
                                    お客様のお支払方法は、<span
                                        style="font-weight: bold"
                                        >口座振替</span
                                    >となっております。
                                </p>
                                <p>
                                    当月の10日23時59分59秒のご利用プランの利用料がご請求金額（当月27日口座振替）です。
                                </p>
                                <p>
                                    27日に口座振替となりますので、前日までに口座残高の確認をお願いいします。
                                </p>
                                <p>
                                    なお、土・日・祝など金融機関が休みの場合は翌営業日となります。
                                </p>

                                <p>
                                    ご請求額は、毎月20日までに
                                    <a class="[ btn btn--link ]" href="inquiry"
                                        >「お問い合わせ一覧」</a
                                    >
                                    の利用料のご請求についてでお知らせします。
                                </p>
                                <p>
                                    現在の月額料金は、<a
                                        class="[ btn btn--link ]"
                                        href="company/plan"
                                        >ご利用プラン</a
                                    >で確認できます。
                                </p>
                                <p>
                                    ※利用開始の直後は表示が口座振替となっていても、口座振替の手続きに時間を要するため振込みとなります。
                                    <a class="[ btn btn--link ]" href="inquiry"
                                        >「お問い合わせ一覧」</a
                                    >の利用料のご請求についてをご確認ください。
                                </p>
                            </div>
                        </div>
                    </article>

                    <div
                        v-if="getCompany.payment_type == 1"
                        class="text-center [ margin-bottom-medium--0 margin-bottom--48 ]"
                    >
                        <router-link
                            :to="{ name: 'mypage-card_edit' }"
                            class="[ btn btn--accent ]"
                            >クレジットカードの変更</router-link
                        >
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios2 from "../../../src/plugins/axios2.js";
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
            message: "",
            loadingStatus: false,
            prevRoute: null,
        };
    },
    beforeRouteEnter(to, from, next) {
        next((vm) => {
            vm.prevRoute = from;
        });
    },
    mounted: function () {
        document.title = "支払情報 | MoneyBoard";
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
        if (this.getCompany === null || this.getCompany.use_status === null) {
            localStorage.removeItem("authToken");
            this.$router.push({ name: "logoff" });
            // }else if(this.getCompany.use_status === 98 || this.getCompany.use_status === 99){
            //     this.$router.push({name: 'mypage-home'})
        } else {
            if (this.getCompany.payment_type == 1) {
                this.GetCardInfo();
            }
        }
    },
    methods: {
        ...mapActions("auth", ["updateCompany"]),

        async GetCardInfo() {
            this.loadingStatus = true;

            let stripe_id = this.getCompany.stripe_id;
            const headers = {
                Authorization:
                    "Bearer " + process.env.MIX_VUE_APP_STRIPE_PRIVATE_KEY,
                "Content-Type": "application/x-www-form-urlencoded",
            };

            try {
                //カード情報の取得
                let url = process.env.MIX_VUE_STRIPE_API_URL + "/" + stripe_id;
                let response = await axios2.get(url, { headers: headers });
                let card_id = response.data.default_source;
                let name = response.data.name;

                this.getCard.name = name;

                if (response.status != "200" || card_id == null) {
                    // this.message = response.data.message
                    // setTimeout(() => {this.message = false;}, 2000);
                    this.message = "クレジットカードを登録してください。";
                } else {
                    this.message = "";

                    //カード情報の取得
                    let url =
                        process.env.MIX_VUE_STRIPE_API_URL +
                        "/" +
                        stripe_id +
                        "/sources/" +
                        card_id;
                    let response = await axios2.get(url, { headers: headers });

                    if (response.status != "200" || card_id == null) {
                        // this.message = response.data.message;
                        this.message = "クレジットカード情報が取得できません";

                        this.loadingStatus = false;
                        setTimeout(() => {
                            this.message = false;
                        }, 2000);
                    } else {
                        let valid_month = response.data.exp_month;
                        let valid_year = response.data.exp_year;
                        let number = response.data.last4;

                        this.getCard.valid_month = ("00" + valid_month).slice(
                            -2
                        );
                        this.getCard.valid_year = ("" + valid_year).slice(-2);
                        this.getCard.number = number;
                    }
                }
            } catch (e) {
                console.log(e);
                // this.message = e;
                this.message = "クレジットカード情報が取得できません";
            }
            if (this.$route.query.a == 1) {
                this.message = "クレジットカード情報を変更しました";
            } else if (this.$route.query.a == 0) {
                this.message = "クレジットカード情報を追加しました";
            }

            if (
                this.$route.query.a == 1 &&
                this.prevRoute.path == "/mypage/card_confirm"
            ) {
                this.message = "クレジットカード情報を更新しました";
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }
            this.loadingStatus = false;
        },
    },
};

// ToDo:カード情報の取得
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
