<template>
    <div class="display-flex">
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
                            担当者情報の登録
                        </h2>
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <form v-on:submit.prevent="validateItem">
                        <article
                            class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--48 margin-bottom-large--88 ] ]"
                        >
                            <div
                                class="[ padding--24 padding-large--48 ] bg-white"
                            >
                                <h4 style="margin-bottom: 16px">
                                    <span
                                        class="[ icon solid ] fa-pencil-alt padding-right--12 text-accent"
                                    ></span>
                                    担当者情報
                                </h4>
                                <div style="display: flex">
                                    <h5 style="margin-bottom: 4px">※　</h5>
                                    <h5
                                        style="
                                            text-decoration: underline;
                                            margin-bottom: 4px;
                                        "
                                    >
                                        8文字以上（半角のアルファベット大文字、小文字、数字の3種類の組み合わせ）
                                    </h5>
                                </div>
                                <hr />
                                <div class="table padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    担当者名
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    <input
                                                        type="text"
                                                        id="user_name"
                                                        class="form-input margin-top--8 form-control"
                                                        v-model="item.user_name"
                                                        @input="
                                                            v$.item.user_name
                                                                .$touch
                                                        "
                                                        v-bind:class="[
                                                            v$.item.user_name
                                                                .$error
                                                                ? 'form-error'
                                                                : null,
                                                        ]"
                                                    />
                                                    <div
                                                        class="form-text text-danger text-center"
                                                        v-if="
                                                            v$.item.user_name
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.item.user_name
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    パスワード　※
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    <input
                                                        :type="
                                                            showPassword
                                                                ? 'text'
                                                                : 'password'
                                                        "
                                                        id="password"
                                                        class="form-input margin-top--8 form-control"
                                                        v-model="item.password"
                                                        @input="
                                                            v$.item.password
                                                                .$touch
                                                        "
                                                        v-bind:class="[
                                                            v$.item.password
                                                                .$error
                                                                ? 'form-error'
                                                                : null,
                                                        ]"
                                                    />
                                                    <span class="input-icon">
                                                        <span
                                                            :class="
                                                                showPassword
                                                                    ? 'fas fa-eye-slash'
                                                                    : 'fas fa-eye'
                                                            "
                                                            @click="
                                                                showPassword =
                                                                    !showPassword
                                                            "
                                                            class="password-icon"
                                                        ></span>
                                                    </span>
                                                    <div
                                                        class="form-text text-danger text-center"
                                                        v-if="
                                                            v$.item.password
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.item.password
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    確認用パスワード
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    <input
                                                        :type="
                                                            confirmationPassword
                                                                ? 'text'
                                                                : 'password'
                                                        "
                                                        id="password_confirm"
                                                        class="form-input margin-top--8 form-control"
                                                        v-model="
                                                            item.password_confirm
                                                        "
                                                        @input="
                                                            v$.item
                                                                .password_confirm
                                                                .$touch
                                                        "
                                                        v-bind:class="[
                                                            v$.item
                                                                .password_confirm
                                                                .$error
                                                                ? 'form-error'
                                                                : null,
                                                        ]"
                                                    />
                                                    <span class="input-icon">
                                                        <span
                                                            :class="
                                                                confirmationPassword
                                                                    ? 'fas fa-eye-slash'
                                                                    : 'fas fa-eye'
                                                            "
                                                            @click="
                                                                confirmationPassword =
                                                                    !confirmationPassword
                                                            "
                                                            class="password-icon"
                                                        ></span>
                                                    </span>
                                                    <div
                                                        class="form-text text-danger text-center"
                                                        v-if="
                                                            v$.item
                                                                .password_confirm
                                                                .$error
                                                        "
                                                    >
                                                        {{
                                                            v$.item
                                                                .password_confirm
                                                                .$errors[0]
                                                                .$message
                                                        }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div class="text-center">
                            <p v-show="v$.$error" class="text-danger">
                                入力に誤りがあります
                            </p>
                        </div>
                        <div
                            class="text-center [ margin-bottom-medium--0 margin-bottom--48 ]"
                        >
                            <router-link
                                to="/mypage/company/reps-list"
                                class="[ btn btn--outline ] [ margin-right--24 margin-right-medium--24 margin-right-large--24 ]"
                                >戻る</router-link
                            >
                            <input
                                type="submit"
                                class="[ btn btn--accent ]"
                                value="確認"
                            />
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { mapActions } from "vuex";
import {
    required,
    minLength,
    maxLength,
    sameAs,
    helpers,
} from "@vuelidate/validators";
import containsNumber from "../../../customValidators/containsNumber";
import containsUppercase from "../../../customValidators/containsUppercase";
import containsLowercase from "../../../customValidators/containsLowercase";
import axios from "../../../src/plugins/axios.js";
import SideMenu from "../../../components/SideMenuComponent.vue";

export default {
    components: {
        SideMenu,
        name: "validateItem",
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            item: {},
            message: "",
            showPassword: false,
            confirmationPassword: false,
        };
    },
    validations() {
        return {
            item: {
                user_name: {
                    required: helpers.withMessage(
                        "担当者名を入力してください",
                        required
                    ),
                    maxLength: helpers.withMessage(
                        "16文字以下で入力してください",
                        maxLength(16)
                    ),
                },
                password: {
                    required: helpers.withMessage(
                        "パスワードを入力してください",
                        required
                    ),
                    minLength: helpers.withMessage(
                        "8文字以上を入力してください",
                        minLength(8)
                    ),
                    maxLength: helpers.withMessage(
                        "255文字以下で入力してください",
                        maxLength(255)
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
                        "確認用パスワードを入力してください",
                        required
                    ),
                    sameAs: helpers.withMessage(
                        "確認用パスワードはパスワードと違います",
                        sameAs(this.item.password)
                    ),
                    minLength: helpers.withMessage(
                        "8文字以上を入力してください",
                        minLength(8)
                    ),
                },
            },
        };
    },
    computed: {
        getTemps() {
            return this.$store.getters["auth/temps"];
        },
    },
    mounted: function () {
        document.title = "担当者情報の登録 | MoneyBoard";
        this.item.user_name = (this.getTemps || {}).user_name;
        this.item.password = (this.getTemps || {}).password;
        this.item.password_confirm = (this.getTemps || {}).password_confirm;
    },
    methods: {
        ...mapActions("auth", ["updateTemps", "resetTemps"]),
        async validateItem() {
            this.v$.$touch();
            if (this.v$.$error) return;
            let url =
                process.env.MIX_VUE_APP_API_URL + "com/user/register-validate";
            try {
                this.item = {
                    ...this.item,
                    company_code: this.$store.state.auth.user.company_code,
                };
                const response = await axios.post(url, this.item);
                if (response.data.status == "NG") {
                    this.message = response.data.message;
                    setTimeout(() => {
                        this.message = false;
                    }, 2000);
                } else {
                    this.resetTemps();
                    this.updateTemps(this.item);
                    this.$router.push({ name: "mypage-reps_confirm" });
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

// ToDo:状態管理うまくいかない（値の保持の件）
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
