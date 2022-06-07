<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            プラン変更/追加企業数の増減
                        </h2>
                        <h5 class="margin-bottom--16">
                            価格はすべて税込表記
                        </h5>
                    </div>


                    <form>
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--24  margin-bottom-large--24 ] ]">

                            <div class="[ padding--24  padding-large--48 ]  bg-white" style="padding-bottom:0!important;">
                                <h4>
                                    ご利用中のプラン
                                </h4>
                                <hr>
                                <div class="table-scrollable  padding-right--8 padding-bottom--24">
                                    <table class="table width-80">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    プラン名
                                                </th>
                                                <td>
                                                    <span v-if="getContract.plan_id === 1">
                                                        スタンダードプラン(使用できる企業数：60社)
                                                    </span>
                                                    <span v-else>
                                                        プレミアムプラン(使用できる企業数：120社)
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    追加企業数
                                                </th>
                                                <td>
                                                    {{getContract.add_license_count}}社
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    月額料金
                                                </th>
                                                <td>
                                                    {{$filters.addComma(Number(getContract.price))}}円
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4 style="color:fuchsia;">変更</h4>
                                <p style="margin-bottom:0;font-weight:bold; color: red; font-size: 14px;">※「プレミアムプラン」への変更や「企業数の追加数」の増加は、"すぐ"に更新されます。</p>
                                <p style="margin-bottom:0;font-weight:bold; color: red; font-size: 14px;">※「スタンダードプラン」への変更や「企業数の追加数」の減少は、"来月"に更新されます。</p>
                                <hr>
                                <div class="table-scrollable  padding-right--8 padding-bottom--24">
                                    <table class="table width-80">
                                        <tbody>

                                            <tr>
                                                <th class="nowrap">
                                                    プラン名
                                                </th>
                                                <td class="padding-bottom--16 nowrap">
                                                    <input
                                                        type="radio"
                                                        id="confirm-radio-s"
                                                        class="form-radio"
                                                        value="1"
                                                        v-model="plans.plan_id"
                                                        @change="changePlan(55000, 60)">
                                                    <label class="form-radio-label  margin-bottom--8" for="confirm-radio-s">スタンダードプラン<br>(使用できる企業数：60社)</label>
                                                </td>
                                                <td class="padding-bottom--16 nowrap">
                                                    <input
                                                        type="radio"
                                                        id="confirm-radio-p"
                                                        class="form-radio"
                                                        value="2"
                                                        v-model="plans.plan_id"
                                                        @change="changePlan(132000, 120)">
                                                    <label class="form-radio-label  margin-bottom--8" for="confirm-radio-p">プレミアムプラン<br>(使用できる企業数：120社)</label>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="nowrap">
                                                    追加企業数
                                                </th>
                                                <td class="padding-bottom--16 nowrap" style="display: flex;">
                                                    <input
                                                        type="number"
                                                        max=9999
                                                        min=0
                                                        class="form-input"
                                                        v-model="plans.additional_licenses"
                                                        @input="changeData(plans.additional_licenses)"
                                                        v-bind:class="[ v$.plans.additional_licenses.$error ? 'form-error' : null ]">
                                                        <span class="margin-left--12" style="display: flex;align-items: center;justify-content: center;">社</span>
                                                </td>

                                                <td
                                                    class="form-text  text-danger  text-center"
                                                    v-if="v$.plans.additional_licenses.$error">
                                                    {{ v$.plans.additional_licenses.$errors[0].$message }}
                                                </td>


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <h4><span class="[ icon  solid ] fa-yen-sign  padding-right--12  text-accent"></span>
                                    変更後の月額料金
                                    <span class="padding-left--8  text-accent" v-if="plans != undefined">
                                        {{$filters.addComma(Number(plans.cost_total))}}
                                    </span>
                                    円
                                </h4>
                                <hr>
                                <div class="table-scrollable  padding-right--8">
                                    <table class="table width-30 nowrap">
                                        <tbody>
                                            <tr>
                                                <th class="">
                                                    内訳
                                                </th>
                                                <td class="padding-bottom--16">
                                                    基本料金
                                                </td>
                                                <td class="padding-bottom--16 text-right" v-if="plans != undefined">
                                                    {{$filters.addComma(Number(plans.cost_plan))}}円
                                                </td>

                                            </tr>
                                            <tr>
                                                <th class="">
                                                </th>
                                                <td class="">
                                                    追加利用料金
                                                </td>
                                                <td class="text-right" v-if="plans != undefined">
                                                    {{$filters.addComma(Number(plans.cost_add))}}円
                                                </td>
                                                <td class="text-left"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="[ btn  btn--accent ]" v-on:click="openModal(item)">確認</button>
                                </div>


                                <!-- 変更内容を確認するダイアログ -->
                                <div id="overlay" :val="postItem" v-show="showContent" v-on:click="closeModal">
                                    <div id="content">
                                        <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                            <p>プランを変更いたします</p>
                                            <p>アップグレードの場合は今月、ダウングレードの場合は来月からプランが変更されますが本当によろしいですか？</p>
                                        </div>
                                        <table class="table table--bordered">
                                            <thead>
                                                <tr>
                                                    <th>プラン</th>
                                                    <th>追加企業数</th>
                                                    <th>月額料金</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td v-if="plans.plan_id == 1" class="padding-bottom--16">
                                                        スタンダードプラン
                                                        <!-- {{plans.plan_id}} -->
                                                    </td>
                                                    <td v-else class="padding-bottom--16">
                                                        プレミアムプラン
                                                        <!-- {{plans.plan_id}} -->
                                                    </td>
                                                    <td>{{plans.additional_licenses}}社</td>
                                                    <td>{{$filters.addComma(Number(plans.cost_total))}}円</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                            <button class="[ btn  btn--small  btn--accent ] margin-right--16" style="background-color:gray !important;" v-on:click="closeModal">中止</button>
                                            <button class="[ btn  btn--small  btn--outline ]" v-on:click="Store()">確定</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </article>

                        <article class="">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <table class="table table--bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>スタンダードプラン</th>
                                            <th>プレミアムプラン</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>システム利用料金</td>
                                            <td>55,000円/月</td>
                                            <td>132,000円/月</td>
                                        </tr>
                                        <tr>
                                            <td>自社データ5期の比較</td>
                                            <td>〇</td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td>他社データ比較</td>
                                            <td>〇</td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td>財務指標評価</td>
                                            <td>〇</td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td>顧客管理ツール</td>
                                            <td>―</td>
                                            <td>〇</td>
                                        </tr>
                                        <tr>
                                            <td>使用できる企業数</td>
                                            <td>60社</td>
                                            <td>120社</td>
                                        </tr>
                                        <tr>
                                            <td>企業数の追加(1社あたり)</td>
                                            <td>1,100円/月</td>
                                            <td>1,100円/月</td>
                                        </tr>
                                        <tr>
                                            <td>アプリ登録台数</td>
                                            <td>無制限</td>
                                            <td>無制限</td>
                                        </tr>
                                        <tr>
                                            <td>担当者登録数</td>
                                            <td>無制限</td>
                                            <td>無制限</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </article>

                        <div class="text-center">
                            <router-link to="/mypage/company/plan"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                        </div>

                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required, maxLength, helpers } from '@vuelidate/validators';
