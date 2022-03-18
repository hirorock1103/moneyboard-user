<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            メールアドレスの変更
                        </h2>
                    </div>

                    <div class="message text-center margin-top--48" v-if="message">
                        <p class="alert alert-danger">{{ message }}</p>
                    </div>

                    <form v-on:submit.prevent="Store">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-envelope  padding-right--12  text-accent"></span>
                                    メールアドレスの変更
                                </h4>
                                <hr>
                                <div class="table-scrollable  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    変更後のメールアドレス
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input 
                                                    type="text" 
                                                    class="form-input  margin-top--8"
                                                    v-model="item.email_address"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    変更後のメールアドレス（確認用）
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input 
                                                    type="email" 
                                                    class="form-input  margin-top--8"
                                                    v-model="item.email_address"/>
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
            let url = process.env.MIX_VUE_APP_API_URL + "com/change/mail";
            try {
                var company_code = this.$store.state.auth.company.company_code;
                this.item = {...this.item, company_code: company_code}
                const response = await axios.post(url, this.item);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-email_confirm'})
                }
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 20000);
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
