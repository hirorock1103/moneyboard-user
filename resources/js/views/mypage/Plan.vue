<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            プラン変更/使用会社数の増減
                        </h2>
                        <h5 class="margin-bottom--16">
                            価格はすべて税込表記
                        </h5>
                    </div>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--24  margin-bottom-large--24 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-yen-sign  padding-right--12  text-accent"></span>
                                現在ご利用中のプラン
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8 padding-bottom--24">
                                <table class="table width-40">
                                    <tbody>
                                        <tr>
                                            <th class="">
                                                現在の料金プラン
                                            </th>
                                            <td class="padding-bottom--16">
                                                スタンダードブラン
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="">
                                                追加された現在のデータ
                                            </th>
                                            <td class="padding-bottom--16">
                                                60社
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4>
                                現在の月額料金
                                <span class="padding-left--8  text-accent">
                                55,000
                                </span>
                                円
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8">
                                <table class="table width-30">
                                    <tbody>
                                        <tr>
                                            <th class="">
                                                内訳
                                            </th>
                                            <td class="padding-bottom--16">
                                                基本料金
                                            </td>
                                            <td class="padding-bottom--16 text-right">
                                                55,000円
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="">
                                            </th>
                                            <td class="">
                                                追加利用料金
                                            </td>
                                            <td class="text-right">
                                                5,000円
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>

                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>スタンダードプラン</th>
                                        <th>プレミアムプラン</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>システム利用料金</td>
                                        <td>55,000円/月</td>
                                        <td>132,000円/月</td>
                                    </tr>
                                    <tr>
                                        <td>自社データ5期の比較</td>
                                        <td>〇</td>
                                        <td>〇</td>
                                    </tr>
                                    <tr>
                                        <td>他社データ比較</td>
                                        <td>〇</td>
                                        <td>〇</td>
                                    </tr>
                                    <tr>
                                        <td>財務指標評価</td>
                                        <td>〇</td>
                                        <td>〇</td>
                                    </tr>
                                    <tr>
                                        <td>顧客管理ツール</td>
                                        <td>―</td>
                                        <td>〇</td>
                                    </tr>
                                    <tr>
                                        <td>使用できる企業数</td>
                                        <td>60社</td>
                                        <td>120社</td>
                                    </tr>
                                    <tr>
                                        <td>企業数の追加(1社あたり)</td>
                                        <td>1,100円/月</td>
                                        <td>1,100円/月</td>
                                    </tr>
                                    <tr>
                                        <td>アプリ登録台数</td>
                                        <td>無制限</td>
                                        <td>無制限</td>
                                    </tr>
                                    <tr>
                                        <td>担当者登録数</td>
                                        <td>無制限</td>
                                        <td>無制限</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>

                    <div class="text-center">
                        <router-link to="/"  class="[ btn  btn--accent ]">変更</router-link>
                    </div>

                </div>
            </section>
        </main>
    </div>
</template>

<script>
import SideMenu from '../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
