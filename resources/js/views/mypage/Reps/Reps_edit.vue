<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者情報の変更
                        </h2>
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <form v-on:submit.prevent="validateItem">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4 style="margin-bottom: 16px;">
                                    <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                    担当者情報
                                </h4>
                                <div style="display: flex;">
                                    <h5 style="margin-bottom: 4px;">
                                        ※　
                                    </h5>
                                    <h5 style="text-decoration:underline; margin-bottom: 4px;">
                                        8文字以上（半角のアルファベット大文字、小文字、数字の3種類の組み合わせ）
                                    </h5>
                                </div>
                                <hr>
                                <div class="table  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    使用者番号
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    {{ getTemps.user_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    担当者名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id="user_name"
                                                        class="form-input  margin-top--8  form-control"
                                                        v-model="getTemps.user_name"
                                                        @input="v$.getTemps.user_name.$touch"
                                                        v-bind:class="[ v$.getTemps.user_name.$error ? 'form-error' : null ]"/>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.getTemps.user_name.$error">
                                                        {{ v$.getTemps.user_name.$errors[0].$message }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    パスワード　※
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        :type="showPassword ? 'text' : 'password'"
                                                        id="password"
                                                        class="form-input  margin-top--8  form-control"
                                                        v-model="getTemps.password"
                                                        @input="v$.getTemps.password.$touch"
                                                        v-bind:class="[ v$.getTemps.password.$error ? 'form-error' : null ]"/>
                                                    <span class="input-icon">
                                                        <span :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
                                                        @click="showPassword = !showPassword"
                                                        class="password-icon"></span>
                                                    </span>
                                                    <div
                                                        class="form-text  text-danger  text-center"
                                                        v-if="v$.getTemps.password.$error">
                                                        {{ v$.getTemps.password.$errors[0].$message }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    データ使用数
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    {{getTemps.use_license_count}}/{{getTemps.available_licenses_total}}社
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    更新日時
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    {{ formatDate(getTemps.updated_at) }}
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
                        <div class="text-center [ margin-bottom-medium--0 margin-bottom--48 ]">
                            <router-link to="/mypage/company/reps-list"  class="[ btn  btn--outline ] [ margin-right--24  margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                            <input type="submit" class="[ btn  btn--accent ]" value="確認" />
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required, minLength, maxLength, helpers } from '@vuelidate/validators';
import containsNumber from '../../../customValidators/containsNumber';
import containsUppercase from '../../../customValidators/containsUppercase';
import containsLowercase from '../../../customValidators/containsLowercase';
import axios from '../../../src/plugins/axios.js';
import SideMenu from '../../../components/SideMenuComponent.vue';
import dayjs from 'dayjs'

export default {
    components: {
        SideMenu,
        name: "validateItem"
    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            message: "",
            showPassword: false,
        };
    },
    mounted: function(){
        document.title = "担当者情報の変更 | MoneyBoard"
    },
    validations() {
        return {
            getTemps:{
                user_name: {
                    required: helpers.withMessage(
                        '担当者名を入力してください',
                        required
                    ),
                    maxLength: helpers.withMessage(
                        '16文字以内で入力してください',
                        maxLength(16)
                    ),
                },
                password: {
                    minLength: helpers.withMessage(
                        '8文字以上を入力してください',
                        minLength(8)
                    ),
                    maxLength: helpers.withMessage(
                        '255文字以下で入力してください',
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
            }
        }
    },
    computed: {
        getTemps() {
            return this.$store.getters['auth/temps']
        },
    },
    methods: {
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async validateItem(){
            this.v$.$touch();
            if (this.v$.$error) return;
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/update-validate";
            try {
                this.getTemps = {...this.getTemps, company_code: this.$store.state.auth.user.company_code}
                const response = await axios.post(url, this.getTemps);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-reps_edit_confirm'})
                }
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
