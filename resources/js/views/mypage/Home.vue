<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <small class="[ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]">
                        <span v-if="company && company.use_status==1">利用中</span>
                        <span v-else-if="company && company.use_status==2">翌月利用停止予定</span>
                        <span v-else-if="company && company.use_status==98" style="color:red;font-size:18px">利用停止中</span>
                        <span v-else-if="company && company.use_status==99" style="color:red;font-size:18px">強制利用停止中</span>
                        <span v-else>ログインエラー</span>
                    </small>
                    <br>
                    <small class="[ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]">
                        企業コード {{ company ? company.company_code : "" }}
                    </small>
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            {{ company ? company.company_name : "" }}
                        </h2>

                        <h5 class="margin-bottom--16">
                            <span class="font-weight-bold  display-none-large  padding-left--4">{{ license ? license.license_available_total : "" }}</span>
                            <span class="h2  [ display-none  display-inline-block-large ]  [ padding-left--8  padding-right--4 ]">
                                {{ license ? license.license_available_total : "" }}</span>
                            件/{{ license ? license.license_total : "" }}件（残り/使用企業数上限）
                        </h5>
                    </div>
                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-qrcode  padding-right--12  text-accent"></span>
                                アプリダウンロードについて
                            </h4>
                            <hr>
                            <div class="[ display-flex  [ flex-column  flex-row-large ] ]">
                                <picture class="margin-right-large--24  text-center  [ padding-bottom--16  padding-bottom-large--0 ]">
                                    <source media="(min-width:992px)" srcset="images/mypage/qr_code.png">
                                    <img src="images/mypage/qr_code_sm.jpg" alt="Money BoardのアプリのQRコード" style="width:150px;" class="image">
                                </picture>
                                <p>iPadでQRコードを読み込んでいただくと、MoneyBoardアプリをダウンロード・インストールをすることができます。<br>
                                1アカウントでの登録台数は無制限となっています。</p>
                            </div>
                        </div>
                    </article>
                    <!-- <article v-show="notifications" class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--100 ] ]"> -->
                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--100 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-comment-dots  padding-right--12  text-accent"></span>
                                お知らせ
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8">
                                <table class="table-scrollable">
                                    <tbody v-if="items.length">
                                        <tr v-for="item in items.reverse()" :key="item._id">
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                {{ formatDate(item.created_at) }}
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                &nbsp;{{ item.notice }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td class="[ display-table-row  display-table-cell-large]">
                                                <div class="text-center">お知らせはありません</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import dayjs from 'dayjs'
//import { mapState } from 'vuex';
import { mapState, mapActions } from 'vuex';
import axios from '../../src/plugins/axios.js'
import SideMenu from '../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            items: [],
        };
    },
    created: function() {
        if(this.getCompany===null || this.getCompany.use_status===null){
            localStorage.removeItem('authToken')
            this.$router.push({name: 'logoff'})
        }else{
            this.fetchItems();
            this.updateState();
        }

    },
    mounted: function(){
        document.title = "マイページ | MoneyBoard"
    },
    computed: {
        ...mapState({
            company: function (state) {
                return state.auth.company;
            },
            license: function (state) {
                console.log('state');
                console.log(state);
                return state.auth.license;
            }
        }),
        getCompany() {
            return this.$store.getters['auth/company']
        },
    },
    methods: {
        ...mapActions('auth', ['updateState']),
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async fetchItems() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/notice/get";
            try {
                const response = await axios.get(url);
                this.items = response.data;
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
    }
}

// ToDo:QRコードを本番URLに変更
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
