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
        <main id="plan" class="mypage__main">
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
                            ご利用プラン・プラン変更
                        </h2>
                        <h5 class="margin-bottom--16">価格はすべて税込表記</h5>
                    </div>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--24 margin-bottom-large--24 ] ]"
                        style="margin-bottom: 0 !important"
                    >
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <h3>
                                <span
                                    class="[ icon solid ] fa-list padding-right--12 text-accent"
                                ></span>
                                現在のプラン
                            </h3>
                            <div
                                class="table-scrollable padding-right--8"
                                style="padding-bottom: 48px"
                            >
                                <table class="table width-70">
                                    <tbody>
                                        <tr>
                                            <th class="">プラン名</th>
                                            <td style="padding-bottom: 46px">
                                                {{ plans.name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="">登録可能企業数</th>
                                            <td class="padding-bottom--16">
                                                {{ plans.name }}
                                            </td>
                                            <td
                                                class="padding-bottom--16 text-left nowrap"
                                            >
                                                {{ plans.data_plan }}社
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class=""></th>
                                            <td class="nowrap">追加企業数</td>
                                            <td
                                                class="padding-bottom--16 text-left nowrap"
                                            >
                                                {{
                                                    plans.additional_licenses
                                                }}社
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class=""></th>
                                            <td class="nowrap">計</td>
                                            <td
                                                class="padding-bottom--16 text-left nowrap"
                                            >
                                                {{
                                                    Number(plans.data_plan) +
                                                    Number(
                                                        plans.additional_licenses
                                                    )
                                                }}社
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4>
                                <span
                                    class="[ icon solid ] fa-yen-sign padding-right--12 text-accent"
                                ></span>
                                現在の月額料金
                                <span class="padding-left--8 text-accent">
                                    {{
                                        Number(
                                            plans.cost_total
                                        ).toLocaleString()
                                    }}
                                </span>
                                円
                            </h4>

                            <div
                                class="table-scrollable padding-right--8 padding-bottom--24"
                            >
                                <table class="table width-30">
                                    <tbody>
                                        <tr>
                                            <th class="nowrap">内訳</th>
                                            <td
                                                class="padding-bottom--16 nowrap"
                                            >
                                                基本料金
                                            </td>
                                            <td
                                                class="padding-bottom--16 text-right nowrap"
                                            >
                                                {{
                                                    $filters.addComma(
                                                        Number(plans.cost_plan)
                                                    )
                                                }}円
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class=""></th>
                                            <td class="nowrap">追加利用料金</td>
                                            <td class="text-right nowrap">
                                                {{
                                                    $filters.addComma(
                                                        Number(plans.cost_add)
                                                    )
                                                }}円
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                v-if="
                                    nextPlans !== 'NULL' &&
                                    (nextPlans.type !== 1 ||
                                        nextPlans.type !== 0)
                                "
                            >
                                <hr style="margin: 32px 0" />
                                <h3 style="margin-top: 40px">
                                    <span
                                        class="[ icon solid ] fa-list padding-right--12 text-accent"
                                    ></span>
                                    来月のプラン
                                    <p
                                        style="
                                            margin-bottom: 0;
                                            font-size: 14px;
                                            color: red;
                                        "
                                    >
                                        ※「来月の企業数の追加数」および「来月の月額料金」は、ご使用の企業数により"増加"する場合がございます
                                    </p>
                                </h3>
                                <div
                                    class="table-scrollable padding-right--8 padding-bottom--24"
                                >
                                    <table class="table width-80">
                                        <tbody>
                                            <tr>
                                                <th class="">プラン名</th>
                                                <td
                                                    v-if="
                                                        nextPlans.plan_id === 1
                                                    "
                                                    class="padding-bottom--16"
                                                >
                                                    スタンダードプラン(使用できる企業数：{{
                                                        nextPlans.license_count
                                                    }}社)
                                                </td>
                                                <td
                                                    v-else
                                                    class="padding-bottom--16"
                                                >
                                                    プレミアムプラン(使用できる企業数：{{
                                                        nextPlans.license_count
                                                    }}社)
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th class="">
                                                    プランデータ数
                                                </th>
                                                <td class="padding-bottom--16">
                                                    {{nextPlans.license_count}}社
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <th>追加企業数</th>
                                                <td class="padding-bottom--16">
                                                    {{
                                                        nextPlans.add_license_count
                                                    }}社
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <h4>
                                    <span
                                        class="[ icon solid ] fa-yen-sign padding-right--12 text-accent"
                                    ></span>
                                    来月の月額料金
                                    <span class="padding-left--8 text-accent">
                                        {{
                                            $filters.addComma(
                                                Number(nextPlans.price)
                                            )
                                        }}
                                    </span>
                                    円
                                </h4>
                            </div>

                            <div v-if="today > 10" style="margin-left: 58px">
                                <div
                                    style="
                                        text-align: left;
                                        color: red;
                                        font-size: 14px;
                                    "
                                >
                                    ※変更対象外（本日{{
                                        today
                                    }}日のため変更できません）<br />
                                    　変更期間 1日から10日まで
                                </div>
                            </div>
                            <div
                                v-else
                                class="text-center [ margin-top-medium--0 margin-top--24 ]"
                            >
                                <router-link
                                    to="/mypage/company/plan_edit"
                                    class="[ btn btn--accent ]"
                                    >変更</router-link
                                >
                                <p
                                    style="
                                        margin-top: 10px;
                                        color: red;
                                        font-size: 14px;
                                    "
                                >
                                    毎月1日〜10日まで変更可能<br />※11日以降は変更できません
                                </p>
                            </div>
                        </div>
                    </article>

                    <article
                        class="[ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--24 margin-bottom-large--24 ] ]"
                        data-v-73f06a0c=""
                        style=""
                    >
                        ※解約を希望される方は、「お問い合わせ」より解約希望日をお知らせください
                    </article>

                    <article class="plan_list">
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <table class="table table--bordered">
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
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import { mapState } from "vuex";
import axios from "../../../src/plugins/axios.js";
import SideMenu from "../../../components/SideMenuComponent.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    components: {
        SideMenu,
        Loading,
    },
    computed: {
        ...mapState({
            company: function (state) {
                return state.auth.company;
            },
        }),
    },
    data() {
        return {
            items: [],
            plans: [],
            nextPlans: [],
            loadingStatus: true,
            today: "",
        };
    },
    created: function () {
        let date = new Date();
        this.today = date.getDate();
        if (this.company === null || this.company.use_status === null) {
            localStorage.removeItem("authToken");
            this.$router.push({ name: "logoff" });
        } else if (
            this.company.use_status === 98 ||
            this.company.use_status === 99
        ) {
            this.$router.push({ name: "mypage-home" });
        } else {
            this.fetchItems();
            this.nextMonthPlans();
        }
    },
    mounted: function () {
        this.fetchItems();
        this.nextMonthPlans();
        document.title = "ご利用プラン・プラン変更 | MoneyBoard";
    },

    methods: {
        async fetchItems() {
            this.loadingStatus = true;

            let url = process.env.MIX_VUE_APP_API_URL + "com/plan/get";
            try {
                const response = await axios.post(url);
                this.items = response.data;
                var company = this.$store.state.auth.company;
                this.plans = {
                    company_code: this.$store.state.auth.company.company_code,
                    plan_id: this.$store.state.auth.contract.plan_id,
                    name:
                        this.$store.state.auth.contract.plan_id === 2
                            ? "プレミアムプラン"
                            : "スタンダードプラン",
                    data_plan:
                        this.$store.state.auth.contract.plan_id === 2
                            ? 120
                            : 60,
                    additional_licenses_before:
                        this.$store.state.auth.contract.add_license_count,
                    additional_licenses:
                        this.$store.state.auth.contract.add_license_count,
                    cost_total:
                        (this.$store.state.auth.contract.plan_id === 2
                            ? 132000
                            : 55000) +
                        this.$store.state.auth.contract.add_license_count *
                            1100,
                    cost_plan:
                        this.$store.state.auth.contract.plan_id === 2
                            ? 132000
                            : 55000,
                    cost_add:
                        this.$store.state.auth.contract.add_license_count *
                        1100,
                };
                this.$store.state.auth.plans = this.plans;
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

        async nextMonthPlans() {
            this.loadingStatus = true;

            var company_code = this.$store.state.auth.company.company_code;
            let url =
                process.env.MIX_VUE_APP_API_URL +
                "com/change-contract-request/get";
            try {
                //                const response = await axios.get(url);
                const response = await axios.get(url, {
                    params: {
                        company_code: company_code,
                    },
                });
                this.nextPlans =
                    response.data.data.change_contract_requests ?? "NULL";
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
    },
};
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
<style>
#plan .plan_list tr th {
    text-align: center;
}
#plan .plan_list tr td {
    text-align: center;
}
</style>
