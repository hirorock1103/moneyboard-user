<template>

    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録企業の担当者変更・削除
                        </h2>
                    </div>

                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]">
                        <div class="[ padding--16 ]  bg-white  display-flex">
                            <h4 class="[ padding-top--8 padding-top-large--8 ]" style="width:10%;">
                                <span class="[ icon  solid ] fa-search  padding-right--12  text-accent"></span>
                                検索
                            </h4>
                            <input class="form-input" placeholder="会社名や担当者名を入力して検索">
                        </div>
                    </article>

                    <article class="">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <th>会社名</th>
                                        <th>担当者</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
                                        <td>あああ　あああ</td>
                                        <th class="text-center">
                                            <router-link to="/mypage/company/client/rep_edit"  class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <router-link to="/"  class="[ btn  btn--small  btn--outline ]">削除</router-link>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
                                        <td>あああ　あああ</td>
                                        <th class="text-center">
                                            <router-link to="/mypage/company/client/rep_edit"  class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <router-link to="/"  class="[ btn  btn--small  btn--outline ]">削除</router-link>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
                                        <td>あああ　あああ</td>
                                        <th class="text-center">
                                            <router-link to="/mypage/company/client/rep_edit"  class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <router-link to="/"  class="[ btn  btn--small  btn--outline ]">削除</router-link>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
                                        <td>あああ　あああ</td>
                                        <th class="text-center">
                                            <router-link to="/mypage/company/client/rep_edit"  class="[ btn  btn--small  btn--accent ] margin-right--16">変更</router-link>
                                            <router-link to="/"  class="[ btn  btn--small  btn--outline ]">削除</router-link>
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
