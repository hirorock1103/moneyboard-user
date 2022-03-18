<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            管理サイトのパスワードを変更する
                        </h2>
                    </div>

                    <div class="[ padding--24  padding-large--48 ]  bg-white">
                        パスワードの再設定をして下さい
                    </div>

                    <div class="message text-center margin-top--48" v-if="message">
                        <p class="alert alert-danger">{{ message }}</p>
                    </div>

                    <form v-on:submit.prevent="Store">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-key  padding-right--12  text-accent"></span>
                                    新しいパスワードの設定
                                </h4>
                                <hr>
                                <div class="table-scrollable  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    パスワード
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input 
                                                    type="text" 
                                                    class="form-input  margin-top--8"
                                                    v-model="item.password"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    パスワード（確認用）
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input 
                                                    type="password" 
                                                    class="form-input  margin-top--8"
                                                    v-model="item.password"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    現在のパスワード
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input 
                                                    type="email" 
                                                    class="form-input  margin-top--8">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div class="text-center">
                            <input type="submit" class="[ btn  btn--accent ]" value="変更"/>
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
        SideMenu,
        name: "Store"
    },
    data() {
        return {
            item: {},
            message: ""
        };
    },
    methods: {
        async Store(){
            // Todo:user_code
            // var user_code = this.$store.state.auth.user.user_code;
            var user_code = '0614765068';
            let url = process.env.MIX_VUE_APP_API_URL + "com/change/pass";
            try {
                this.item = {...this.item, user_code: user_code}
                const response = await axios.post(url, this.item);
                console.log(response);
                if(response.data.status=="NG"){
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-password_confirm'})
                }
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        }
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
