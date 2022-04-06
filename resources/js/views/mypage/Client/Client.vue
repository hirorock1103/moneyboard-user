<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録企業の担当者変更・削除
                        </h2>
                    </div>
                    <form v-on:submit.prevent="clientSearch">
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
                                        <th style="padding: 0 5px 0 20px;"><label>会社名</label></th>
                                        <td><input v-model="client_name" class="form-input" placeholder="会社名を入力"></td>
                                        <th style="padding: 0 5px 0 20px;"><label>担当者名</label></th>
                                        <td><input v-model="user_name" class="form-input" placeholder="担当者名を入力"></td>
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
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <th>会社名</th>
                                        <th>担当者</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length">
                                    <tr v-for="item in items" :key="item._id">
                                        <td>{{ item.client_name }}</td>
                                        <td>{{ item.user_name }}</td>
                                        <th class="text-center">
                                            <button class="[ btn  btn--small  btn--accent ] margin-right--16" v-on:click="getItem(item.id, item.client_name, item.user_id, item.client_code)">変更</button>
                                            <button class="[ btn  btn--small  btn--outline ]" v-on:click="openModal(item)">削除</button>
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
            message: null,
            showContent: false,
            postItem: "",
        };
    },
    created: function() {
        this.fetchItems();
    },
    methods: {
        ...mapActions('auth', ['updateTemps', 'resetTemps']),
        async fetchItems() {
            this.resetTemps();
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index";
            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.company.id});
                this.items = response.data.data.data_list.data;
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
        async clientSearch() {
            this.resetTemps();
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index";
            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.company.id, user_name: this.user_name, client_name: this.client_name});
                console.log(response);
                this.items = response.data.data.data_list.data;
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
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
