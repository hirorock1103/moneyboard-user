<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container">

                <h2 class="text-center  heading-primary">登録内容のご確認</h2>

                <form @submit.prevent="submit">

                    <ProgressBar :current-step="currentStep" />

                    <p class="text-center  margin-bottom--48">登録内容をご確認ください</p>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48  ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                基本情報
                            </h4>

                            <hr>

                            <div class="form-row">
                                <label for="company_name" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    名前
                                </label>

                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="company_name"
                                        class="form-input"
                                        v-model="getUser.company_name"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="address" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    住所
                                </label>

                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="address"
                                        class="form-input"
                                        v-model="getUser.address"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="phone_number" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    電話番号
                                </label>

                                <span class="form-column">
                                    <input
                                        type="tel"
                                        id="phone_number"
                                        class="form-input"
                                        autocomplete="tel"
                                        v-model="getUser.phone_number"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="company_rep" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    担当者名
                                </label>

                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="company_rep"
                                        class="form-input"
                                        v-model="getUser.company_rep"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="mobile_number" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    携帯番号
                                </label>

                                <span class="form-column">
                                    <input
                                        type="tel"
                                        id="mobile_number"
                                        class="form-input"
                                        autocomplete="tel"
                                        v-model="getUser.mobile_number"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row">
                                <label for="email_address" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    メールアドレス
                                </label>

                                <span class="form-column">
                                    <input
                                        type="email"
                                        id="email_address"
                                        class="form-input"
                                        v-model="getUser.email_address"
                                        readonly>
                                </span>
                            </div>


                        </div>

                    </article>



                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48  ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="[ icon  solid ] fa-key  padding-right--12  text-accent"></span>
                                パスワード
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
                                        v-model="getUser.password"
                                        readonly>
                                </span>
                            </div>


                        </div>

                    </article>



                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48  ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="[ icon  solid ] fa-key  padding-right--12  text-accent"></span>
                                アプリログイン　パスワード
                            </h4>

                            <hr>

                            <div class="form-row">
                                <label for="app_password" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    パスワード
                                </label>

                                <span class="form-column">
                                    <input
                                        type="password"
                                        id="app_password"
                                        class="form-input"
                                        v-model="getUser.app_password"
                                        readonly>
                                </span>
                            </div>

                        </div>

                    </article>



                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-right-medium--48 ]   [ margin-bottom--48  margin-bottom-large--80 ] ]">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="padding-right--12  vertical-middle">
                                    <img src="/images/common/money-icon.svg">
                                </span>
                                料金について
                                <small class="float-right-large  font-weight-normal  display-block  padding-left--24">価格はすべて税込表記</small>
                            </h4>

                            <hr>

                            <div class="form-row">
                                <label class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    プラン選択
                                </label>

                                <span class="form-column">
                                    <input
                                        type="radio"
                                        id="plan_id"
                                        class="form-radio"
                                        v-model="getUser.plan_id"
                                        checked
                                        disabled>
                                    <input
                                        type="text"
                                        class="form-input"
                                        v-model="planName"
                                        readonly>
                                </span>
                            </div>

                            <div class="form-row  margin-bottom--48"  v-if="getUser.additional_licences">
                                <label for="additional_licences" class="[ form-column  form-column--200 ]  [ form-label  form-label--inline-medium ]">
                                    企業データの追加
                                </label>

                                <span class="form-column">
                                    <input
                                        type="number"
                                        min="0"
                                        max="120"
                                        id="additional_licences"
                                        class="[ form-input  [ form-input--short  form-input--short-read ] ]"
                                        v-model="getUser.additional_licences"
                                        readonly>
                                    <span>社</span>
                                </span>
                            </div>

                            <h4>
                                月額料金は
                                <span class="h2  [ text-accent  text-kerning-small ]  [ padding-right--4  padding-left--4 ]">{{ $filters.addComma(totalAmount) }}</span>
                                円です
                            </h4>

                            <hr>

                            <table class="table  table-fixed">

                                <tbody>

                                    <tr class="display-none-large">
                                        <th>内訳</th>
                                        <td></td>
                                        <td class="[ display-none  display-table-cell-medium ]"></td>
                                    </tr>

                                    <tr>
                                        <th class="[ display-none  display-table-cell-large ]">内訳</th>
                                        <td>基本料金</td>
                                        <td>{{ $filters.addComma(planAmount) }}円</td>
                                        <td class="[ display-none  display-table-cell-large ]">（システム使用料と登録データ{{ companyAmount }}社分）</td>
                                        <td class="[ display-none  display-table-cell-medium  display-none-large ]"></td>
                                    </tr>

                                    <tr class="display-none-large">
                                        <td colspan="2">（システム使用料と登録データ{{ companyAmount }}社分）</td>
                                        <td class="[ display-none  display-table-cell-medium ]"></td>
                                    </tr>

                                    <tr v-if="getUser.additional_licences">
                                        <th class="[ display-none  display-table-cell-large ]"></th>
                                        <td>追加利用料金</td>
                                        <td>1,100円</td>
                                        <td class="[ display-none  display-table-cell-medium ]"></td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </article>



                    <article
                        class="padding--16  bg-gray  [ margin-left-medium--48  margin-right-medium--48 ]"
                        v-if="getUser.motivated_by">

                        <div class="padding--24  bg-white">

                            <h4>
                                <span class="[ icon  solid ] fa-question-circle  padding-right--12  text-accent"></span>
                                MoneyBoardを知ったきっかけを教えてください（任意）
                            </h4>

                            <hr>

                            <div class="form-row">
                                <span class="form-column">
                                    <input
                                        type="text"
                                        id="motivated_by"
                                        class="form-input"
                                        v-model="getUser.motivated_by"
                                        readonly>
                                </span>
                            </div>

                        </div>

                    </article>



                    <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">

                        <button @click="goBack()" class="[ btn  btn--gray ]  margin-right--24">内容修正</button>
                        <button type="submit" class="[ btn  btn--accent ]">カード登録へ</button>

                    </div>



                </form>

            </div>

        </section>

    </main>

</template>

<script>
import ProgressBar from '../../components/ProgressBarComponent.vue';

export default {
    name: 'register-user-confirm',
    components: {
        ProgressBar
    },

    data () {
        return {
            planAmount: null,
            planName: '',
            currentStep: 1,
        }
    },

    computed: {
        totalAmount() {
            return this.planAmount + (this.getUser.additional_licences * 1100);
        },
        companyAmount() {
            return this.planAmount == 55000 ? '60' : '120'
        },
        getUser() {
            return this.$store.getters['auth/user']
        },
    },

    methods: {
        setPlan() {
            this.getUser.plan_id == 0 ? (this.planAmount = 55000, this.planName = 'スタンダードプラン') : (this.planAmount = 132000, this.planName = 'プレミアムプラン');
        },

        goBack() {
            this.$router.push(
                {
                    name: 'register-user',
                }
            )
        },

        submit() {

            this.$router.push(
                {
                    name: 'register-card',
                }
            )
        }
    },

    beforeMount(){
        this.setPlan();
    },

}
</script>
