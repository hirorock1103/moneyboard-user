<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container">

                <h2 class="text-center  heading-primary">パスワードの設定</h2>

                <form @submit.prevent="reset">

                    <loading v-model:active="loadingStatus"
                        :can-cancel="false"
                        :is-full-page="false"
                        :color="'#2FBCED'"
                        :height="90"
                        :width="100" />

                    <p class="text-center  margin-bottom--48">新しく設定するパスワードを入力して下さい</p>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48  ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="[ icon  solid ] fa-key  padding-right--12  text-accent"></span>
                                パスワードの設定
                                <small class="float-right-large  font-weight-normal  display-block  padding-left--24">10文字以上（半角アルファベット大文字、小文字、半角数字の3種類を組み合わせ）</small>
                            </h4>

                            <hr>

                            <div class="form-row">
                                <label for="password" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    パスワード
                                </label>

                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-input"
                                        v-model="password"
                                        @input="v$.password.$touch"
                                        v-bind:class="[ v$.password.$error ? 'form-error' : null ]">
                                </span>
                            </div>

                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.password.$error">
                                {{ v$.password.$errors[0].$message }}
                            </div>

                            <div
                                class="form-text  text-danger  margin-bottom--24"
                                v-if="passwordResetErrors && passwordResetErrors.errors.password">
                                <span v-for="msg in passwordResetErrors.errors.password" :key="msg">{{ msg }}</span>
                            </div>

                            <div class="form-row">
                                <label for="password_confirmation" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    パスワード　確認用
                                </label>

                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        class="form-input"
                                        v-model="password_confirmation"
                                        @input="v$.password_confirmation.$touch"
                                        v-bind:class="[ v$.password_confirmation.$error ? 'form-error' : null ]">
                                </span>
                            </div>

                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.password_confirmation.$error">
                                {{ v$.password_confirmation.$errors[0].$message }}
                            </div>


                        </div>

                    </article>



                    <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">

                        <p v-show="v$.$error" class="text-danger">入力に誤りがあります</p>

                        <button type="submit" class="[ btn  btn--accent ]">登録</button>

                    </div>



                </form>

            </div>

        </section>

    </main>

</template>

<script>
import useVuelidate from '@vuelidate/core';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import { required, minLength, sameAs, helpers } from '@vuelidate/validators';
import containsNumber from '../../customValidators/containsNumber';
import containsUppercase from '../../customValidators/containsUppercase';
import containsLowercase from '../../customValidators/containsLowercase';
import { mapState, mapActions } from 'vuex';

export default {
    name: 'password-reset',
    components: {
        Loading
    },

    setup() {
        return { v$: useVuelidate() };
    },

    data () {
        return {
            password: '',
            password_confirmation: '',
        }
    },

    validations() {
        return {
            password: {
                required: helpers.withMessage(
                    'パスワードを入力してください',
                    required
                ),
                minLength: helpers.withMessage(
                    '10文字以上を入力してください',
                    minLength(10)
                ),
                containsNumber: helpers.withMessage(
                    '半角数字を含めてください',
                    containsNumber
                ),
                containsUppercase: helpers.withMessage(
                    '大文字を含めてください',
                    containsUppercase
                ),
                containsLowercase: helpers.withMessage(
                    '小文字を含めてください',
                    containsLowercase
                ),
            },
            password_confirmation: {
                required: helpers.withMessage(
                    '確認パスワードを入力してください',
                    required
                ),
                sameAs: helpers.withMessage(
                    '確認パスワードはパスワードと違います',
                    sameAs(this.password)
                ),
            }
        }
    },

    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            passwordResetErrors: state => state.auth.passwordResetErrorMessages,
            loadingStatus: state => state.auth.loadingStatus,
        })
    },

    methods: {
        ...mapActions('auth', ['sendPasswordResetRequest']),

        reset () {
            this.v$.$touch();
            if (this.v$.$error) return;

            this.sendPasswordResetRequest(this.password).then(() => {
                if (this.apiStatus) {
                    this.$router.push(
                        {
                            name: 'request-completion',
                            params: {
                                title: 'パスワード設定完了',
                                message: [
                                    'パスワードの設定が完了いたしました。',
                                ],
                                redirectPage: 'login'
                            }
                        }
                    )
                }
            });
        },

        clearError () {
            this.$store.commit('auth/setPasswordResetErrorMessages', null)
        }
    },

    created () {
        this.clearError()
    }
}
</script>
