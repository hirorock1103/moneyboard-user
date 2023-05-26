<template>
    <main>
        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
            <div class="container">

                <loading v-model:active="loadingStatus"
                        :can-cancel="false"
                        :is-full-page="false"
                        :color="'#2FBCED'"
                        :height="90"
                        :width="100" />

                <h2 class="text-center  heading-primary">クレジットカードの登録</h2>
                <form @submit.prevent="createToken">
                    <ProgressBar :current-step="currentStep" />
                    <p class="text-center  margin-bottom--48">下記項目をすべてご記入ください</p>
                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48  ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">
                        <div class="padding--24  bg-white">
                            <h4>
                                <span class="[ icon  regular ] fa-credit-card  padding-right--12  text-accent"></span>
                                クレジットカード情報
                            </h4>


                            <hr>
                            <div class="group">

                            </div>
                            <div class="form-row">
                                <label for="card-number" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    番号
                                </label>
                                <span class="form-column">
                                    <div id="card-number" class="form-input"></div>
                                </span>
                            </div>
                            <div id="card-number-error" style="display:none;" class="form-text  text-danger [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"></div>
                            <div class="form-row">
                                <label for="card-expiry" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    有効期限
                                </label>
                                <span class="form-column">
                                    <div id="card-expiry" class="form-input"></div>
                                </span>
                            </div>
                            <div id="card-expiry-error" style="display:none;" class="form-text  text-danger [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"></div>
                            <div class="form-row">
                                <label for="card-cvc" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    セキュリティーコード
                                </label>
                                <span class="form-column">
                                    <div id="card-cvc" class="form-input"></div>
                                </span>
                            </div>
                            <div id="card-cvc-error" style="display:none;" class="form-text  text-danger [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"></div>
                            <span class="form-column">
                                <input
                                    type="hidden"
                                    id="stripe_token"
                                    class="form-input"
                                    v-model="getCard.stripe_token"
                                    @input="v$.getCard.stripe_token.$touch"
                                    v-bind:class="[ v$.getCard.stripe_token.$error ? 'form-error' : null ]">
                            </span>

                            <div class="form-row">
                                <label for="name" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    名義
                                </label>

                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="name"
                                        class="form-input"
                                        v-model="getCard.name"
                                        @input="v$.getCard.name.$touch"
                                        v-bind:class="[ v$.getCard.name.$error ? 'form-error' : null ]">
                                </span>
                            </div>
                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.getCard.name.$error">
                                {{ v$.getCard.name.$errors[0].$message }}
                            </div>

                            <div id="card-error" class="form-text  text-danger padding-left-large--24" style="display:none;"></div>

                            <p style="text-align:center">
                            <button @click="goBack()" class="[ btn  btn--gray ]  margin-right--24">戻る</button>
                            <button id="custom-button" class="[ btn btn--accent ]">確認</button>
                            </p>
                        </div>
                    </article>
                </form>
            </div>
        </section>
    </main>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required, minLength, numeric, maxValue, maxLength, helpers } from '@vuelidate/validators';
import containsAlphaSpace from '../../customValidators/containsAlphaSpace';
import ProgressBar from '../../components/ProgressBarComponent.vue';
import { mapActions } from 'vuex';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';


export default {
    name: 'register-card',
    components: {
        ProgressBar,
        Loading
    },

    setup() {
        return { v$: useVuelidate() };
    },

    data () {
        return {
            currentStep: 2,

            stripe: null,
            card: null,
            token: '',
            cardNumber: null,
            cardExpiry: null,
            cardCvc: null,
            loadingStatus:false,
        }
    },

    async mounted() {
        this.stripe = window.Stripe(process.env.MIX_VUE_APP_STRIPE_PUBLIC_KEY)
        const elements = this.stripe.elements()

        const elementStyles = {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                // lineHeight: '40px',
                fontWeight: 300,
                fontFamily: 'Helvetica Neue',
                fontSize: '15px',

                '::placeholder': {
                    color: '#CFD7E0',
                }
            },
            invalid: {
                color: "red"
            }
        };

        this.cardNumber = elements.create("cardNumber", {
            style: elementStyles,
            placeholder: ''
        });
        this.cardNumber.addEventListener('change', ({error}) => {
            this.displayCardError(error, 'card-number');
        });

        this.cardExpiry = elements.create("cardExpiry", {
            style: elementStyles,
            placeholder: ' 月 / 年'
        });
        this.cardExpiry.addEventListener('change', ({error}) => {
            this.displayCardError(error, 'card-expiry');
        });

        this.cardCvc = elements.create("cardCvc", {
            style: elementStyles,
            placeholder: ''
        });
        this.cardCvc.addEventListener('change', ({error}) => {
            this.displayCardError(error, 'card-cvc');
        });

        this.cardNumber.mount('#card-number');
        this.cardExpiry.mount('#card-expiry');
        this.cardCvc.mount('#card-cvc');

    },

    validations() {
        return {
            getCard: {
                number: {
                },
                valid_month: {
                },
                valid_year: {
                },
                security_code: {
                },
                name: {
                    required: helpers.withMessage(
                        '名義を入力してください',
                        required
                    ),
                    containsAlphaSpace: helpers.withMessage(
                        '大文字半角アルファベット 姓名の間にスペースを入力してください',
                        containsAlphaSpace
                    ),
                },
                stripe_token: {
                },
            },
        }
    },

    computed: {
        getCard() {
            return this.$store.getters['auth/card']
        },
    },

    methods: {
        ...mapActions('auth', ['updateCard']),

        register() {
            this.v$.$touch();
            if (this.v$.$error) return;

            this.updateCard(this.getCard);

            this.$router.push(
                {
                    name: 'register-card-confirm',
                }
            )
        },

        goBack() {
            this.$router.push(
                {
                    name: 'register-user-confirm',
                }
            )
        },

        displayCardError(error, targetId) {
            let inputDiv = document.getElementById(targetId);
            let errorDiv = document.getElementById(targetId+'-error');
            if (error) {
                inputDiv.classList.add("form-error");
                errorDiv.style.display = "block";
                errorDiv.textContent = error.message;
            } else {
                inputDiv.classList.remove("form-error");
                errorDiv.style.display = "none";
                errorDiv.textContent = '';
            }
        },

        async createToken () {

            this.loadingStatus = true;

            const { token, error } = await this.stripe.createToken(this.cardNumber);
            this.v$.$touch();
            if (error) {
                this.loadingStatus = false;
                console.log(error);
                // handle error here
                document.getElementById('card-error').innerHTML = error.message;
                return;
            }
            if (this.v$.$error) return;

            //作成したトークンを保存
            //CardField-numberの中のinputの値
            let test = document.getElementsByClassName('CardField-number');

            this.getCard.stripe_token = token.id;

            //クレカ確認画面に遷移
            this.$router.push({name: 'register-card-confirm'})

         },


    }

}
</script>


<style media="screen">
    .CardField-child{
        display:block;
    }
</style>
