<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録情報の確認・変更
                        </h2>
                    </div>

                    <div class="message text-center margin-top--48" v-if="message">
                        <p class="alert alert-danger">{{ message }}</p>
                    </div>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                基本情報
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                名前
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ item.company_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                住所
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                〒000-0000　{{ item.address }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                電話番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ item.phone_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                担当者名
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ item.company_rep }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                携帯番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                {{ item.mobile_number }}
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
                                                **********12
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                カード名義
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                AB**************
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                カード期限
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                23/08
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>

                    <div class="text-center">
                        <router-link :to="{name: 'mypage-company_edit', params: { company_code: item.company_code }}" class="[ btn  btn--accent ]">変更</router-link>
                    </div>
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
            item: [],
            message: ""
        };
    },
    created: function() {
        var company = this.$store.state.auth.company;
        this.fetchItems(company);
    },
    methods: {
        async fetchItems(company) {
            var company_code = company.company_code;
            let url = process.env.MIX_VUE_APP_API_URL + "com/company/get?company_code=" + company_code;
            try {
                const response = await axios.get(url);
                // console.log(response.data[0]);
                this.item = response.data[0];
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
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
