<template>
    <div class="display-flex">

        <loading v-model:active="loadingStatus"
                :can-cancel="false"
                :is-full-page="false"
                :color="'#2FBCED'"
                :height="90"
                :width="100" />

        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            プレミアムプラン（顧客情報管理）
                        </h2>
                    </div>
                    <form v-if="blur_flg === 2" v-on:submit.prevent="clientSearch(1)">
                        <article class="padding--16 bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]">
                            <div class="padding--16 bg-white">
                                <div class="[ padding--16 ]  bg-white  display-flex">
                                    <h4 class="" style="width:10%;">
                                        <span class="[ icon  solid ] fa-search  padding-right--12  text-accent"></span>
                                        検索
                                    </h4>
                                </div>
                                <table>
                                    <tr>
                                        <th style="padding: 0 5px 0 20px;"><label>企業名</label></th>
                                        <td><input v-model="client_name" class="form-input" placeholder="会社名を入力"></td>
                                        <th style="padding: 0 5px 0 20px;"><label>担当者名</label></th>
                                        <td><input v-model="user_name" class="form-input" placeholder="担当者名を入力"></td>
                                    </tr>
                                </table>
                                <button style="margin:20px 0 0 0" type="submit" class="[ btn  btn--small btn--accent ]">検索</button>
                            </div>
                        </article>
                    </form>
                    <h4 class="padding-left--48 margin-bottom--24 margin-top--48">
                        <span class="[ icon  solid ] fa-building  padding-right--12  text-accent"></span>
                        データ登録している企業情報一覧
                    </h4>
                    <div v-if="blur_flg === 2" class="margin-bottom--24">
                        <div class="padding-left--48" v-if="sort_key"> 【並べ替え】　{{ sort_index[sort_key] }}: {{ sort_asc ? '昇順' : '降順'}}</div>
                        <div class="padding-left--48" v-else> 【並べ替え】　指定なし</div>
                        <span class="padding-left--48" style="color:red;"><small>※各項目をクリックすると昇順・降順でソート可能です。</small></span>
                    </div>
                    <article class="">
                        <div class="[ margin-left-medium--48  margin-left-large--48 ] [ margin-right-medium--48  margin-right-large--48 ] bg-white">

                            <div v-if="pagenation.total > pagenation.per_page">
                                <p style="font-size:14px"><span style="font-size:20px">{{pagenation.current_page}}</span>ページ目／{{pagenation.last_page}}ページ（合計：{{pagenation.total}}件）</p>
                                <button v-if="pagenation.current_page!==1" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(1)">最初</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]">最初</button>

                                <button v-if="pagenation.current_page!==1" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(pagenation.prev_page)">前へ</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(pagenation.prev_page)">前へ</button>

                                <button v-if="pagenation.current_page!==pagenation.last_page" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(pagenation.next_page)">次へ</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(pagenation.next_page)">次へ</button>

                                <button v-if="pagenation.current_page!==pagenation.last_page" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(pagenation.last_page)">最後</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="clientSearch(pagenation.last_page)">最後</button>
                            </div>

                            <table class="table--bordered table-scrollable" style="white-space: nowrap;overflow-y: hidden;max-height: none;">
                                <thead>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th colspan="3"></th>
                                        <th colspan="2">会社規模</th>
                                        <th></th>
                                        <th colspan="2">企業情報</th>
                                        <th colspan="5">会社の評価（5段階評価：平均値3）</th>
                                        <th colspan="3">成約の可能性（「A：可能性大」~「E：厳しい」）</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th @click="sortBy('client_name')" :class="addClass('client_name')" class="text-left padding-left--12">企業名
                                        </th>
                                        <th @click="sortBy('updated_at')" :class="addClass('updated_at')" class="text-left padding-left--12">更新日時
                                        </th>
                                        <th @click="sortBy('corporate_number')" :class="addClass('corporate_number')" class="text-left padding-left--12 padding-right--12">法人番号
                                        </th>
                                        <th @click="sortBy('user_name')" :class="addClass('user_name')" class="text-left padding-left--12 padding-right--12">担当者
                                        </th>
                                        <th @click="sortBy('business_type')" :class="addClass('business_type')" class="text-left padding-left--12 padding-right--12">業種
                                        </th>
                                        <th @click="sortBy('anualsales')" :class="addClass('anualsales')" class="text-left padding-left--12">年商（単位：万円）
                                        </th>
                                        <th @click="sortBy('capital')" :class="addClass('capital')" class="text-left padding-left--12">資本金（単位：万円）
                                        </th>
                                        <th @click="sortBy('interview_place')" :class="addClass('interview_place')" class="text-left padding-left--12 padding-right--12">面談場所
                                        </th>
                                        <th @click="sortBy('ceo_age')" :class="addClass('ceo_age')" class="text-left padding-left--12 padding-right--12">代表者年齢
                                        </th>
                                        <th @click="sortBy('average_age')" :class="addClass('average_age')" class="text-left padding-left--12 padding-right--12">従業員平均年齢
                                        </th>
                                        <th @click="sortBy('important_index')" :class="addClass('important_index')" class="text-left padding-left--12 padding-right--12">重要指標
                                        </th>
                                        <th @click="sortBy('safety_index')" :class="addClass('safety_index')" class="text-left padding-left--12 padding-right--12">安全性指標
                                        </th>
                                        <th @click="sortBy('profit_index')" :class="addClass('profit_index')" class="text-left padding-left--12 padding-right--12">収益性指標
                                        </th>
                                        <th @click="sortBy('fund_efficiency_index')" :class="addClass('fund_efficiency_index')" class="text-left padding-left--12 padding-right--12">資金効率性指標
                                        </th>
                                        <th @click="sortBy('surplus_guideline')" :class="addClass('surplus_guideline')" class="text-left padding-left--12">余剰金目安（単位：万円）
                                        </th>
                                        <th @click="sortBy('close_possibility_now')" :class="addClass('close_possibility_now')" class="text-left padding-left--12">今回
                                        </th>
                                        <th @click="sortBy('close_possibility_previous')" :class="addClass('close_possibility_previous')" class="text-left padding-left--12">前回
                                        </th>
                                        <th @click="sortBy('close_possibility_befpre')" :class="addClass('close_possibility_befpre')" class="text-left padding-left--12">前々回
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">コメント
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length" v-bind:class="{'blur': blur_flg!==2, '': blur_flg==2}" oncopy="return false">
                                    <!-- <tr>
                                        <td>株式会社サンプルカンパニー{{blur_flg}}</td>
                                        <td>0000/00/00　00:00</td>
                                        <td>12345678910</td>
                                        <td>田中太郎</td>
                                        <td>飲食業</td>
                                        <td>3,500</td>
                                        <td>3,500</td>
                                        <td>大阪府大阪市北区天神橋1-1-1</td>
                                        <td>60</td>
                                        <td>60</td>
                                        <td>5</td>
                                        <td>5</td>
                                        <td>5</td>
                                        <td>5</td>
                                        <td>500</td>
                                        <td>A</td>
                                        <td>A</td>
                                        <td>A</td>
                                        <td></td>
                                    </tr> -->
                                    <tr v-for="item in items" :key="item._id">
                                        <td>{{ item.client_name }}</td>
                                        <td>{{ formatDate(item.updated_at) }}</td>
                                        <td>{{ item.corporate_number }}</td>
                                        <td>{{ item.user_name }}</td>
                                        <td>{{ business_type_list[item.business_type] }}</td>
                                        <td>{{ item.anualsales }}</td>
                                        <td>{{ item.capital }}</td>
                                        <td>{{ item.interview_place }}</td>
                                        <td>{{ item.ceo_age }}</td>
                                        <td>{{ item.average_age }}</td>
                                        <td>{{ item.important_index }}</td>
                                        <td>{{ item.safety_index }}</td>
                                        <td>{{ item.profit_index }}</td>
                                        <td>{{ item.fund_efficiency_index }}</td>
                                        <td>{{ item.surplus_guideline }}</td>
                                        <td>{{ item.close_possibility_now }}</td>
                                        <td>{{ item.close_possibility_previous }}</td>
                                        <td>{{ item.close_possibility_befpre }}</td>
                                        <td>{{ item.comment }}</td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>プレミアムプラン情報はありません</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                    <div id="overlay" v-show="showContent">
                        <div id="content">
                            <div class="header__logo text-center">
                                <span class="header__logo-image">
                                    <img src="/images/header_logo.png">
                                </span>
                                <span class="header__logo-title  [ logo  logo__font-main ]">MoneyBoard</span>
                            </div>
                            <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                <p>ぼかしを解除するにはプレミアムプランになる必要があります。</p>
                                <p>
                                    プレミアムプランに変更をご希望の方は
                                    <router-link to="/mypage/company/plan_edit">こちら</router-link>
                                </p>
                            </div>
                            <div class="text-center padding--12 bg-white">
                                <button class="[ btn  btn--small  btn--accent ] margin-right--16" style="background-color:gray !important;" v-on:click="closeModal">閉じる</button>
                            </div>
                        </div>
                    </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from '../../../src/plugins/axios.js'
