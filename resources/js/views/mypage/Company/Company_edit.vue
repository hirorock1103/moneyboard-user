<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録情報の編集
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
                                    基本情報
                                </h4>
                                <hr>
                                <div class="table  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    名前
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8"
                                                        v-model="item.company_name"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    住所
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8"
                                                        v-model="item.address"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    電話番号
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8"
                                                        v-model="item.phone_number"/>
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
                                                        class="form-input  margin-top--8"
                                                        v-model="item.company_rep"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    携帯番号
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8"
                                                        v-model="item.mobile_number"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-credit-card  padding-right--12  text-accent"></span>
                                    クレジットカード情報
                                </h4>
                                <hr>
                                <div class="table-scrollable  padding-right--8">
                                    <table class="table width-50">
                                        <tbody>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    カード番号
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    カード名義
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div class="text-center">
                            <router-link to="/mypage/company"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
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
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
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
        async getItem() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/company/get";
            try {
                const response = await axios.get(url, {
                    params:{
                        company_code: this.$route.params.company_code
                        }
                    }
                );
                // console.log(response.data[0]);
                this.item = response.data[0];
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        async updateItem() {
            var user = this.$store.state.auth.user;
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/update";
            // Todo:user_codeがないのでひとまず
            this.item = {...this.item, user_code: user.company_code, user_name: user.company_rep}
            try {
                const response = await axios.post(url, this.item);
                if(response.data.status=="NG"){
                    // console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-company_confirm'})
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
