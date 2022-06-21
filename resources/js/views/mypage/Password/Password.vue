<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            パスワード変更
                        </h2>
                    </div>
                    <div class="[ padding--24  padding-large--48 ]  bg-white">
                        パスワードの再設定をして下さい
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
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
                                                    type="password"
                                                    class="form-input  margin-top--8"
                                                    v-model="item.password_new"
                                                        @input="v$.item.password_new.$touch"
                                                        v-bind:class="[ v$.item.password_new.$error ? 'form-error' : null ]"/>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.item.password_new.$error">
                                                        {{ v$.item.password_new.$errors[0].$message }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    確認用パスワード
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input
                                                    type="password"
                                                    class="form-input  margin-top--8"
                                                    v-model="item.password_confirm"
                                                        @input="v$.item.password_confirm.$touch"
                                                        v-bind:class="[ v$.item.password_confirm.$error ? 'form-error' : null ]"/>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.item.password_confirm.$error">
                                                        {{ v$.item.password_confirm.$errors[0].$message }}
                                                    </div>
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
                                                <td class="[ display-table-row  display-table-cell-large ]">
                                                    <input
                                                    type="password"
                                                    class="form-input  margin-top--8"
                                                    v-model="item.password"
                                                        @input="v$.item.password.$touch"
                                                        v-bind:class="[ v$.item.password.$error ? 'form-error' : null ]"/>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.item.password.$error">
                                                        {{ v$.item.password.$errors[0].$message }}
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
import containsNumber from '../../../customValidators/containsNumber';
import containsUppercase from '../../../customValidators/containsUppercase';
import containsLowercase from '../../../customValidators/containsLowercase';
import axios from '../../../src/plugins/axios.js';
import SideMenu from '../../../components/SideMenuComponent.vue';
import { mapActions } from 'vuex';

export default {
    components: {
        SideMenu,
        name: "Store"
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            item: {},
            message: ""
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
        document.title = "パスワード変更 | MoneyBoard"
    },
    validations() {
        return {
            item:{
                password_new: {
                    required: helpers.withMessage(
                        'パスワードを入力してください',
                        required
                    ),
                    minLength: helpers.withMessage(
                        '10文字以上を入力してください',
                        minLength(10)
                    ),
                    maxLength: helpers.withMessage(
                        '255文字以内で入力してください',
                        maxLength(255)
                    ),
                    containsNumber: helpers.withMessage(
                        '半角数字を含めてください',
                        containsNumber
                    ),
                    containsUppercase: helpers.withMessage(
                        '大文字を含めてください',
                        containsUppercase
                    ),
                    containsLowercase: helpers.withMessage(
                        '小文字を含めてください',
                        containsLowercase
                    ),
                },
                password_confirm: {
                    required: helpers.withMessage(
                        '確認用パスワードを入力してください',
                        required
                    ),
                    sameAs: helpers.withMessage(
                        '確認用パスワードが違います',
                        sameAs(this.item.password_new)
                    ),
                },
                password: {
                    required: helpers.withMessage(
                        '現在のパスワードを入力してください',
                        required
                    ),
                },
            }
        }
    },
    methods: {
        async Store(){
            this.v$.$touch();
            if (this.v$.$error) return;
            var company_code = this.$store.state.auth.company.company_code;
            let url = process.env.MIX_VUE_APP_API_URL + "com/change/pass";
            try {
                this.item = {...this.item, email_address: this.$store.state.auth.company.email_address, company_code: company_code}
                const response = await axios.post(url, this.item);
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
