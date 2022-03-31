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
                                                    {{ client_name }}
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
    props: ['id', 'client_name', 'user_id', 'client_code'],
    components: {
        SideMenu
    },
    data() {
        return {
            items: {},
            message: "",
            selectedItem: this.user_id,
        };
    },
    created: function() {
        this.fetchItems();
    },
    methods: {
        ...mapActions('auth', ['updateTemps', 'resetTemps']),
        async fetchItems() {
            var user = this.$store.state.auth.user;
            let url = process.env.MIX_VUE_APP_API_URL + "com/user/index?company_code=" + user.company_code;
            try {
                const response = await axios.get(url);
                this.items = response.data.data.data_list.data;
            } catch (e){
                console.log(e);
                this.message = e;
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
        async validateItem() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/update_rep-validate";
            const obj = this.items
            const result = obj.filter((value) => {
                return value.id == this.selectedItem
            })
            var valDatas = {user_code: result[0].user_code, company_code: this.$store.state.auth.user.company_code, client_code:this.client_code, user_name:result[0].user_name}
            try {
                const response = await axios.post(url, valDatas);
                if(response.data.status=="NG"){
                    console.log(response);
                    this.message = response.data.message
                    setTimeout(() => {this.message = false;}, 2000);
                } else {
                    this.resetTemps();
                    this.updateTemps(valDatas);
                    this.$router.push({name: 'mypage-client_confirm', params: {client_name:this.client_name}})
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
