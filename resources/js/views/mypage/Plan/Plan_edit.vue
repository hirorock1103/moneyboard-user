<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            プラン変更/使用会社数の増減
                        </h2>
                        <h5 class="margin-bottom--16">
                            価格はすべて税込表記
                        </h5>
                    </div>

                    <form v-on:submit.prevent="Store">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--24  margin-bottom-large--24 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-yen-sign  padding-right--12  text-accent"></span>
                                    現在ご利用中のプラン
                                </h4>
                                <hr>
                                <div class="table-scrollable  padding-right--8 padding-bottom--24">
                                    <table class="table width-40">
                                        <tbody>
                                            <tr>
                                                <th class="nowrap">
                                                    現在の料金プラン
                                                </th>
                                                <td class="padding-bottom--16 nowrap">
                                                    <input
                                                        type="radio"
                                                        id="confirm-radio-s"
                                                        class="form-radio"
                                                        value="1"
                                                        v-model="item.plan_id">
                                                    <label class="form-radio-label  margin-bottom--8" for="confirm-radio-s">スタンダードブラン</label>
                                                </td>
                                                <td class="padding-bottom--16 nowrap">
                                                    <input
                                                        type="radio"
                                                        id="confirm-radio-p"
                                                        class="form-radio"
                                                        value="2"
                                                        v-model="item.plan_id">
                                                    <label class="form-radio-label  margin-bottom--8" for="confirm-radio-p">プレミアムプラン</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="nowrap">
                                                    プランデータ数
                                                </th>
                                                <td class="padding-bottom--16">
                                                    {{plans.data_plan}}社
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="nowrap">
                                                    追加データ数
                                                </th>
                                                <td class="padding-bottom--16" style="display: flex;">
                                                    <!-- :value="plans.data_add" -->
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input"
                                                        v-model="item.additional_licenses">
                                                        <span class="margin-left--12" style="display: flex;align-items: center;justify-content: center;">社</span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h4>
                                    現在の月額料金
                                    <span class="padding-left--8  text-accent" v-if="plans != undefined">
                                        {{plans.cost_total}}
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
                                                    {{plans.cost_plan}}円
                                                </td>
                                                <td class="padding-bottom--16 text-right" v-if="plans != undefined">
                                                    （システム使用料と登録データ{{plans.data_plan}}社分）
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="">
                                                </th>
                                                <td class="">
                                                    追加利用料金
                                                </td>
                                                <td class="text-right" v-if="plans != undefined">
                                                    {{plans.cost_add}}円
                                                </td>
                                                <td class="text-left"></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                            <input type="submit" class="[ btn  btn--accent ]" value="確認"/>
                        </div>
                    </form>

                </div>
            </section>
        </main>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import axios from '../../../src/plugins/axios.js'
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    data: function() {
        return {
            item: {
                plan_id: this.$store.state.auth.plans.plan_id
            },
        }
    },
    components: {
        SideMenu,
        name: "Store"
    },
    computed: {
        ...mapState({
            plans: function (state) {
                return state.auth.plans;
            }
        })
    },
    methods: {
        ...mapActions('auth', ['updateState']),
        async Store(){
            let url = process.env.MIX_VUE_APP_API_URL + "com/company/license";
            try {
                this.item = {...this.item, company_code: this.$store.state.auth.company.company_code}
                const response = await axios.post(url, this.item);
                if(response.data=="NG"){
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.updateState().then(() => {
                        // if (this.apiStatus) {
                        if (true) {
                            this.$router.push({name: 'mypage-plan'})
                        }
                    });
                }
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        }
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
