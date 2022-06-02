<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録企業一覧
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
                                        <td><input v-model="client_name" class="form-input" placeholder="会社名を入力"></td>
                                        <th style="padding: 0 5px 0 20px;"><label>担当者名</label></th>
                                        <td>
                                            <select v-model="user_name" class="form-input">
                                                <option v-for="user in user_list">
                                                    {{user.user_name}}
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <button style="margin:20px 0 0 0" type="submit" class="[ btn  btn--small btn--accent ]">検索</button>
                            </div>
                        </article>
                    </form>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <div v-if="sort_key"> 【並べ替え】　{{ sort_key === 'client_name' ? '企業名' : '担当者名'   }}: {{ sort_asc ? '昇順' : '降順'}}</div>
                            <div v-else> 【並べ替え】　指定なし</div>
                            <span style="color:red;"><small>※各項目をクリックすると昇順・降順でソート可能です。</small></span>

                            <div v-if="items.length">
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
                                        <td>{{ item.client_name }}</td>
                                        <td v-if="item.user_del === null">{{ item.user_name }}</td>
                                        <td v-else>{{ item.user_name }}<span style="color:red">(削除)</span></td>

                                        <th class="text-center">
                                            <button class="[ btn  btn--small  btn--accent ] margin-right--16" v-on:click="getItem(item.id, item.client_name, item.user_id, item.client_code)">変更</button>
                                            <button class="[ btn  btn--small  btn--outline ]" v-on:click="openModal(item)">ライセンスから除外</button>
                                        </th>
                                        <div id="overlay" :val="postItem" v-show="showContent" v-on:click="closeModal">
                                            <div id="content">
                                                <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                                    <p>企業情報を削除します。本当によろしいですか？</p>
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
                                                    <button class="[ btn  btn--small  btn--outline ]" v-on:click="deleteItem(postItem.id)">削除</button>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>登録企業情報はありません</td>
                                    </tr>
                                </tbody>
                            </table>
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

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            items: [],
            user_list: [],
            message: null,
            showContent: false,
            postItem: "",
            sort_key: "",
            sort_asc: true,
            pagenation: {
                prev_page: 0,
                next_page: 0,
                current_page: 0,
                last_page: 0,
                total: 0
            },
        };
    },
    created: function() {
        this.fetchItems(1);
    },
    methods: {
        ...mapActions('auth', ['updateTemps', 'resetTemps']),
        async fetchItems(page) {
            this.resetTemps();
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index" + "?page=" + page;
            try {
//                const response = await axios.post(url, {company_id: this.$store.state.auth.company.id});
                const response = await axios.post(url, {company_id: this.$store.state.auth.user.id});
                console.log(response);
                if (typeof response.data.error_code === 'undefined' || response.data.error_code === 'null' || response.data.error_code === '') {
                    this.items = response.data.data.data_list.data;
                    this.user_list = response.data.data.user_list;

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
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
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
            this.resetTemps();
//            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index";
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index" + "?page=" + page;
            try {
                // const response = await axios.post(url, {company_id: this.$store.state.auth.company.id, user_name: this.user_name, client_name: this.client_name, checked: this.checked});
                const response = await axios.post(url, {company_id: this.$store.state.auth.user.id, user_name: this.user_name, client_name: this.client_name, checked: this.checked});
                console.log(response);
                if (typeof response.data.error_code === 'undefined' || response.data.error_code === 'null' || response.data.error_code === '') {
                    this.items = response.data.data.data_list.data;

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
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        sortBy(key) {
            this.sort_key === key ? (this.sort_asc = !this.sort_asc) : (this.sort_asc = true);
            this.sort_key = key;

            if(key === "client_name") {
                let set = 1;
                this.sort_asc ? (set = 1) : (set = -1);
                this.items.sort(function(a, b) {
                    var client_nameA = a.client_name.toUpperCase();
                    var client_nameB = b.client_name.toUpperCase();
                    if (client_nameA < client_nameB) return -1 * set;
                    if (client_nameA > client_nameB) return 1 * set;
                    return 0;
                });
            }

            if(key === "user_name") {
                let set = 1;
                this.sort_asc ? (set = 1) : (set = -1);
                this.items.sort(function(a, b) {
                    var user_nameA = a.user_name.toUpperCase();
                    var user_nameB = b.user_name.toUpperCase();
                    if (user_nameA < user_nameB) return -1 * set;
                    if (user_nameA > user_nameB) return 1 * set;
                    return 0;
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

// ToDo:検索機能→Vue側で検索？？
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
