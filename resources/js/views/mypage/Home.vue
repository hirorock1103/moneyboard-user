<template>

    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <small class="[ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]">
                        ID {{ company.company_code }}
                    </small>

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            {{ company.company_name }}
                        </h2>
                        <h5 class="margin-bottom--16">
                            登録可能データ残り
                            <span class="font-weight-bold  display-none-large  padding-left--4">12</span>
                            <span class="h2  [ display-none  display-inline-block-large ]  [ padding-left--8  padding-right--4 ]">
                                {{ company.available_licenses_total }}</span>
                            件/{{ company.available_licenses_total }}件
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
                                    <tbody>
                                        <!-- <tr
                                            v-for="notification in notifications.slice().reverse()"
                                            :key="notification.id">
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                {{ notification.date }}
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                {{ notification.text }}
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                2000/1/1
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto id omnis, earum quas quos enim? Est vero quam aliquid, rem harum reprehenderit. At obcaecati a quisquam et dignissimos nulla enim?
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                2000/1/11
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto id omnis, earum quas quos enim? Est vero quam aliquid, rem harum reprehenderit. At obcaecati a quisquam et dignissimos nulla enim?
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                2020/3/11
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto id omnis, earum quas quos enim? Est vero quam aliquid, rem harum reprehenderit. At obcaecati a quisquam et dignissimos nulla enim?
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                2020/3/11
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto id omnis, earum quas quos enim? Est vero quam aliquid, rem harum reprehenderit. At obcaecati a quisquam et dignissimos nulla enim?
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                2020/3/11
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto id omnis, earum quas quos enim? Est vero quam aliquid, rem harum reprehenderit. At obcaecati a quisquam et dignissimos nulla enim?
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
import { mapState } from 'vuex';
import SideMenu from '../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    computed: {
        ...mapState({
            company: function (state) {
                return state.auth.company;
            }
        })
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
