<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録情報
                            <span v-if="getChangeflg === 1" style="color: #2FBCED;padding: 5px 10px;margin-left: 20px;">変更が確定されました</span>
                        </h2>
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
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
                                                会社名
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ getCompany.company_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                企業コード
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ getCompany.company_code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                郵便番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                〒{{ getCompany.post_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                住所
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ getCompany.address }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                電話番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ getCompany.phone_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                担当者名
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ getCompany.company_rep }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                携帯番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                {{ getCompany.mobile_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                メールアドレス（ログインID）
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ getCompany.email_address }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>
                    <div class="text-center">
                        <router-link :to="{name: 'mypage-company_edit'}" class="[ btn  btn--accent ]">変更</router-link>
                    </div>
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
            message: ""
        };
    },
    mounted: function(){
        this.checkStatus();
        document.title = "登録情報 | MoneyBoard"
    },

    computed: {
        getCompany() {
            return this.$store.getters['auth/company']
        },
        getChangeflg() {
            return this.$store.getters['auth/changeflg']
        },
    },
    created: function() {

        if(this.getCompany.use_status === 98 || this.getCompany.use_status === 99){
            this.$router.push({name: 'mypage-home'})
        }

        this.fetchItems();
    },
    methods: {
        ...mapActions('auth', ['updateCompany']),
        async fetchItems() {
            var company_code = this.getCompany.company_code;
            let url = process.env.MIX_VUE_APP_API_URL + "com/company/get";
            try {
                const response = await axios.get(url, {
                    params:{
                        company_code: company_code
                        }
                    }
                );
                this.updateCompany(response.data[0]);
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        checkStatus(){
            if( this.getChangeflg === 1 ){
                setTimeout(() => {
                    this.$store.commit('auth/setChangeFlg', 0)
                }, 2000);
            }
        }

    }
}

// ToDo:カード情報の取得
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>

<style media="screen">
@media (max-width: 992px) {
  .display-flex {
      display:block !important;
  }
}
</style>
