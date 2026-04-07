<template>
    <main>
        <section
            class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
        >
            <div class="container">
                <loading
                    v-model:active="loadingStatus"
                    :can-cancel="false"
                    :is-full-page="false"
                    :color="'#2FBCED'"
                    :height="90"
                    :width="100"
                />

                <h2 class="text-center heading-primary">登録内容のご確認</h2>
                <form @submit.prevent="submit">
                    <ProgressBar :current-step="currentStep" />
                    <p class="text-center margin-bottom--48">
                        登録内容をご確認ください
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
                                    for="company_name"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    会社名
                                </label>
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="company_name"
                                        class="form-input"
                                        v-model="getUser.company_name"
                                        readonly
                                    />
                                </span>
                            </div>
                            <div class="form-row">
                                <label
                                    for="address"
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
                                        readonly
                                    />
                                </span>
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
                                        readonly
                                    />
                                </span>
                            </div>
                            <div class="form-row">
                                <label
                                    for="phone_number"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    電話番号
                                </label>
                                <span class="form-column">
                                    <input
                                        type="tel"
                                        id="phone_number"
                                        class="form-input"
                                        autocomplete="off"
                                        v-model="getUser.phone_number"
                                        readonly
                                    />
                                </span>
                            </div>
                            <div class="form-row">
                                <label
                                    for="company_rep"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    担当者名
                                </label>
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="company_rep"
                                        class="form-input"
                                        v-model="getUser.company_rep"
                                        readonly
                                    />
                                </span>
                            </div>
                            <div class="form-row">
                                <label
                                    for="mobile_number"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    携帯番号
                                </label>
                                <span class="form-column">
                                    <input
                                        type="tel"
                                        id="mobile_number"
                                        class="form-input"
                                        autocomplete="off"
                                        v-model="getUser.mobile_number"
                                        readonly
                                    />
                                </span>
                            </div>
                            <div class="form-row">
                                <label
                                    for="email_address"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    メールアドレス
                                </label>
                                <span class="form-column">
                                    <div class="form-input" readonly>
                                        {{ this.$store.state.auth.temps }}
                                    </div>
                                </span>
                            </div>
                        </div>
                    </article>

                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
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
                                支払方法
                            </h4>
                            <hr />

                            <div class="form-row">
                                <label
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    支払方法
                                </label>
                                <span class="form-column">{{
                                    paymentName
                                }}</span>
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
                            <div class="form-row">
                                <label
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    プラン選択
                                </label>
                                <span class="form-column">{{ planName }}</span>
                            </div>
                            <div
                                class="form-row"
                                v-if="getUser.additional_licenses"
                            >
                                <label
                                    for="additional_licenses"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    企業データの追加
                                </label>
                                <span class="form-column">
                                    <span
                                        >{{
                                            getUser.additional_licenses
                                        }}社</span
                                    >
                                </span>
                            </div>
                            <div class="form-row margin-bottom--48">
                                <label
                                    for="additional-licenses"
                                    class="[ form-column form-column--200 ] [ form-label form-label--inline-medium ]"
                                >
                                    使用できる企業数
                                </label>
                                <span class="form-column">
                                    <span>{{ useCompanyAmount }}社</span>
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
                                    <tr v-if="getUser.additional_licenses">
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
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <div class="padding--24 bg-white">
                            <h4>
                                <span
                                    class="[ icon solid ] fa-key padding-right--12 text-accent"
                                ></span>
                                マイページログイン　パスワード
                            </h4>
                            <hr />
                            <div class="form-row">
                                <label
                                    for="password"
                                    class="[ form-column form-column--300 ] [ form-label form-label--inline-medium ]"
                                >
                                    パスワード
                                </label>
                                <span class="form-column form-input-flex">
                                    <input
                                        :type="
                                            showPassword ? 'text' : 'password'
                                        "
                                        id="password"
                                        class="form-input"
                                        v-model="getUser.password"
                                        readonly
                                    />
                                    <i
                                        :class="
                                            showPassword
                                                ? 'fas fa-eye-slash'
                                                : 'fas fa-eye'
                                        "
                                        @click="showPassword = !showPassword"
                                        class="password-icon"
                                    ></i>
                                </span>
                            </div>
                        </div>
                    </article>
                    <article
                        class="padding--16 bg-gray [ [ margin-left-medium--48 margin-right-medium--48 ] [ margin-bottom--48 margin-bottom-large--80 ] ]"
                    >
                        <div class="padding--24 bg-white">
                            <h4>
                                <span
                                    class="[ icon solid ] fa-key padding-right--12 text-accent"
                                ></span>
                                アプリログイン　パスワード
                            </h4>
                            <hr />
                            <div class="form-row">
                                <label
                                    for="app_password"
                                    class="[ form-column form-column--300 ] [ form-label form-label--inline-medium ]"
                                >
                                    アプリログイン　パスワード
                                </label>
                                <span class="form-column form-input-flex">
                                    <input
                                        :type="
                                            showAppPassword
                                                ? 'text'
                                                : 'password'
                                        "
                                        id="app_password"
                                        class="form-input"
                                        v-model="getUser.app_password"
                                        readonly
                                    />
                                    <i
                                        :class="
                                            showAppPassword
                                                ? 'fas fa-eye-slash'
                                                : 'fas fa-eye'
                                        "
                                        @click="
                                            showAppPassword = !showAppPassword
                                        "
                                        class="password-icon"
                                    ></i>
                                </span>
                            </div>
                        </div>
                    </article>
                    <!-- {{ this.$store.state.auth }} -->
                    <article
                        class="padding--16 bg-gray [ margin-left-medium--48 margin-right-medium--48 ]"
                        v-if="getUser.motivated_by"
                    >
                        <div class="padding--24 bg-white">
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
                                        type="text"
                                        id="motivated_by"
                                        class="form-input"
                                        v-model="getUser.motivated_by"
                                        readonly
                                    />
                                </span>
                            </div>
                        </div>
                    </article>
                    <div
                        class="text-center [ [ margin-top--48 margin-top-large--80 ] [ margin-bottom--48 margin-bottom-large--140 ] ]"
                    >
                        <button
                            @click="goBack()"
                            class="[ btn btn--gray ] margin-right--24"
                        >
                            内容修正
                        </button>
                        <button type="submit" class="[ btn btn--accent ]">
                            <span v-if="getUser.payment_type == 1"
                                >カード登録へ</span
                            >
                            <span v-else>上記内容で申し込みます</span>
                        </button>
                        <p class="text-danger" v-if="this.message">
                            登録に失敗しました<br />
                            申し訳ございませんが、再度メールのリンクから申込みをお願いします<br />
                            お手数おかけし申し訳ございません<br />
                            （{{ this.message }}）
                        </p>
                    </div>
                </form>
            </div>
        </section>
    </main>