import { mapState, mapActions } from 'vuex';
import axios from '../../../src/plugins/axios.js';
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    setup() {
        return {
            v$: useVuelidate()
        };
    },
    data: function() {
        return {
            nextPlans: [],
            postItem: "",
        }
    },
    validations() {
        return {
            plans: {
                additional_licenses: {
                    maxLength: helpers.withMessage(
                        '9999件以内で入力してください',
                        maxLength(4)
                    ),
                },
            }
        }
    },
    mounted: function() {
        this.nextMonthPlans();
    },
    components: {
        SideMenu,
        name: "Store"
    },
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            plans: function (state) {
                return state.auth.plans;
            }
        }),
        getContract() {
            return this.$store.getters['auth/contract']
        },
    },
    methods: {
        ...mapActions('auth', ['updateState']),
        changePlan(value,data) {
            this.plans.cost_plan = value;
            this.plans.data_plan = data;
            this.plans.cost_total = this.plans.cost_plan + this.plans.cost_add;
        },
        changeData() {
            this.plans.cost_add = this.plans.additional_licenses * 1100;
            this.plans.cost_total = this.plans.cost_plan + this.plans.cost_add;

            this.v$.plans.additional_licenses.$touch();

        },
        openModal: function(item){
            this.v$.$touch();
            if (this.v$.$error) return;
            this.showContent = true;
            this.postItem = item;
        },
        closeModal: function(){
            this.showContent = false;
            this.$router.push({name: 'mypage-plan'})//ダイアログ終了後はプラン詳細へ
        },
        async Store(){
            this.v$.$touch();
            if (this.v$.$error) return;
            let url = process.env.MIX_VUE_APP_API_URL + "com/contract/update/do";

            try {
                this.plans = {...this.plans}
                const response = await axios.post(url, this.plans);
                if(response.data=="NG"){
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.updateState().then(() => {
                        if (this.apiStatus) {
                            this.$router.push({name: 'mypage-plan'})
                        }
                    });
                }

            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        async nextMonthPlans() {
            var company_code = this.$store.state.auth.company.company_code;
            let url = process.env.MIX_VUE_APP_API_URL + "com/change-contract-request/get";
            try {
                const response = await axios.get(url, {
                    params:{
                        company_code: company_code
                        }
                    });
                console.log(response);
                this.nextPlans = response.data.data.change_contract_requests ?? 'NULL';

                //change_contract_requestsがある場合
                if( this.nextPlans != 'NULL' ){
                    this.plans.plan_id = this.nextPlans.plan_id;
                    this.plans.additional_licenses = this.nextPlans.add_license_count;

                    this.plans.cost_total = this.nextPlans.price;
                    this.plans.cost_plan = this.nextPlans.plan_price;
                    this.plans.data_plan = this.nextPlans.license_count;
                    this.plans.cost_add = this.nextPlans.add_unit_price;
                }else{ //ない場合

                    this.plans.plan_id = getContract.plan_id;
                    this.plans.additional_licenses = getContract.add_license_count;

                    this.plans.cost_total = getContract.price;
                    this.plans.cost_plan = getContract.plan_price;
                    this.plans.data_plan = getContract.license_count;
                    this.plans.cost_add = getContract.add_unit_price;
                }

            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },


    },

}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
