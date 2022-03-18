<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者情報の確認
                        </h2>
                    </div>

                    <div class="[ padding--24  padding-large--48 ]  bg-white">
                        以下の内容で登録します
                    </div>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                担当者情報
                            </h4>
                            <hr>
                            <div class="table  padding-right--8">
                                <table class="table width-50">
                                    <tbody>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                担当者番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                {{user_number}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                担当者名
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                {{user_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                パスワード
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                {{password}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>
                    <div class="text-center">
                        <router-link to="/mypage/company/reps-list"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                        <router-link to="/mypage/company/reps-list"  class="[ btn  btn--accent ] [ margin-right-medium--24  margin-right-large--24 ]">確定</router-link>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    props: ['user_number', 'user_name', 'password'],
    components: {
        SideMenu,
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>