<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            お問い合わせ/新規
                        </h2>
                    </div>

                    <form @submit.prevent="Store">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <div class="display-flex justify-content-between-large">
                                    <h4>
                                        <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                        お問い合わせ
                                    </h4>
                                    <h5 class="margin-bottom--16">
                                        全ての項目をご記入ください
                                    </h5>
                                </div>
                                <hr>
                                <div class="padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    会社名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]">
                                                    <input
                                                    type="text"
                                                    id="company_name"
                                                    class="form-input"
                                                    v-model="company.company_name"
                                                    readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    名前
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]">
                                                    <input
                                                    type="text"
                                                    name="inquiry_rep"
                                                    class="form-input"
                                                    v-model="company.company_rep"
                                                    readonly/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    お問い合わせ種別
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <select v-model="item.type" class="form-input"
                                                        @change="v$.item.type.$touch"
                                                        v-bind:class="[ v$.item.type.$error ? 'form-error' : null ]">
                                                        <option value="0">
                                                            料金について
                                                        </option>
                                                        <option value="1">
                                                            プランについて
                                                        </option>
                                                        <option value="2">
                                                            使い方について
                                                        </option>
                                                        <option value="3">
                                                            ご意見・ご要望
                                                        </option>
                                                        <option value="4">
                                                            その他
                                                        </option>
                                                        <option value="5">
                                                            使用料の請求について
                                                        </option>
                                                    </select>
                                                    <div
                                                        class="form-text  text-danger text-center [ margin-bottom--24   ]  "
                                                        v-if="v$.item.type.$error">
                                                        {{ v$.item.type.$errors[0].$message }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-top [ padding-top--16 padding-top-large--24 ][ display-table-row  display-table-cell-large ]">
                                                    本文
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <textarea class="form-textarea margin-top--8" v-model="item.inquiry_contents" placeholder="こちらにお問い合わせ内容を入力してください。"
                                                    @input="v$.item.inquiry_contents.$touch"
                                                    v-bind:class="[ v$.item.inquiry_contents.$error ? 'form-error' : null ]">
                                                    </textarea>
                                                    <div
                                                        class="form-text  text-danger text-center [ margin-bottom--24   ]  "
                                                        v-if="v$.item.inquiry_contents.$error">
                                                        {{ v$.item.inquiry_contents.$errors[0].$message }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div class="message text-center margin-top--48" v-if="message">
                            <p class="alert alert-danger">{{ message }}</p>
                        </div>
                        <div class="text-center margin-bottom--48  margin-bottom-large--88">
                            <router-link to="/mypage/inquiry"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                            <input type="submit" class="[ btn  btn--accent ]" value="送信"/>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required, maxLength, helpers } from '@vuelidate/validators';
import axios from '../../../src/plugins/axios.js'
import { mapState } from 'vuex';
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu,

    },
    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            item: {},
            message: "",
        };
    },

    validations() {
        return {
            item: {
                type: {
                    required: helpers.withMessage(
                        'お問い合わせ種別を選択してください',
                        required
                    ),
                },
                inquiry_contents: {
                    required: helpers.withMessage(
                        'お問い合わせを入力してください',
                        required
                    ),
                }
            }
        }
    },
    computed: {
        ...mapState({
            company: function (state) {
                return state.auth.company;
            },
        }),
    },
    mounted: function(){
        document.title = "お問い合わせ/新規 | MoneyBoard"
    },
    methods: {
        async Store(){
            this.v$.$touch();
            if (this.v$.$error) return;
            let url = process.env.MIX_VUE_APP_API_URL + "com/inquiry/store";

            try {
                const response = await axios.post(url, {
                    type: this.item.type,
                    body: this.item.inquiry_contents,
                    user_id: this.$store.state.auth.user.id,//this.company.company_id,
                });
                // console.log(response);
                if(response.data.status=="NG"){
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-inquiry_done'})
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