</template>

<script>
import { mapActions } from "vuex";
import ProgressBar from "../../components/ProgressBarComponent.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    name: "register-user-confirm",
    components: {
        ProgressBar,
        Loading,
    },
    data() {
        return {
            planAmount: null,
            planName: "",
            currentStep: 1,
            paymentName: "",
            loadingStatus: false,
            showPassword: false,
            showAppPassword: false,
        };
    },
    computed: {
        totalAmount() {
            return this.planAmount + this.getUser.additional_licenses * 1100;
        },
        useCompanyAmount() {
            return (
                Number(this.companyAmount) +
                Number(this.getUser.additional_licenses)
            );
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
    },
    methods: {
        ...mapActions("auth", ["updateTemps", "resetTemps"]),
        setPlan() {
            this.getUser.plan_id == 1
                ? ((this.planAmount = 55000),
                  (this.planName = "ライトプラン"))
                : ((this.planAmount = 132000),
                  (this.planName = "スタンダードプラン"));
        },
        setPayment() {
            switch (this.getUser.payment_type) {
                case "1":
                    this.paymentName = "クレジットカード";
                    break;
                case "2":
                    this.paymentName = "銀行振込";
                    break;
                case "3":
                    this.paymentName = "口座振替";
                    break;
                default:
                    this.paymentName = "口座振替";
                    break;
            }
        },
        goBack() {
            this.$router.push({
                name: "register-user",
            });
        },
        async submit() {
            try {
                if (this.getUser.payment_type == "1") {
                    //クレジットカードの場合のみ次の画面へ進む
                    this.$router.push({
                        name: "register-card",
                    });
                } else {
                    //クレジットカード以外の場合はここで申込み完了

                    this.loadingStatus = true;

                    // 企業情報レコード追加準備
                    let url = process.env.MIX_VUE_APP_API_URL + "com/register";
                    const datas = {
                        ...this.getUser,
                        register_token: localStorage.getItem("registerToken"),
                    };
                    if (process.env.MIX_DEV_MODE === 'true') {
                        datas.skip_mail = true;
                    }
                    delete datas.company_code;
                    delete datas.user_type;
                    delete datas.email_address;

                    // // 企業情報レコード追加
                    let response2 = await axios.post(url, datas);
                    if (response2.data.status == "NG") {
                        this.message = response2.data.message;

                        this.loadingStatus = false;
                        // setTimeout(() => {
                        //     this.message = false;
                        // }, 2000);
                    } else {
                        const paymentLabel = { 1: 'クレジットカード', 2: '銀行振込', 3: '口座振替' };
                        const planLabel = { 1: 'ライトプラン（60社）', 2: 'スタンダードプラン（120社）' };
                        let registrationInfo = null;

                        if (process.env.MIX_DEV_MODE === 'true') {
                            const company = response2.data.data.company;
                            const contract = response2.data.data.contract;
                            registrationInfo = {
                                companyCode: company.company_code,
                                companyId: company.id,
                                companyName: company.company_name,
                                postNumber: company.post_number,
                                address: company.address,
                                phoneNumber: company.phone_number,
                                companyRep: company.company_rep,
                                mobileNumber: company.mobile_number,
                                paymentType: paymentLabel[company.payment_type] || company.payment_type,
                                plan: planLabel[contract.plan_id] || contract.plan_id,
                                addLicenseCount: contract.add_license_count || 0,
                            };
                            sessionStorage.setItem('registrationInfo', JSON.stringify(registrationInfo));
                        }

                        this.$router.push({
                            name: "register-completion",
                            params: {
                                type: "register",
                                title: "申込完了",
                                message: registrationInfo
                                    ? ["ご登録ありがとうございます"]
                                    : [
                                        "ご登録ありがとうございます",
                                        "登録されたメールアドレスに「お申し込み内容」を送信いたしました",
                                        "ご確認お願いいたします",
                                    ],
                                currentStep: Number(4),
                                redirectPage: "toLogin",
                            },
                        });
                    }

                    this.loadingStatus = false;
                }
            } catch (e) {
                console.log(e);
                this.message = e;
            }
        },
    },
    beforeMount() {
        this.setPlan();
        this.setPayment();
    },
};
</script>