import dayjs from 'dayjs'
import SideMenu from '../../../components/SideMenuComponent.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    components: {
        SideMenu,
        Loading
    },
    data() {
        return {
            items: [],
            showContent: false,
            blur_flg : this.$store.state.auth.contract.plan_id,
            sort_key: "",
            sort_asc: true,
            sort_index: {
                client_name: "企業名",
                updated_at: "更新日時",
                user_name: "担当者名",
                corporate_number: "法人番号",
                business_type: "業種",
                anualsales: "年商（単位：万円）",
                capital: "資本金（単位：万円）",
                interview_place: "面談場所",
                ceo_age: "代表者年齢",
                average_age: "従業員平均年齢",
                important_index: "重要指標",
                safety_index: "安全性指標",
                profit_index: "収益性指標",
                fund_efficiency_index: "資金効率性指標",
                surplus_guideline: "余剰金目安（単位：万円）",
                close_possibility_now: "成約の可能性（今回）",
                close_possibility_previous: "成約の可能性（前回）",
                close_possibility_befpre: "成約の可能性（前々回）",
            },
            business_type_list: {
                1:'製造業',
                2:'建設業',
                3:'飲食業',
                4:'卸売業',
                5:'小売業',
                6:'全業種',
            },
            pagenation: {
                prev_page: 0,
                next_page: 0,
                current_page: 0,
                last_page: 0,
                total: 0,
                per_page: 0,
            },
            loadingStatus:true,

        };
    },
    computed: {
        getCompany() {
            return this.$store.getters['auth/company']
        },
    },
    created: function() {
        if(this.getCompany.use_status === 98 || this.getCompany.use_status === 99){
            this.$router.push({name: 'mypage-home'})
        }
        this.fetchItems(1);
    },
    mounted: function(){
        document.title = "プレミアムプラン | MoneyBoard"
    },
    methods: {
        openModal: function(){
            this.showContent = true
        },
        closeModal: function(){
            this.showContent = false
        },
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async fetchItems(page) {

            this.loadingStatus = true;

            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index" + "?page=" + page;
            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.user.id, type: 2});
                console.log(response);
                this.items = response.data.data.data_list.data;
                this.showContent = this.$store.state.auth.contract.plan_id == 2 ? false : true;

                //ページネーション情報の設定
                this.pagenation.per_page = response.data.data.data_list.per_page;
                this.pagenation.current_page = response.data.data.data_list.current_page;
                this.pagenation.last_page = response.data.data.data_list.last_page;
                this.pagenation.total = response.data.data.data_list.total;
                if(this.pagenation.current_page === 1){
                    this.pagenation.prev_page = 1;
                }else{
                    this.pagenation.prev_page = this.pagenation.current_page - 1;
                }
                if(this.pagenation.current_page === this.pagenation.last_page){
                    this.pagenation.next_page = this.pagenation.last_page;
                }else{
                    this.pagenation.next_page = this.pagenation.current_page + 1;
                }

            } catch (e){
                console.log(e);
                this.message = e
                this.loadingStatus = false;
                setTimeout(() => {this.message = false;}, 2000);
            }

            this.loadingStatus = false;
            console.log(this.items);
        },
        async clientSearch(page) {

            this.sort_key = "";
            this.loadingStatus = true;

            // this.resetTemps();
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index" + "?page=" + page;
            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.user.id, user_name: this.user_name, client_name: this.client_name, checked: this.checked});
                console.log(response);
                this.items = response.data.data.data_list.data;

                //ページネーション情報の設定
                this.pagenation.per_page = response.data.data.data_list.per_page;
                this.pagenation.current_page = response.data.data.data_list.current_page;
                this.pagenation.last_page = response.data.data.data_list.last_page;
                this.pagenation.total = response.data.data.data_list.total;
                if(this.pagenation.current_page === 1){
                    this.pagenation.prev_page = 1;
                }else{
                    this.pagenation.prev_page = this.pagenation.current_page - 1;
                }
                if(this.pagenation.current_page === this.pagenation.last_page){
                    this.pagenation.next_page = this.pagenation.last_page;
                }else{
                    this.pagenation.next_page = this.pagenation.current_page + 1;
                }


            } catch (e){
                console.log(e);
                this.message = e

                this.loadingStatus = false;
                setTimeout(() => {this.message = false;}, 2000);
            }

            this.loadingStatus = false;

        },
        sortBy(key) {

            // スタンダードプランはソート機能不可
            if(this.blur_flg === 1) {
                return;
            }

            this.sort_key === key ? (this.sort_asc = !this.sort_asc) : (this.sort_asc = true);
            this.sort_key = key;

            // 文字列のソート
            var StringSortList = [
                "client_name",
                "user_name",
                "interview_place",
                "close_possibility_now",
                "close_possibility_previous",
                "close_possibility_befpre",
            ];
            if(StringSortList.includes(key)) {
                let set = 1;
                this.sort_asc ? (set = 1) : (set = -1);
                this.items.sort(function(a, b) {
                    var A = a[key].toUpperCase();
                    var B = b[key].toUpperCase();
                    if (A < B) return -1 * set;
                    if (A > B) return 1 * set;
                    return 0;
                });
            }

            // 数値のソート
            var NumberSortList = [
                "corporate_number",
                "business_type",
                "anualsales",
                "capital",
                "ceo_age",
                "average_age",
                "important_index",
                "safety_index",
                "profit_index",
                "fund_efficiency_index",
                "surplus_guideline",
            ];
            if(NumberSortList.includes(key)) {
                let set = 1;
                this.sort_asc ? (set = 1) : (set = -1);
                this.items.sort(function (a, b) {
                return (a[key] - b[key]) * set
                });
            }

            // 日付のソート
            if(key === 'updated_at') {
                let set = 1;
                this.sort_asc ? (set = 1) : (set = -1);
                this.items.sort(function (a, b) {
                return (a.updated_at > b.updated_at ? 1 : -1) * set
                });
            }

        },
        addClass(key) {
            return {
                asc: this.sort_key === key && this.sort_asc,
                desc: this.sort_key === key && !this.sort_asc,
            };
        },
    }
}

// ToDo:ソートと検索？
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
