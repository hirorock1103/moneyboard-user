<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container">

                <h2 class="text-center  heading-primary">新規登録</h2>

                <form @submit.prevent="signup" class="vld-parent">

                    <loading v-model:active="loadingStatus"
                            :can-cancel="false"
                            :is-full-page="false"
                            :color="'#2FBCED'"
                            :height="90"
                            :width="100" />

                    <article class="padding--16  bg-gray  [ margin-left-medium--48  margin-right-medium--48  margin-large--0 ]">

                        <div class="padding--24  bg-white">

                            <h4 class="margin-bottom--24">利用規約</h4>

                            <div class="table-scrollable  padding-right--8">

                                <small>日本国民は、正当に選挙された国会における代表者を通じて行動し、われらとわれらの子孫のために、諸国民との協和による成果と、わが国全土にわたつて自由のもたらす恵沢を確保し、政府の行為によつて再び戦争の惨禍が起ることのないやうにすることを決意し、ここに主権が国民に存することを宣言し、この憲法を確定する。そもそも国政は、国民の厳粛な信託によるものであつて、その権威は国民に由来し、その権力は国民の代表者がこれを行使し、その福利は国民がこれを享受する。これは人類普遍の原理であり、この憲法は、かかる原理に基くものである。われらは、これに反する一切の憲法、法令及び詔勅を排除する。日本国民は、恒久の平和を念願し、人間相互の関係を支配する崇高な理想を深く自覚するのであつて、平和を愛する諸国民の公正と信義に信頼して、われらの安全と生存を保持しようと決意した。われらは、平和を維持し、専制と隷従、圧迫と偏狭を地上から永遠に除去しようと努めてゐる国際社会において、名誉ある地位を占めたいと思ふ。われらは、全世界の国民が、ひとしく恐怖と欠乏から免かれ、平和のうちに生存する権利を有することを確認する。われらは、いづれの国家も、自国のことのみに専念して他国を無視してはならないのであつて、政治道徳の法則は、普遍的なものであり、この法則に従ふことは、自国の主権を維持し、他国と対等関係に立たうとする各国の責務であると信ずる。日本国民は、国家の名誉にかけ、全力をあげてこの崇高な理想と目的を達成することを誓ふ。日本国民は、正当に選挙された国会における代表者を通じて行動し、われらとわれらの子孫のために、諸国民との協和による成果と、わが国全土にわたつて自由のもたらす恵沢を確保し、政府の行為によつて再び戦争の惨禍が起ることのないやうにすることを決意し、ここに主権が国民に存することを宣言し、この憲法を確定する。そもそも国政は、日本国民は、正当に選挙された国会における代表者を通じて行動し、われらとわれらの子孫のために、諸国民との協和による成果と、わが国全土にわたつて自由のもたらす恵沢を確保し、政府の行為によつて再び戦争の惨禍が起ることのないやうにすることを決意し、ここに主権が国民に存することを宣言し、この憲法を確定する。そもそも国政は、国民の厳粛な信託によるものであつて、その権威は国民に由来し、その権力は国民の代表者がこれを行使し、その福利は国民がこれを享受する。これは人類普遍の原理であり、この憲法は、かかる原理に基くものである。われらは、これに反する一切の憲法、法令及び詔勅を排除する。日本国民は、恒久の平和を念願し、人間相互の関係を支配する崇高な理想を深く自覚するのであつて、平和を愛する諸国民の公正と信義に信頼して、われらの安全と生存を保持しようと決意した。われらは、平和を維持し、専制と隷従、圧迫と偏狭を地上から永遠に除去しようと努めてゐる国際社会において、名誉ある地位を占めたいと思ふ。われらは、全世界の国民が、ひとしく恐怖と欠乏から免かれ、平和のうちに生存する権利を有することを確認する。われらは、いづれの国家も、自国のことのみに専念して他国を無視してはならないのであつて、政治道徳の法則は、普遍的なものであり、この法則に従ふことは、自国の主権を維持し、他国と対等関係に立たうとする各国の責務であると信ずる。日本国民は、国家の名誉にかけ、全力をあげてこの崇高な理想と目的を達成することを誓ふ。日本国民は、正当に選挙された国会における代表者を通じて行動し、われらとわれらの子孫のために、諸国民との協和による成果と、わが国全土にわたつて自由のもたらす恵沢を確保し、政府の行為によつて再び戦争の惨禍が起ることのないやうにすることを決意し、ここに主権が国民に存することを宣言し、この憲法を確定する。そもそも国政は、</small>

                            </div>

                            <hr>

                            <div class="text-center  margin-bottom--48">

                                <input
                                    type="checkbox"
                                    id="confirm-checkbox"
                                    class="form-checkbox"
                                    v-model="checkbox.terms_accepted"
                                    v-bind:class="{ 'form-error': v$.checkbox.terms_accepted.$error }">
                                <label class="form-checkbox-label  margin-bottom--8" for="confirm-checkbox">上記内容に同意します</label>
                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="v$.checkbox.terms_accepted.$error">
                                    {{ v$.checkbox.terms_accepted.$errors[0].$message }}
                                </div>

                            </div>

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
                                    v-model="signupForm.email_address"
                                    @input="v$.signupForm.email_address.$touch"
                                    v-bind:class="[ v$.signupForm.email_address.$error ? 'form-error  margin-bottom--12' : 'margin-bottom--24']">
                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="v$.signupForm.email_address.$error">
                                    {{ v$.signupForm.email_address.$errors[0].$message }}
                                </div>

                                <p>{{ signupErrors }}</p>

                                <div
                                    class="form-text  text-danger  margin-bottom--24"
                                    v-if="signupErrors && signupErrors.email_address">
                                    <span v-for="msg in signupErrors.email_address" :key="msg">{{ msg }}</span>
                                </div>


                                <label
                                    for="email-confirmation"
                                    class="form-label">
                                    <span class="[ icon  solid ] fa-envelope  padding-right--8  text-accent"></span>
                                    メールアドレス　確認用
                                </label>
                                <input
                                    type="email"
                                    name="email_confirmation"
                                    id="email-confirmation"
                                    class="form-input  margin-top--8"
                                    v-model="signupForm.email_confirmation"
                                    @input="v$.signupForm.email_confirmation.$touch"
                                    v-bind:class="[ v$.signupForm.email_confirmation.$error ? 'form-error  margin-bottom--12' : 'margin-bottom--24']">
                                <div
                                    class="form-text  text-danger"
                                    v-if="v$.signupForm.email_confirmation.$error">
                                        {{ v$.signupForm.email_confirmation.$errors[0].$message }}
                                </div>

                            </div>

                        </div>

                    </article>

                    <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">

                        <button type="submit" class="[ btn  btn--accent ]" v-bind:disabled="checkbox.terms_accepted == false">登録</button>

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
import { required, email, sameAs, helpers } from '@vuelidate/validators';
import { mapState, mapActions } from 'vuex';

