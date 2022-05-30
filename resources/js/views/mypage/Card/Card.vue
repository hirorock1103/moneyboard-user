<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            カード情報
                        </h2>
                    </div>
                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>
                    <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                        <div class="[ padding--24  padding-large--48 ]  bg-white">
                            <h4>
                                <span class="[ icon  solid ] fa-credit-card  padding-right--12  text-accent"></span>
                                クレジットカード情報
                            </h4>
                            <hr>
                            <div class="table-scrollable  padding-right--8">
                                <table class="table width-50">
                                    <tbody>
                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                番号
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                **** **** **** {{ getCard.number }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                有効期限
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                            {{ getCard.valid_month }} / {{ getCard.valid_year }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                セキュリティコード
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                                ***
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="[ display-table-row  display-table-cell-large ]">
                                                名義
                                            </th>
                                            <td class="[ display-table-row  display-table-cell-large ] ">
                                            {{ getCard.name }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>

                    <div class="text-center">
                        <router-link :to="{name: 'mypage-card_edit'}" class="[ btn  btn--accent ]">変更</router-link>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios2 from '../../../src/plugins/axios2.js'
import { mapActions } from 'vuex';
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            message: ""
        };
    },
    computed: {
        getCompany() {
            return this.$store.getters['auth/company']
        },
        getCard() {
            return this.$store.getters['auth/card']
        },
    },
    created: function() {
        this.GetCardInfo();
    },
    methods: {
        ...mapActions('auth', ['updateCompany']),

        async GetCardInfo(){

            let stripe_id = this.getCompany.stripe_id;
            const headers = {
                'Authorization' :'Bearer ' + process.env.MIX_VUE_APP_STRIPE_PRIVATE_KEY,
                'Content-Type': 'application/x-www-form-urlencoded'
            }

            try {
                //カード情報の取得
                let url = process.env.MIX_VUE_STRIPE_API_URL + "/" + stripe_id;
                let response = await axios2.get(url, {headers: headers});
                let card_id = response.data.default_source;
                let name = response.data.name;

                this.getCard.name = name;

                if(response.status!="200" || card_id == null){

                    // this.message = response.data.message
                    // setTimeout(() => {this.message = false;}, 2000);
                    this.message = "クレジットカードを登録してください。"

                } else{
                    this.message = "";

                    //カード情報の取得
                    let url = process.env.MIX_VUE_STRIPE_API_URL + "/" + stripe_id + "/sources/" + card_id;
                    let response = await axios2.get(url, {headers: headers});

                    if(response.status!="200" || card_id == null){
                        this.message = response.data.message
                        setTimeout(() => {this.message = false;}, 2000);
                    } else{
                        let valid_month = response.data.exp_month;
                        let valid_year = response.data.exp_year;
                        let number = response.data.last4;

                        this.getCard.valid_month = valid_month;
                        this.getCard.valid_year = valid_year;
                        this.getCard.number = number;
                    }
                }

            } catch (e){
                console.log(e);
                this.message = e
            }


        },


    }
}

// ToDo:カード情報の取得
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
