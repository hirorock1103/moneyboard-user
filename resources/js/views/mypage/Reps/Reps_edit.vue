<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者情報の編集
                        </h2>
                    </div>

                    <div class="message text-center margin-top--48" v-if="message">
                        <p class="alert alert-danger">{{ message }}</p>
                    </div>

                    <form v-on:submit.prevent="updateItem">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                    担当者情報
                                </h4>
                                <hr>
                                <div class="table  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    使用者番号
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    {{ item.user_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    担当者名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8  form-control"
                                                        v-model="item.user_name"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    パスワード
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8  form-control"
                                                        v-model="item.password"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    データ使用数
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    11/60社
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    更新日時
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    {{ formatDate(item.updated_at) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>

                        <div class="text-center">
                            <router-link to="/mypage/company/reps-list"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                            <input type="submit" class="[ btn  btn--accent ]" value="確認" />
                        </div>
                    </form>
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
        SideMenu,
    },
    data() {
        return {
            item: {},
            message: ""
        };
    },
    created: function() {
        this.getItem();
    },
    methods: {
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async getItem() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/show";
            const response = await axios.post(url, {company_code: this.$store.state.auth.user.company_code, user_code: this.$route.params.id});
            if (response.data.status=="NG") {
                console.log(response.data);
                this.message = response.data.errors.undefined_user
                setTimeout(() => {this.message = false;}, 2000);
            } else {
                this.item = response.data.data.user;
            }
        },
        async updateItem() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/update";
            try {
                const response = await axios.post(url, this.item);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-reps_confirm'})
                }
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
