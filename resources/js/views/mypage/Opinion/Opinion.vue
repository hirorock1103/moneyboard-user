<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            ご意見・ご要望
                        </h2>
                    </div>

                    <form v-on:submit.prevent="Store">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <div class="display-flex justify-content-between-large">
                                    <h4>
                                        <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                        ご意見・ご要望
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
                                                    メールアドレス
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input
                                                    type="email"
                                                    name="email"
                                                    class="form-input  margin-top--8"
                                                    v-model="company.email_address"
                                                    readonly/>
                                                    <!-- v-model="item.inquiry_email"/> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    件名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input
                                                    type="text"
                                                    name="title"
                                                    class="form-input  margin-top--8"
                                                    v-model="item.inquiry_title"
                                                    @input="v$.item.inquiry_title.$touch"
                                                    v-bind:class="[ v$.item.inquiry_title.$error ? 'form-error' : null ]">
                                                    <div
                                                        class="form-text  text-danger text-center [ margin-bottom--24   ]  "
                                                        v-if="v$.item.inquiry_title.$error">
                                                        {{ v$.item.inquiry_title.$errors[0].$message }}
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-top [ padding-top--16 padding-top-large--24 ][ display-table-row  display-table-cell-large ]">
                                                    ご意見・ご要望
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <textarea class="form-textarea margin-top--8" v-model="item.inquiry_contents" placeholder="こちらにお問い合わせ内容を入力してください。"                                                    @input="v$.item.inquiry_contents.$touch"
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
                        <div class="text-center">
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
    validations() {
        return {
            item: {
                inquiry_title: {
                    required: helpers.withMessage(
                        '件名を入力してください',
                        required
                    ),
                    maxLength: helpers.withMessage(
                        '50文字以下で入力してください',
                        maxLength(50)
                    ),
                },
                inquiry_contents: {
                    required: helpers.withMessage(
                        'ご意見・ご要望を入力してください',
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
        })
    },
    created: function() {
        if(this.company===null || this.company.use_status===null){
            localStorage.removeItem('authToken')
            this.$router.push({name: 'logoff'})
        }else if(this.company.use_status === 98 || this.company.use_status === 99){
            this.$router.push({name: 'mypage-home'})
        }
    },
    mounted: function(){
        document.title = "ご意見・ご要望 | MoneyBoard"
    },
    methods: {
        async Store(){
            this.v$.$touch();
            if (this.v$.$error) return;
            let url = process.env.MIX_VUE_APP_API_URL + "com/inquiry/store";
            this.item.inquiry_type = 2;
            try {
                this.item = {...this.item, company_name: this.company.company_name, inquiry_rep: this.company.company_rep, inquiry_email: this.company.email_address}
                const response = await axios.post(url, this.item);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.$router.push({name: 'mypage-opinion_done'})
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
