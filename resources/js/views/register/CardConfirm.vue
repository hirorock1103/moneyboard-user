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
                                        readonly>**** **** **** ****
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="valid_year" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    有効期限
                                </label>

                                <span class="form-column">** / **
                                    <input
                                        type="number"
                                        id="valid_month"
                                        class="[ form-input  [ form-input--short  form-input--short-read ] ]"
                                        v-model="getCard.valid_month"
                                        readonly>

                                    <span></span>

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
                                        readonly>***
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="stripe_token" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    トークン（開発用に表示しているが不要）
                                </label>

                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="stripe_token"
                                        class="form-input"
                                        v-model="getCard.stripe_token"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="stripe_token" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
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
                        <br>※戻った場合はクレジットカード情報はクリアされます
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
        getUser() {
            return this.$store.getters['auth/user']
        },
    },

    methods: {
//        ...mapActions('auth', ['registerUserInfo']),

        async register() {

            // 企業情報レコード追加準備
            let url2 = process.env.MIX_VUE_APP_API_URL + "com/register";
            const datas = {...this.getUser, register_token: localStorage.getItem('registerToken')}
            delete datas.company_code;
            delete datas.user_type;
            delete datas.email_address;

            let url = process.env.MIX_VUE_STRIPE_API_URL;
            const headers = {
                'Authorization' :'Bearer ' + process.env.MIX_VUE_APP_STRIPE_PRIVATE_KEY,
                'Content-Type': 'application/x-www-form-urlencoded'
            }

            let params = new URLSearchParams();
            // params.append('email', VUEXに保存されてるメアド);
            params.append('name', this.getCard.name);
            params.append('source', this.getCard.stripe_token);

            try {
console.log(url);
console.log(params);
console.log(headers);


                let response = await axios.post(url, params, {headers: headers});
                console.log(response);
                if(response.status!="200"){

                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else{
                    console.log('-- stripe_id --');
                    console.log(response.data.id);
                    console.log('--------');

                    datas.stripe_id = response.data.id;

                    console.log('-- datas --');
                    console.log(datas);
                    console.log('--------');

                    // // 企業情報レコード追加
                    let response2 = await axios.post(url2, datas);
                    if(response2.data.status=="NG"){
                        console.log(response2, datas);
                        this.message = response2.data.message
                        setTimeout(() => {this.message = false;}, 2000);
                    }
                    // else {
                    //     this.resetTemps();
                    // }


                    // this.resetTemps();
                    this.$router.push(
                        {
                            name: 'register-completion',
                            params: {
                                title: 'メール送信完了',
                                message: [
                                    'ご登録ありがとうございます。',
                                    '登録されたメールアドレスとパスワードを使い「ログイン」ボタンからログインしてください。',
                                ],
                                currentStep: Number(4),
                                redirectPage: 'login'
                            }
                        }
                    )
                }
            } catch (e){
                console.log(e);
                this.message = e
            }
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
