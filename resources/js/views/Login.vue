<template>
    <main>
        <section
            class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
        >
            <div class="container text-center">
                <h2 class="text-center heading-primary">ログイン</h2>

                <!-- タブ切り替え -->
                <div class="login-tabs">
                    <button
                        type="button"
                        class="login-tab-btn"
                        :class="{ 'login-tab-btn--active': activeTab === 'company' }"
                        @click="switchTab('company')"
                    >企業ログイン</button>
                    <button
                        type="button"
                        class="login-tab-btn"
                        :class="{ 'login-tab-btn--active': activeTab === 'staff' }"
                        @click="switchTab('staff')"
                    >担当者ログイン</button>
                </div>

                <!-- 企業ログインフォーム -->
                <form v-show="activeTab === 'company'" @submit.prevent="login" class="vld-parent">
                    <loading
                        v-model:active="loadingStatus"
                        :can-cancel="false"
                        :is-full-page="false"
                        :color="'#2FBCED'"
                        :height="90"
                        :width="100"
                    />
                    <article
                        class="padding--16 bg-gray [ margin-left-medium--48 margin-right-medium--48 margin-large--0 [ margin-bottom--48 margin-bottom-large--140 ] ] display-inline-block-large text-left"
                    >
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <div class="form-two-lined">
                                <label for="email_address" class="form-label">
                                    <span
                                        class="[ icon solid ] fa-envelope padding-right--8 text-accent"
                                    ></span>
                                    メールアドレス
                                </label>
                                <input
                                    type="email"
                                    id="email_address"
                                    class="form-input margin-top--8"
                                    v-model="loginForm.email_address"
                                    @input="v$.loginForm.email_address.$touch"
                                    v-bind:class="[
                                        v$.loginForm.email_address.$error
                                            ? 'form-error  margin-bottom--12'
                                            : 'margin-bottom--24',
                                    ]"
                                />
                                <div
                                    class="form-text text-danger margin-bottom--24"
                                    v-if="v$.loginForm.email_address.$error"
                                >
                                    {{
                                        v$.loginForm.email_address.$errors[0]
                                            .$message
                                    }}
                                </div>
                                <div
                                    class="form-text text-danger margin-bottom--24"
                                    v-if="
                                        loginErrors && loginErrors.email_address
                                    "
                                >
                                    <span
                                        v-for="msg in loginErrors.email_address"
                                        :key="msg"
                                        >{{ msg }}</span
                                    >
                                </div>
                                <label for="password" class="form-label">
                                    <span
                                        class="[ icon solid ] fa-key padding-right--8 text-accent"
                                    ></span>
                                    パスワード
                                </label>
                                <span style="position: relative;">
                                    <input
                                        :type="showPassword ? 'text' : 'password'"
                                        name="password"
                                        id="password"
                                        class="form-input margin-top--8"
                                        v-model="loginForm.password"
                                        @input="v$.loginForm.password.$touch"
                                        v-bind:class="[
                                            v$.loginForm.password.$error
                                                ? 'form-error  margin-bottom--12'
                                                : 'margin-bottom--24',
                                        ]"
                                    />
                                    <span style="position: absolute; top: 55%; left: 83%;">
                                        <span :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
                                        @click="showPassword = !showPassword"
                                        class="password-icon"></span>
                                    </span>
                                </span>
                                <div
                                    class="form-text text-danger"
                                    v-if="v$.loginForm.password.$error"
                                >
                                    {{
                                        v$.loginForm.password.$errors[0]
                                            .$message
                                    }}
                                </div>
                                <div
                                    class="text-center [ margin-top--48 [ margin-bottom--16 margin-bottom-large--24 ] ]"
                                >
                                    <p v-show="loginErrors" class="text-danger">
                                        {{ loginErrors }}
                                    </p>
                                    <button
                                        type="submit"
                                        class="[ btn btn--accent ]"
                                    >
                                        ログイン
                                    </button>
                                </div>
                                <div class="text-center">
                                    <router-link
                                        to="/password/email"
                                        class="btn btn--link"
                                        >パスワードを忘れた場合</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </article>
                </form>

                <!-- 担当者ログインフォーム -->
                <form v-show="activeTab === 'staff'" @submit.prevent="staffLogin" class="vld-parent">
                    <loading
                        v-model:active="loadingStatus"
                        :can-cancel="false"
                        :is-full-page="false"
                        :color="'#2FBCED'"
                        :height="90"
                        :width="100"
                    />
                    <article
                        class="padding--16 bg-gray [ margin-left-medium--48 margin-right-medium--48 margin-large--0 [ margin-bottom--48 margin-bottom-large--140 ] ] display-inline-block-large text-left"
                    >
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <div class="form-two-lined">
                                <!-- 企業ID -->
                                <label for="company_code" class="form-label">
                                    <span
                                        class="[ icon solid ] fa-building padding-right--8 text-accent"
                                    ></span>
                                    企業ID
                                </label>
                                <input
                                    type="text"
                                    id="company_code"
                                    class="form-input margin-top--8"
                                    v-model="staffForm.company_code"
                                    @input="v$.staffForm.company_code.$touch"
                                    @blur="fetchStaffList"
                                    v-bind:class="[
                                        v$.staffForm.company_code.$error
                                            ? 'form-error margin-bottom--12'
                                            : 'margin-bottom--24',
                                    ]"
                                />
                                <div
                                    class="form-text text-danger margin-bottom--24"
                                    v-if="v$.staffForm.company_code.$error"
                                >
                                    {{ v$.staffForm.company_code.$errors[0].$message }}
                                </div>

                                <!-- 担当者プルダウン -->
                                <label for="user_code" class="form-label">
                                    <span
                                        class="[ icon solid ] fa-user padding-right--8 text-accent"
                                    ></span>
                                    担当者
                                </label>
                                <select
                                    id="user_code"
                                    class="form-input form-select margin-top--8"
                                    v-model="staffForm.user_code"
                                    @change="v$.staffForm.user_code.$touch"
                                    :disabled="staffList.length === 0"
                                    v-bind:class="[
                                        v$.staffForm.user_code.$error
                                            ? 'form-error margin-bottom--12'
                                            : 'margin-bottom--24',
                                    ]"
                                >
                                    <option value="">担当者を選択してください</option>
                                    <option
                                        v-for="staff in staffList"
                                        :key="staff.user_code"
                                        :value="staff.user_code"
                                    >{{ staff.user_name }}</option>
                                </select>
                                <div
                                    class="form-text text-danger margin-bottom--24"
                                    v-if="v$.staffForm.user_code.$error"
                                >
                                    {{ v$.staffForm.user_code.$errors[0].$message }}
                                </div>

                                <!-- パスワード -->
                                <label for="staff_password" class="form-label">
                                    <span
                                        class="[ icon solid ] fa-key padding-right--8 text-accent"
                                    ></span>
                                    パスワード
                                </label>
                                <span style="position: relative;">
                                    <input
                                        :type="showStaffPassword ? 'text' : 'password'"
                                        name="staff_password"
                                        id="staff_password"
                                        class="form-input margin-top--8"
                                        v-model="staffForm.password"
                                        @input="v$.staffForm.password.$touch"
                                        v-bind:class="[
                                            v$.staffForm.password.$error
                                                ? 'form-error margin-bottom--12'
                                                : 'margin-bottom--24',
                                        ]"
                                    />
                                    <span style="position: absolute; top: 55%; left: 83%;">
                                        <span :class="showStaffPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
                                        @click="showStaffPassword = !showStaffPassword"
                                        class="password-icon"></span>
                                    </span>
                                </span>
                                <div
                                    class="form-text text-danger"
                                    v-if="v$.staffForm.password.$error"
                                >
                                    {{ v$.staffForm.password.$errors[0].$message }}
                                </div>

                                <!-- エラー・ボタン -->
                                <div
                                    class="text-center [ margin-top--48 [ margin-bottom--16 margin-bottom-large--24 ] ]"
                                >
                                    <p v-show="staffListError" class="text-danger">
                                        {{ staffListError }}
                                    </p>
                                    <p v-show="loginErrors" class="text-danger">
                                        {{ loginErrors }}
                                    </p>
                                    <button
                                        type="submit"
                                        class="[ btn btn--accent ]"
                                    >
                                        ログイン
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                </form>
            </div>
        </section>
    </main>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import { required, email, helpers } from "@vuelidate/validators";
