<template>
    <main>
        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
            <div class="container  text-center">
                <h2 class="text-center  heading-primary">ログイン</h2>
                <form @submit.prevent="login" class="vld-parent">
                    <loading v-model:active="loadingStatus"
                            :can-cancel="false"
                            :is-full-page="false"
                            :color="'#2FBCED'"
                            :height="90"
                            :width="100" />
                    <article class="padding--16  bg-gray  [ margin-left-medium--48  margin-right-medium--48  margin-large--0  [ margin-bottom--48  margin-bottom-large--140 ] ]  display-inline-block-large  text-left">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <div class="form-two-lined">
                                <label
                                    for="email_address"
                                    class="form-label">
                                    <span class="[ icon  solid ] fa-envelope  padding-right--8  text-accent"></span>
                                    メールアドレス
                                </label>
                                <input
                                    type="email"
                                    id="email_address"
                                    class="form-input  margin-top--8"
                                    v-model="loginForm.email_address"
                                    @input="v$.loginForm.email_address.$touch"
                                    v-bind:class="[ v$.loginForm.email_address.$error ? 'form-error  margin-bottom--12' : 'margin-bottom--24']">
                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="v$.loginForm.email_address.$error">
                                    {{ v$.loginForm.email_address.$errors[0].$message }}
                                </div>
                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="loginErrors && loginErrors.email_address">
                                    <span v-for="msg in loginErrors.email_address" :key="msg">{{ msg }}</span>
                                </div>
                                <label
                                    for="password"
                                    class="form-label">
                                    <span class="[ icon  solid ] fa-key  padding-right--8  text-accent"></span>
                                    パスワード
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-input  margin-top--8"
                                    v-model="loginForm.password"
                                    @input="v$.loginForm.password.$touch"
                                    v-bind:class="[ v$.loginForm.password.$error ? 'form-error  margin-bottom--12' : 'margin-bottom--24']">
                                <div
                                    class="form-text  text-danger"
                                    v-if="v$.loginForm.password.$error">
                                    {{ v$.loginForm.password.$errors[0].$message }}
                                </div>
                                <div class="text-center  [  margin-top--48  [ margin-bottom--16  margin-bottom-large--24 ] ]">
                                    <p v-show="loginErrors" class="text-danger">{{loginErrors}}</p>
                                    <button type="submit" class="[ btn  btn--accent ]">ログイン</button>
                                </div>
                                <div class="text-center">
                                    <router-link to="/password/email" class="btn  btn--link">パスワードを忘れた場合</router-link>
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
import useVuelidate from '@vuelidate/core';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import { required, email, helpers } from '@vuelidate/validators';
import { mapState, mapActions } from 'vuex';

export default {
    name: '/login',
    components: {
        Loading
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data () {
        return {
            loginForm: {
                email_address: '',
                password: ''
            },
        }
    },
    validations() {
        return {
            loginForm: {
                email_address: {
                    required:helpers.withMessage(
                        'メールアドレスを入力してください',
                        required
                    ),
                    email:helpers.withMessage(
                        '正しい形を入力してください',
                        email
                    ),
                },
                password: {
                    required:helpers.withMessage(
                        'パスワードを入力してください',
                        required
                    )
                },
            },
        }
    },
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            loginErrors: state => state.auth.loginErrorMessages,
            loadingStatus: state => state.auth.loadingStatus,
        })
    },
    methods: {
        ...mapActions('auth', ['sendLoginRequest']),
        login () {
            this.v$.$touch();
            if (this.v$.$error) return;
            this.sendLoginRequest(this.loginForm).then(() => {
                if (this.apiStatus) {
                    this.$router.push(
                        {
                            name: 'mypage-home',
                        }
                    )
                }
            });
        },
        clearError () {
            this.$store.commit('auth/setLoginErrorMessages', null)
        }
    },
    created () {
        this.clearError()
    }
}
</script>
