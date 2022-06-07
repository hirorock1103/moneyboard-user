<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container  text-center">

                <loading v-model:active="loadingStatus"
                        :can-cancel="false"
                        :is-full-page="false"
                        :color="'#2FBCED'"
                        :height="90"
                        :width="100" />

                <h2 class="text-center  heading-primary">パスワードの再発行</h2>

                <p class="text-center  margin-bottom--48">登録されているメールアドレスを入力して下さい</p>

                <form @submit.prevent="submit" class="vld-parent">

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
                                    v-model="email_address"
                                    @input="v$.email_address.$touch"
                                    v-bind:class="[ v$.email_address.$error ? 'form-error  margin-bottom--12' : 'margin-bottom--24']">
                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="v$.email_address.$error">
                                    {{ v$.email_address.$errors[0].$message }}
                                </div>

                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="resetLinkErrors && resetLinkErrors.errors.email_address">
                                    <span v-for="msg in resetLinkErrors.errors.email_address" :key="msg">{{ msg }}</span>
                                </div>

                                <div class="text-center  margin-top--48">

                                    <button type="submit" class="[ btn  btn--accent ]">メール送信</button>

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
    name: 'password-email',
    components: {
        Loading
    },

    setup() {
        return { v$: useVuelidate() };
    },

    data () {
        return {
            api_data: {
                email_address: '',
                password: ''
            },
            email_address: '',
            loadingStatus:false,
        }
    },

    validations() {
        return {
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
        }
    },

    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            resetLinkErrors: state => state.auth.resetLinkErrorMessages,
            loadingStatus: state => state.auth.loadingStatus,
        })
    },

    methods: {
        ...mapActions('auth', ['sendResetLinkRequest']),

        submit () {
            this.v$.$touch();
            if (this.v$.$error) return;

            this.loadingStatus = true;

            this.api_data.email_address = this.email_address;
            this.sendResetLinkRequest(this.api_data).then(() => {
                if (this.apiStatus) {
                    this.$router.push(
                        {
                            name: 'request-completion',
                            params: {
                                title: 'メール送信完了',
                                message: [
                                    'メールが送信されました。メールのURLからパスワードの再設定をお願いします。',
                                ],
                                redirectPage: 'home'
                            }
                        }
                    )
                }
            });

            this.loadingStatus = false;

        },

        clearError () {
            this.$store.commit('auth/setResetLinkErrorMessages', null)
        }
    },

    created () {
        this.clearError()
    },

    mounted: function(){
        document.title = "パスワードの再発行 | MoneyBoard"
    },

}
</script>
