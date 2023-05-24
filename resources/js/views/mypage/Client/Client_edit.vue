<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            登録企業の担当者変更
                        </h2>
                    </div>
                    <form v-on:submit.prevent="validateItem">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                    登録企業担当者情報
                                </h4>
                                <hr>
                                <div class="table  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    会社名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    {{ getTemps.client_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    担当者名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <select v-model="selectedItem" class="form-input">
                                                        <option v-for="item in items" :key="item._id" :value="item.id">
                                                            {{item.user_name}}
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div class="text-center" v-if="message">
                            <p class="text-danger">{{ message }}</p>
                        </div>
                        <div class="text-center">
                            <router-link to="/mypage/company/client/rep"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                            <input type="submit" class="[ btn  btn--accent ]" value="確認" />
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from '../../../src/plugins/axios.js';
import { mapActions } from 'vuex';
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            items: {},
            message: "",
            selectedItem: null,
        };
    },
    created: function() {
        this.fetchItems();
    },
    mounted: function(){
        document.title = "登録企業の担当者変更 | MoneyBoard"
    },
    computed: {
        getTemps() {
            return this.$store.getters['auth/temps']
        },
    },
    watch: {
        getTemps: {
            immediate: true,
            handler(newVal) {
                if (newVal) {
                    this.selectedItem = newVal.user_id;
                }
            },
        },
    },
    methods: {
        ...mapActions('auth', ['updateTemps', 'resetTemps']),
        async fetchItems() {
            var user = this.$store.state.auth.user;
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/index?company_code=" + user.company_code + "&type=1";
            try {
                const response = await axios.get(url);
                this.items = response.data.data.data_list;
            } catch (e){
                console.log(e);
                this.message = e;
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        async validateItem() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/update_rep-validate";
            const obj = this.items
            console.log(this.selectedItem);
            console.log(this.getTemps.user_id);
            const result = obj.filter((value) => {
                return value.id == this.selectedItem
            })
            if (!result.length) {
                this.message = '担当者は必須項目です。'
                setTimeout(() => {this.message = false;}, 2000);
                return;
            }
            var valDatas = {
                id: this.getTemps.id,
                user_id: this.getTemps.user_id,
                client_code:this.getTemps.client_code,
                client_name: this.getTemps.client_name,
                user_code: result[0].user_code,
                user_name:result[0].user_name,
                company_code: this.$store.state.auth.user.company_code,
                }
            try {
                const response = await axios.post(url, valDatas);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.updateTemps(valDatas);
                    this.$router.push({name: 'mypage-client_confirm'})
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
