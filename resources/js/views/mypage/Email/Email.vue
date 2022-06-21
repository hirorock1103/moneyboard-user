<template>
    <div class="display-flex">

        <loading v-model:active="loadingStatus"
                :can-cancel="false"
                :is-full-page="false"
                :color="'#2FBCED'"
                :height="90"
                :width="100" />

        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            メールアドレス変更
                        </h2>
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <form v-on:submit.prevent="validateItem">
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
                                                    v-model="item.email_address"
                                                        @input="v$.item.email_address.$touch"
                                                        v-bind:class="[ v$.item.email_address.$error ? 'form-error' : null ]"/>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.item.email_address.$error">
                                                        {{ v$.item.email_address.$errors[0].$message }}
                                                    </div>
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
                                                    v-model="item.email_address_confirm"
                                                        @input="v$.item.email_address_confirm.$touch"
                                                        v-bind:class="[ v$.item.email_address_confirm.$error ? 'form-error' : null ]"/>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.item.email_address_confirm.$error">
                                                        {{ v$.item.email_address_confirm.$errors[0].$message }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div class="text-center">
                            <p v-show="v$.$error" class="text-danger">入力に誤りがあります</p>
                        </div>
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
import useVuelidate from '@vuelidate/core';
import { required, minLength, maxLength, sameAs, helpers, email } from '@vuelidate/validators';
import axios from '../../../src/plugins/axios.js';
import SideMenu from '../../../components/SideMenuComponent.vue';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    components: {
        SideMenu,
        name: "validateItem",
        Loading,
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            item: {},
            message: "",
            loadingStatus:false,
        };
    },

    computed: {
        getCompany() {
            return this.$store.getters['auth/company']
        },
    },
    created: function() {
        if(this.getCompany===null || this.getCompany.use_status===null){
            localStorage.removeItem('authToken')
            this.$router.push({name: 'logoff'})
        }else if(this.getCompany.use_status === 98 || this.getCompany.use_status === 99){
            this.$router.push({name: 'mypage-home'})
        }
    },

    mounted: function(){
        document.title = "メールアドレス変更 | MoneyBoard"
    },
    validations() {
        return {
            item:{
                email_address: {
                    required: helpers.withMessage(
                        'メールアドレスを入力してください',
                        required
                    ),
                    email:helpers.withMessage(
                        '正しい形を入力してください',
                        email
                    ),
                    maxLength: helpers.withMessage(
                        '255文字以内で入力してください',
                        maxLength(255)
                    ),
                },
                email_address_confirm: {
                    required: helpers.withMessage(
                        '確認用メールアドレスを入力してください',
                        required
                    ),
                    email:helpers.withMessage(
                        '正しい形を入力してください',
                        email
                    ),
                    sameAs: helpers.withMessage(
                        '確認用メールアドレスが違います',
                        sameAs(this.item.email_address)
                    ),
                },
            }
        }
    },
    methods: {
        async validateItem(){
            this.v$.$touch();
            if (this.v$.$error) return;

            this.loadingStatus = true;

            let url = process.env.MIX_VUE_APP_API_URL + "com/change/mail/verify";
            try {
                var company_code = this.$store.state.auth.company.company_code;
                this.item = {...this.item, company_code: company_code}
                const response = await axios.post(url, this.item);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    this.loadingStatus = false;
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-email_confirm'})
                }
                this.loadingStatus = false;
            } catch (e){
                console.log(e);
                this.message = e
                this.loadingStatus = false;
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
