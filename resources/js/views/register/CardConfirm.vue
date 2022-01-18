<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container">

                <h2 class="text-center  heading-primary">登録内容のご確認</h2>

                <form @submit.prevent="register">

                    <ProgressBar :current-step="currentStep" />

                    <p class="text-center  margin-bottom--48">登録内容をご確認ください</p>

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
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="valid_year" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    有効期限
                                </label>

                                <span class="form-column">
                                    <input
                                        type="number"
                                        id="valid_month"
                                        class="[ form-input  [ form-input--short  form-input--short-read ] ]"
                                        v-model="getCard.valid_month"
                                        readonly>

                                    <span>/</span>

                                    <input
                                        type="number"
                                        id="valid_year"
                                        class="[ form-input  [ form-input--short  form-input--short-read ] ]"
                                        v-model="getCard.valid_year"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="security_code" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    セキュリティコード
                                </label>

                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="security_code"
                                        class="form-input"
                                        v-model="getCard.security_code"
                                        readonly>
                                </span>
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
                                        readonly>
                                </span>
                            </div>


                        </div>

                    </article>

                    <div class="text-center">

                        <input
                            type="checkbox"
                            id="confirm-checkbox"
                            class="form-checkbox"
                            v-model="checkbox.confirmed">
                        <label class="form-checkbox-label" for="confirm-checkbox">上記内容で申し込みます</label>

                    </div>



                    <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">

                        <button @click="goBack()" class="[ btn  btn--gray ]  margin-right--24">戻る</button>
                        <button type="submit" class="[ btn  btn--accent ]" v-bind:disabled="checkbox.confirmed == false">申し込み</button>

                    </div>



                </form>

            </div>

        </section>

    </main>

</template>

<script>
import ProgressBar from '../../components/ProgressBarComponent.vue';

export default {
    name: 'register-card-confirm',
    components: {
        ProgressBar
    },

    data () {
        return {
            currentStep: 3,
            checkbox: {
                confirmed: false,
            },
        }
    },

    computed: {
        getCard() {
            return this.$store.getters['auth/card']
        },
    },

    methods: {
        register() {

            this.$router.push(
                {
                    name: 'register-completion',
                    params: {
                        title: 'メール送信完了',
                        message: [
                            'ご登録ありがとうございます。',
                            '登録されたメールアドレスに「アプリ内で使用するID」「基本情報内容」を送信しました。',
                            'ご確認お願いします。',
                        ],
                        currentStep: Number(4),
                        redirectPage: 'login'
                    }
                }
            )
        },

        goBack() {
            this.$router.push(
                {
                    name: 'register-card',
                }
            )
        },
    }

}
</script>