import { mapState, mapActions } from "vuex";
import axios from "../src/plugins/axios.js";

export default {
    name: "/login",
    components: {
        Loading,
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            activeTab: "company",
            // 企業ログイン
            loginForm: {
                email_address: "",
                password: "",
            },
            showPassword: false,
            // 担当者ログイン
            staffForm: {
                company_code: "",
                user_code: "",
                password: "",
            },
            showStaffPassword: false,
            staffList: [],
            staffListError: null,
        };
    },
    validations() {
        return {
            loginForm: {
                email_address: {
                    required: helpers.withMessage(
                        "メールアドレスを入力してください",
                        required
                    ),
                    email: helpers.withMessage(
                        "正しい形を入力してください",
                        email
                    ),
                },
                password: {
                    required: helpers.withMessage(
                        "パスワードを入力してください",
                        required
                    ),
                },
            },
            staffForm: {
                company_code: {
                    required: helpers.withMessage(
                        "企業IDを入力してください",
                        required
                    ),
                },
                user_code: {
                    required: helpers.withMessage(
                        "担当者を選択してください",
                        required
                    ),
                },
                password: {
                    required: helpers.withMessage(
                        "パスワードを入力してください",
                        required
                    ),
                },
            },
        };
    },
    computed: {
        ...mapState({
            apiStatus: (state) => state.auth.apiStatus,
            loginErrors: (state) => state.auth.loginErrorMessages,
            loadingStatus: (state) => state.auth.loadingStatus,
        }),
    },
    methods: {
        ...mapActions("auth", ["sendLoginRequest", "sendStaffLoginRequest"]),
        switchTab(tab) {
            this.activeTab = tab;
            this.$store.commit("auth/setLoginErrorMessages", null);
            this.staffListError = null;
        },
        // 企業ログイン
        login() {
            this.v$.loginForm.$touch();
            if (this.v$.loginForm.$error) return;
            this.sendLoginRequest(this.loginForm).then(() => {
                if (this.apiStatus) {
                    this.$router.push({
                        name: "mypage-home",
                    });
                }
            });
        },
        // 担当者一覧取得
        async fetchStaffList() {
            this.staffListError = null;
            this.staffList = [];
            this.staffForm.user_code = "";

            if (!this.staffForm.company_code) return;

            try {
                const response = await axios.get(
                    process.env.MIX_VUE_APP_API_URL +
                    "app/user/index/all?company_code=" +
                    encodeURIComponent(this.staffForm.company_code) +
                    "&type=1"
                );
                if (response.data.status === "OK" && response.data.data && response.data.data.data_list) {
                    const dataList = response.data.data.data_list;
                    this.staffList = Array.isArray(dataList) ? dataList : (dataList.data || []);
                } else {
                    this.staffListError = "担当者の取得に失敗しました。企業IDを確認してください。";
                }
            } catch (e) {
                this.staffListError = "担当者の取得に失敗しました。ネットワーク接続を確認してください。";
            }
        },
        // 担当者ログイン
        staffLogin() {
            this.v$.staffForm.$touch();
            if (this.v$.staffForm.$error) return;
            this.sendStaffLoginRequest({
                company_code: this.staffForm.company_code,
                user_code: this.staffForm.user_code,
                password: this.staffForm.password,
            }).then(() => {
                if (this.apiStatus) {
                    this.$router.push({
                        name: "userpage",
                    });
                }
            });
        },
        clearError() {
            this.$store.commit("auth/setLoginErrorMessages", null);
            localStorage.removeItem("authToken");
        },
    },
    created() {
        this.clearError();
        this.$store.commit("auth/setLoadingStatus", false);
        sessionStorage.removeItem("client-search-params");
        sessionStorage.removeItem("premium-search-params");
    },
    mounted: function () {
        document.title = "ログイン | MoneyBoard";
    },
};
</script>

<style scoped>
.login-tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 24px;
}

.login-tab-btn {
    background-color: #f5f5f5;
    border: 1px solid #D5D5D5;
    color: #4E4E4E;
    cursor: pointer;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.1em;
    padding: 10px 32px;
    transition: all 0.15s ease;
}

.login-tab-btn:first-child {
    border-right: none;
    border-radius: 4px 0 0 4px;
}

.login-tab-btn:last-child {
    border-left: none;
    border-radius: 0 4px 4px 0;
}

.login-tab-btn--active {
    background-color: #2FBCED;
    border-color: #2FBCED;
    color: #ffffff;
}
</style>
