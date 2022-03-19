<template>
    <div class="display-flex">
        <!-- サイドメニューの呼び出し -->
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者情報の登録・変更・削除
                        </h2>
                    </div>

                    <div class="text-center">
                        <!-- 画面遷移の仕方（routesのpathで指定する） -->
                        <router-link to="/mypage/company/reps-list_create"  class="[ btn  btn--accent ]">担当者新規登録</router-link>
                    </div>

                    <!-- メッセージがあれば表示 -->
                    <div class="message text-center margin-top--48" v-if="message">
                        <!-- ToDo:メッセージ表示のデザイン -->
                        <p class="alert alert-danger">{{ message }}</p>
                    </div>

                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
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
                                <tbody>
                                    <!-- Vueで受け取った情報をforする -->
                                    <tr v-for="item in items" :key="item._id">
                                        <td>{{ item.user_number }}</td>
                                        <td>{{ item.user_name }}</td>
                                        <td class="text-center">11社 / 60社</td>
                                        <td class="text-center">{{ formatDate(item.updated_at) }}</td>
                                        <th class="text-center">
                                            <!-- idを指定して該当の編集画面へ遷移 -->
                                            <router-link :to="{name: 'mypage-reps_edit', params: { id: item.user_code }}" class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <!-- onClickで削除 -->
                                            <button class="[ btn  btn--small  btn--outline ]" v-on:click="openModal(item)">削除</button>
                                        </th>
                                        <div id="overlay" :val="postItem" v-show="showContent" v-on:click="closeModal">
                                        <div id="content">
                                                <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                                    <p>担当者情報を削除します。</p>
                                                    <p>選択された担当者が保持している企業情報もすべて削除されますが本当によろしいですか？</p>
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
                                                            <td class="text-center">11社 / 60社</td>
                                                            <td class="text-center">{{ formatDate(postItem.updated_at) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="text-center [ padding--24  padding-large--48 ] bg-white">
                                                    <button class="[ btn  btn--small  btn--accent ] margin-right--16" style="background-color:gray !important;" v-on:click="closeModal">中止</button>
                                                    <button class="[ btn  btn--small  btn--outline ]" v-on:click="deleteItem(postItem.company_code, postItem.user_code)">削除</button>
                                                </div>
                                            </div>
                                        </div>
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
import dayjs from 'dayjs'
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
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async fetchItems() {
            var user = this.$store.state.auth.user;
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/index?company_code=" + user.company_code;
            try {
                const response = await axios.get(url);
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
        async deleteItem(company_code, user_code) {
            // URLのセット
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/delete";
            try {
                // POSTで渡す
                // Thenではなく、awaitを採用→今後増えてもこんな感じでネストしない。
                const response = await axios.post(url, {company_code: company_code, user_code: user_code});
                // console.log(response);
                this.message = response.data.message
                setTimeout(() => {this.message = false;}, 2000); // メッセージがあれば表示
                this.fetchItems(); // 画面の再描画→SPAなので画面のリロードではない
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
