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
                                <span class="form-column">**** **** **** {{ getCard.number }}</span>
                            </div>

                            <div class="form-row">
                                <label for="valid_year" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    有効期限
                                </label>
                                <span class="form-column">{{ getCard.valid_month }} / {{ getCard.valid_year }}</span>
                            </div>

                            <div class="form-row">
                                <label for="security_code" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    セキュリティコード
                                </label>
                                <span class="form-column">***</span>
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

                    <div class="text-center" v-if="this.stripe_msg">
                        <p class="text-danger">{{ this.stripe_msg }}</p>
                    </div>


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
            stripe_msg:"",
        }
    },
    created: function() {
        this.GetCardInfo();
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

async GetCardInfo(){

    let token = this.getCard.stripe_token;

    //カード情報の取得
    let url = "https://api.stripe.com/v1/tokens/" + token;
    const headers = {
        'Authorization' :'Bearer ' + process.env.MIX_VUE_APP_STRIPE_PRIVATE_KEY,
        'Content-Type': 'application/x-www-form-urlencoded'
    }

    try {
        let response = await axios.get(url, {headers: headers});
        console.log(response);
        let valid_month = response.data.card.exp_month;
        let valid_year = response.data.card.exp_year;
        let number = response.data.card.last4;

        this.getCard.valid_month = valid_month;
        this.getCard.valid_year = valid_year;
        this.getCard.number = number;

        if(response.status!="200" || card_id == null){
            console.log(response);
            this.message = response.data.message
            setTimeout(() => {this.message = false;}, 2000);
        }else{
        }

    } catch (e){
        console.log(e);
        this.message = e
    }

},

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
            params.append('name', this.getCard.name);
            params.append('source', this.getCard.stripe_token);

            try {
                let response = await axios.post(url, params, {headers: headers});

                if(response.status!="200"){

                    if(typeof response.data.message === 'undefined'){
                        this.stripe_msg = "クレジットカードの登録に失敗しました。戻って別のクレジットカードを登録してください";
                    }else{
                        this.stripe_msg = response.data.message;
                    }

                    setTimeout(() => {this.stripe_msg = false;}, 2000);
                } else{
                    datas.stripe_id = response.data.id;
                    // // 企業情報レコード追加
                    let response2 = await axios.post(url2, datas);
                    if(response2.data.status=="NG"){
                        this.message = response2.data.message
                        setTimeout(() => {this.message = false;}, 2000);
                    }

                    this.$router.push(
                        {
                            name: 'register-completion',
                            params: {
                                title: '申込完了',
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
