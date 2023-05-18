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
                            登録企業一覧111
                        </h2>
                    </div>
                    <form v-on:submit.prevent="clientSearch(1)">
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
                                        <td><input v-model="search_params.client_name" class="form-input" placeholder=""></td>
                                        <th style="padding: 0 5px 0 20px;"><label>担当者名</label></th>
                                        <td>
                                            <select v-model="search_params.user_name" class="form-input">
                                                <option v-for="user in user_list">
                                                    {{user.user_name}}
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <button style="margin:20px 0 0 0" type="submit" class="[ btn  btn--small btn--accent ] margin-right--16">検索</button>
                                <button style="margin:20px 0 0 0" type="button" @click="clear()" class="[ btn  btn--small btn--accent ]">クリア</button>
                            </div>
                        </article>
                    </form>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <div v-if="search_params.sort_key"> 【並べ替え】　{{ search_params.sort_key === 'client_name' ? '企業名' : '担当者名'   }}: {{ search_params.sort_asc ? '昇順' : '降順'}}</div>
                            <div v-else> 【並べ替え】　指定なし</div>
                            <span style="color:red;"><small>※各項目をクリックすると昇順・降順でソート可能です。</small></span>

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
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <th @click="sortBy('client_name')" :class="addClass('client_name')">企業名</th>
                                        <th @click="sortBy('user_name')" :class="addClass('user_name')">担当者</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length">
                                    <tr v-for="item in items" :key="item._id">
                                        {{ item.user_name === null ? item.user_name = "未設定" : "" }}
                                        <td>{{ item.client_name }}</td>
                                        <td v-if="item.user_del === null && item.user_name === '未設定'" v-bind:class="{'alert-danger': item.user_name === null}" style="color:red;">{{ item.user_name }}</td>
                                        <td v-else-if="item.user_del === null" v-bind:class="{'alert-danger': item.user_name === null}">{{ item.user_name }}</td>
                                        <td v-else>{{ item.user_name }}<span class="alert-danger">(削除)</span></td>
                                        <th class="text-center">
                                            <button v-if="item.user_name!== null" class="[ btn  btn--small  btn--accent ] margin-right--16" v-on:click="getItem(item.id, item.client_name, item.user_id, item.client_code)">変更</button>
                                            <button v-else class="[ btn  btn--small  btn--accent ] margin-right--16" v-on:click="getItem(item.id, item.client_name, item.user_id, item.client_code)">復旧</button>
                                            <button v-if="item.user_name !== '未設定'" class="[ btn  btn--small  btn--outline ]" v-on:click="openModal(item)">ライセンスから除外</button>
                                            <button v-else disabled class="[ btn  btn--small  btn--outline ]" >ライセンスから除外</button>
                                        </th>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>登録企業情報はありません</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="overlay" :val="postItem" v-show="showContent" v-on:click="closeModal">
                                <div id="content">
                                    <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                        <p>使用しているライセンスから除外します。本当によろしいですか？</p>
                                        <p>※登録企業に紐づいている担当者も除外されます。</p>
                                    </div>
                                    <table class="table table--bordered">
                                        <thead>
                                            <tr>
                                                <th>会社名</th>
                                                <th>担当者</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{postItem.client_name}}</td>
                                                <td>{{postItem.user_name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                        <button class="[ btn  btn--small  btn--accent ] margin-right--16" style="background-color:gray !important;" v-on:click="closeModal">中止</button>
                                        <button class="[ btn  btn--small  btn--outline ]" v-on:click="deleteItem(postItem.id)">実行</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from '../../../src/plugins/axios.js'
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
            items: [],
            user_list: [],
            message: null,
            showContent: false,
            postItem: "",
            pagenation: {
                prev_page: 0,
                next_page: 0,
                current_page: 0,
                last_page: 0,
                total: 0,
                per_page: 0
            },
            loadingStatus:true,
            search_params: {
                client_name: '',
                user_name: '',
                sort_key: '',
                sort_asc: true,
   },
        };
    },
    computed: {
        getCompany() {
            return this.$store.getters['auth/company']
        },
    },
    created: function() {
        if(this.getCompany===null || this.getCompany.use_status===null){
            localStorage.removeItem('authToken')
            this.$router.push({name: 'logoff'})
        }else if(this.getCompany.use_status === 98 || this.getCompany.use_status === 99){
            this.$router.push({name: 'mypage-home'})
        }

        if(sessionStorage.hasOwnProperty('client-search-params')) {
            this.search_params = JSON.parse(
                sessionStorage.getItem('client-search-params')
            );
        }
        this.fetchItems(1);
    },
    mounted: function(){
        document.title = "登録企業一覧 | MoneyBoard"

    },
    methods: {
        ...mapActions('auth', ['updateTemps', 'resetTemps']),
        async fetchItems(page) {

            this.loadingStatus = true;

            this.resetTemps();
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index_user" + "?page=" + page;
            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.user.id, type: 1, user_name: this.search_params.user_name, client_name: this.search_params.client_name, sort_key: this.search_params.sort_key, sort_asc: this.search_params.sort_asc});
                console.log('response1');
                console.log(response.data);

                if (typeof response.data.error_code === 'undefined' || response.data.error_code === 'null' || response.data.error_code === '') {
                    this.items = response.data.data.data_list.data;
                    this.user_list = response.data.data.user_list;

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
                }else{
                    this.$router.push({name: 'logoff'})
                }

            } catch (e){
                console.log(e);
                this.message = e

                this.loadingStatus = false;
                setTimeout(() => {this.message = false;}, 2000);
            }

            this.loadingStatus = false;

        },
        openModal: function(item){
            this.showContent = true
            this.postItem = item
        },
        closeModal: function(){
            this.showContent = false
        },
        async deleteItem(id) {
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/delete";
            try {
                const response = await axios.post(url, {id: id});
                this.message = response.data.message
                setTimeout(() => {this.message = false;}, 2000);
                this.fetchItems();
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        async getItem(id, client_name, user_id, client_code) {
                let items = {id:id, client_name:client_name, user_id:user_id, client_code:client_code}
                this.resetTemps();
                this.updateTemps(items);
                this.$router.push({name: 'mypage-client_edit'})
        },
        async clientSearch(page) {
            if (!localStorage.getItem("authToken")) {
                this.$router.push({name: 'logoff'})
            }

            sessionStorage.setItem('client-search-params', JSON.stringify(this.search_params));

            this.loadingStatus = true;

            this.resetTemps();
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index_user" + "?page=" + page;
            console.log('response2');
            console.log(response.data);

            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.user.id, type: 1, user_name: this.search_params.user_name, client_name: this.search_params.client_name, sort_key: this.search_params.sort_key, sort_asc: this.search_params.sort_asc});
                if (typeof response.data.error_code === 'undefined' || response.data.error_code === 'null' || response.data.error_code === '') {
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

                }else{
                    this.$router.push({name: 'logoff'})
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
            this.search_params.sort_key === key ? (this.search_params.sort_asc = !this.search_params.sort_asc) : (this.search_params.sort_asc = true);
            this.search_params.sort_key = key;

            this.clientSearch(1)

        },
        addClass(key) {
            return {
                asc: this.search_params.sort_key === key && this.search_params.sort_asc,
                desc: this.search_params.sort_key === key && !this.search_params.sort_asc,
            };
        },
        clear() {
            this.search_params = {
                client_name: '',
                user_name: '',
                sort_key: '',
                sort_asc: true,
            };
            sessionStorage.removeItem('client-search-params');
            this.clientSearch(1)
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
