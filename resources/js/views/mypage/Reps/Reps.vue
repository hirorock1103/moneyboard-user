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
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者一覧
                        </h2>
                    </div>

                    <div class="text-center">
                        <router-link to="/mypage/company/reps-list_create"  class="[ btn  btn--accent ]">担当者新規登録</router-link>
                    </div>

                    <div class="text-center margin-top--48" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <div v-if="pagenation.total > 10">
                                <p style="font-size:14px"><span style="font-size:20px">{{pagenation.current_page}}</span>ページ目／{{pagenation.last_page}}ページ（合計：{{pagenation.total}}件）</p>
                                <button v-if="pagenation.current_page!==1" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(1)">最初</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]">最初</button>

                                <button v-if="pagenation.current_page!==1" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(pagenation.prev_page)">前へ</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(pagenation.prev_page)">前へ</button>

                                <button v-if="pagenation.current_page!==pagenation.last_page" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(pagenation.next_page)">次へ</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(pagenation.next_page)">次へ</button>

                                <button v-if="pagenation.current_page!==pagenation.last_page" style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(pagenation.last_page)">最後</button>
                                <button v-else disabled style="margin:5px" class="[ btn  btn--small  btn--outline ]" v-on:click="fetchItems(pagenation.last_page)">最後</button>
                            </div>
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <th>使用者番号</th>
                                        <th>担当者名</th>
                                        <th>データ使用数</th>
                                        <th>更新日時</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length">
                                    <tr v-for="item in items" :key="item._id">
                                        <td>{{ item.user_number }}</td>
                                        <td>{{ item.user_name }}</td>
                                        <td class="text-center">{{ item.use_license_count ?? 0 }}社</td>
                                        <td class="text-center">{{ formatDate(item.updated_at) }}</td>
                                        <th class="text-center">
                                            <button class="[ btn  btn--small  btn--accent ] margin-right--16" v-on:click="getItem(item.user_code, item.use_license_count ?? 0, available_licenses_total)">変更</button>
                                            <button class="[ btn  btn--small  btn--outline ]" v-on:click="openModal(item)">削除</button>
                                        </th>
                                        <div id="overlay" :val="postItem" v-show="showContent" v-on:click="closeModal">
                                            <div id="content">
                                                <div v-if="postItem.use_license_count === null" class="text-center [ padding--24  padding-large--48 ] bg-white">
                                                    <p>担当者情報を本当に削除してもよろしいですか？</p>
                                                </div>
                                                <div v-else class="text-center [ padding--24  padding-large--48 ] bg-white">
                                                    <p style="color: red;">担当者が保持している企業情報があるため、担当者を削除することができません。</p>
                                                    <p>※担当者が保持している企業情報は、「企業一覧から担当者を変更」していただくか、「企業情報を削除」してください。</p>
                                                </div>
                                                <table class="table table--bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>使用者番号</th>
                                                            <th>担当者名</th>
                                                            <th>データ使用数</th>
                                                            <th>更新日時</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ postItem.user_number }}</td>
                                                            <td>{{ postItem.user_name }}</td>
                                                            <td class="text-center">{{ postItem.use_license_count ?? 0 }}社</td>
                                                            <td class="text-center">{{ formatDate(postItem.updated_at) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                                    <button class="[ btn  btn--small  btn--accent ] margin-right--16" style="background-color:gray !important;" v-on:click="closeModal">中止</button>
                                                    <button v-if="postItem.use_license_count === null" class="[ btn  btn--small  btn--outline ]" v-on:click="deleteItem(postItem.company_code, postItem.user_code)">削除</button>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>担当者情報はありません</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <p class="text-right">データ使用数は合計//{{available_licenses_total}}社まで</p> -->

                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from '../../../src/plugins/axios.js'
import dayjs from 'dayjs'
import { mapActions } from 'vuex';
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
            items: [""],
            available_licenses_total: "",
            message: null,
            showContent: false,
            postItem: "",
            pagenation: {
                prev_page: 0,
                next_page: 0,
                current_page: 0,
                last_page: 0,
                total: 0
            },
            loadingStatus:true,
        };
    },
    created: function() {
        this.fetchItems(1);
    },
    mounted: function(){
        document.title = "担当者一覧 | MoneyBoard"
    },
    methods: {
        ...mapActions('auth', ['updateTemps', 'resetTemps']),
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async fetchItems(page) {

            this.loadingStatus = true;

            var user = this.$store.state.auth.user;

            let url = process.env.MIX_VUE_APP_API_URL + "com/user/index?company_code=" + user.company_code + "&page=" + page;
            try {
                const response = await axios.get(url);
//                console.log(response.data.error_code);

                if (typeof response.data.error_code === 'undefined' || response.data.error_code === 'null' || response.data.error_code === '') {
                    this.items = response.data.data.data_list.data;
                    console.log(this.items);

                    this.available_licenses_total = response.data.data.available_licenses_total[user.id];
                    this.resetTemps();

                    //ページネーション情報の設定
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

                }else{
                    this.$router.push({name: 'logoff'})
                }

            } catch (e){
                console.log(e);
                this.message = e;
                this.loadingStatus = false;
                setTimeout(() => {this.message = false;}, 2000);
            }

            this.loadingStatus = false;

        },
        openModal: function(item){
            this.showContent = true;
            this.postItem = item;
        },
        closeModal: function(){
            this.showContent = false;
        },
        async deleteItem(company_code, user_code) {
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/delete";
            try {
                const response = await axios.post(url, {company_code: company_code, user_code: user_code});
                this.message = response.data.message;
                setTimeout(() => {this.message = false;}, 2000);
                this.fetchItems();
            } catch (e){
                console.log(e);
                this.message = e;
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        async getItem(user_code, use_license_count, available_licenses_total) {
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/show";
            const response = await axios.post(url, {user_code: user_code});

            if (response.data.status=="NG") {
                console.log(response.data);
                this.message = response.data.errors.undefined_user
                setTimeout(() => {this.message = false;}, 2000);
            } else {
                let items = {...response.data.data.user, use_license_count:use_license_count, available_licenses_total:available_licenses_total}
                this.resetTemps();
                this.updateTemps(items);
                this.$router.push({name: 'mypage-reps_edit'})
            }
        },
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