export default {
    name: 'signup',
    components: {
        Loading
    },

    setup() {
        return { v$: useVuelidate() };
    },

    data () {
        return {
            checkbox: {
                terms_accepted: false,
            },
            signupForm: {
                email_address: '',
                email_confirmation: ''
            },
        }
    },

    validations() {
        return {
            checkbox: {
                terms_accepted: {
                    required:helpers.withMessage(
                        '上記内容に同意してください',
                        required
                    )
                }
            },
            signupForm: {
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
                email_confirmation: {
                    required:helpers.withMessage(
                        '確認メールアドレスに再度入力してください',
                        required
                    ),
                    email:helpers.withMessage(
                        '正しい形を入力してください',
                        email
                    ),
                    sameAs:helpers.withMessage(
                        '確認メールアドレスがメールアドレスと違います',
                        sameAs(this.signupForm.email_address)
                    )
                },
            },
        }
    },

    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            signupErrors: state => state.auth.signupErrorMessages,
            loadingStatus: state => state.auth.loadingStatus,
        })
    },

    methods: {
        ...mapActions('auth', ['sendEmailRegisterRequest']),

        signup () {
            this.v$.$touch();
            if (this.v$.$error) return;

            this.sendEmailRegisterRequest({ email_address: this.signupForm.email_address }).then(() => {
                if (this.apiStatus) {
                    this.$router.push(
                        {
                            name: 'signup-completion',
                            params: {
                                title: 'メール送信完了',
                                message: [
                                    'メールが送信されました。メールのURLから登録手続きをお願いします。',
                                ],
                                redirectPage: 'home'
                            }
                        }
                    )
                }
            });
        },

        clearError () {
            this.$store.commit('auth/setSignupErrorMessages', null)
        }
    },

    created () {
        this.clearError()
    }
}
</script>
