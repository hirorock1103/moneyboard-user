<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container">

                <h2 class="text-center  heading-primary">クレジットカードの登録</h2>

                <form @submit.prevent="register">

                    <ProgressBar :current-step="currentStep" />

                    <p class="text-center  margin-bottom--48">下記項目をすべてご記入ください</p>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48  ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="[ icon  regular ] fa-credit-card  padding-right--12  text-accent"></span>
                                クレジットカード情報
                            </h4>

                            <hr>

                            <div class="form-row">
                                <label for="number" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    番号
                                </label>

                                <span class="form-column">
                                    <input
                                        type="number"
                                        id="number"
                                        class="form-input"
                                        v-model="getCard.number"
                                        @input="v$.getCard.number.$touch"
                                        v-bind:class="[ v$.getCard.number.$error ? 'form-error' : null ]">
                                </span>
                            </div>

                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.getCard.number.$error">
                                {{ v$.getCard.number.$errors[0].$message }}
                            </div>

                            <div class="form-row">
                                <label for="valid-year" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    有効期限
                                </label>

                                <span class="form-column">
                                    <input
                                        type="number"
                                        min="0"
                                        max="12"
                                        oninput="validity.valid||(value='');"
                                        id="valid-month"
                                        class="[ form-input  form-input--short ]"
                                        placeholder="月"
                                        v-model="getCard.valid_month"
                                        @input="v$.getCard.valid_month.$touch"
                                        v-bind:class="[ v$.getCard.valid_month.$error ? 'form-error' : null ]">

                                    <span class="margin-right--8">/</span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="99"
                                        oninput="validity.valid||(value='');"
                                        id="valid-year"
                                        class="[ form-input  form-input--short ]" placeholder="年"
                                        v-model="getCard.valid_year"
                                        @input="v$.getCard.valid_year.$touch"
                                        v-bind:class="[ v$.getCard.valid_year.$error ? 'form-error' : null ]">
                                </span>
                            </div>

                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.getCard.valid_month.$error">
                                {{ v$.getCard.valid_month.$errors[0].$message }}
                            </div>

                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.getCard.valid_year.$error">
                                {{ v$.getCard.valid_year.$errors[0].$message }}
                            </div>

                            <div class="form-row">
                                <label for="security-code" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    セキュリティコード
                                </label>

                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="security-code"
                                        class="form-input"
                                        v-model="getCard.security_code"
                                        @input="v$.getCard.security_code.$touch"
                                        v-bind:class="[ v$.getCard.security_code.$error ? 'form-error' : null ]">
                                </span>
                            </div>

                            <div
                                class="form-text  text-danger  [ margin-bottom--24  margin-left-large--164 ]  padding-left-large--48"
                                v-if="v$.getCard.security_code.$error">
                                {{ v$.getCard.security_code.$errors[0].$message }}
                            </div>

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


                        </div>

                    </article>



                    <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">

                        <p v-show="v$.$error" class="text-danger">入力に誤りがあります</p>

                        <button @click="goBack()" class="[ btn  btn--gray ]  margin-right--24">戻る</button>
                        <button type="submit" class="[ btn  btn--accent ]">確認</button>

                    </div>



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

export default {
    name: 'register-card',
    components: {
        ProgressBar
    },

    setup() {
        return { v$: useVuelidate() };
    },

    data () {
        return {
            currentStep: 2,
        }
    },

    validations() {
        return {
            getCard: {
                number: {
                    required: helpers.withMessage(
                        '番号を入力してください',
                        required
                    ),
                    minLength: helpers.withMessage(
                        '14~16桁を入力してください',
                        minLength(14)
                    ),
                    maxLength: helpers.withMessage(
                        '14~16桁を入力してください',
                        maxLength(16)
                    ),
                    numeric: helpers.withMessage(
                        '数字のみを入力してください',
                        numeric
                    )
                },
                valid_month: {
                    required: helpers.withMessage(
                        '有効期限を入力してください',
                        required
                    ),
                    numeric: helpers.withMessage(
                        '数字のみを入力してください',
                        numeric
                    ),
                    maxValue: helpers.withMessage(
                        '12以下の数値を指定してください',
                        maxValue(12)
                    )
                },
                valid_year: {
                    required: helpers.withMessage(
                        '有効期限を入力してください',
                        required
                    ),
                    numeric: helpers.withMessage(
                        '数字のみを入力してください',
                        numeric
                    ),
                    maxValue: helpers.withMessage(
                        '99以下の数値を指定してください',
                        maxValue(99)
                    )
                },
                security_code: {
                    required: helpers.withMessage(
                        'セキュリティコードを入力してください',
                        required
                    ),
                    numeric: helpers.withMessage(
                        '数字のみを入力してください',
                        numeric
                    ),
                    maxLength: helpers.withMessage(
                        '3桁を入力してください',
                        maxLength(3)
                    )
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
            },
        }
    },

    computed: {
        getCard() {
            return this.$store.getters['auth/card']
        }
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
    }

}
</script>
