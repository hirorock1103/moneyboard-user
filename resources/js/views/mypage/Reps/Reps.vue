<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--48 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者情報の登録・変更・削除
                        </h2>
                    </div>

                    <div class="text-center">
                        <router-link to="/mypage/company/reps-list_create"  class="[ btn  btn--accent ]">担当者新規登録</router-link>
                    </div>

                    <!-- Todo:propsメッセージの受け取りと表示 -->

                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <th>使用者番号</th>
                                        <th>担当者名</th>
                                        <th>パスワード</th>
                                        <th>データ使用数</th>
                                        <th>更新日時</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>あああ　あああ</td>
                                        <td class="text-center">1234567890</td>
                                        <td class="text-center">11社 / 60社</td>
                                        <td class="text-center">2021/01/02</td>
                                        <th class="text-center">
                                            <router-link to="/mypage/company/reps-list_edit"  class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <router-link to="/"  class="[ btn  btn--small  btn--outline ]">削除</router-link>
                                        </th>
                                    </tr>
                                    <tr v-for="item in items" :key="item._id">
                                        <td>{{ item.user_code }}</td>
                                        <td>{{ item.user_name }}</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">{{ formatDate(item.updated_at) }}</td>
                                        <th class="text-center">
                                            <router-link :to="{path: '/mypage/company/reps-list_edit/:id', params: { id: item.id }}" class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <button class="[ btn  btn--small  btn--outline ]" v-on:click="deleteItem(item.company_code, item.user_code)">削除</button>
                                        </th>
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
import axios from 'axios'
import dayjs from 'dayjs'
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            items: []
        };
    },
    created: function() {
        this.fetchItems();
    },
    methods: {
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async fetchItems() {
            let url = "http://money-board-api.loc.com/com/user/test/index";
            try {
                const response = await axios.get(url);
                // console.log(response);
                this.items = response.data.data.data_list.data;
            } catch (e){
                console.log(e);
                // Todo:エラーメッセージ表示
            }
        },
        async deleteItem(company_code, user_code) {
            let url = "http://money-board-api.loc.com/com/user/test/delete";
            try {
                const response = await axios.post(url, {company_code: company_code, user_code: user_code});
                // console.log(response);
                // ! Todo:画面の再描画の方法解答待ち
                this.$router.go({path: this.$router.currentRoute.path, force: true})
                // Todo:削除成功メッセージ表示
            } catch (e){
                console.log(e);
                // Todo:削除失敗メッセージ表示
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
