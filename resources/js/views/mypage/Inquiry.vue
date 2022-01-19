<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            お問い合わせ
                        </h2>
                    </div>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                お問い合わせ
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                企業名
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                <input type="email" class="form-input  margin-top--8">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                名前
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                <input type="email" class="form-input  margin-top--8">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                メールアドレス
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                <input type="email" class="form-input  margin-top--8">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                件名
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                <input type="email" class="form-input  margin-top--8">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                お問合せ
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                <input type="email" class="form-input  margin-top--8">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>

                    <div class="text-center margin-bottom--48  margin-bottom-large--88">
                        <router-link to="/"  class="[ btn  btn--accent ]">送信</router-link>
                    </div>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-phone-alt  padding-right--12  text-accent"></span>
                                電話での問い合わせ
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8">
                                <table class="table margin-bottom--8">
                                    <tbody>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                問い合わせ窓口TEL　06-6314-6685
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="[ display-table-row  display-table-cell-large ]">
                                                運営元　　株式会社PPFパートナーズ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="[ display-table-row  display-table-cell-large ]">
                                                住　所　　大阪府大阪市北区天神橋1丁目7番17号　イケガミノースハウス4階
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
