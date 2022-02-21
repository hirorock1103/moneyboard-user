<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">

                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            担当者情報の編集
                        </h2>
                    </div>

                    <div v-show="message" class="alert alert-danger">{{message}}</div>

                    <form v-on:submit.prevent="updateItem">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                    担当者情報
                                </h4>
                                <hr>
                                <div class="table  padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    使用者番号
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    01
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    担当者名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8  form-control"
                                                        v-model="item.name"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    パスワード
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input
                                                        type="text"
                                                        id=""
                                                        class="form-input  margin-top--8  form-control"
                                                        v-model="item.password"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    データ使用数
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    11/60社
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="[ display-table-row  display-table-cell-large ]">
                                                    更新日時
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    2001/01/01
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>

                        <div class="text-center">
                            <router-link to="/mypage/company/reps-list"  class="[ btn  btn--outline ] [ margin-right-medium--24  margin-right-large--24 ]">戻る</router-link>
                            <input type="submit" class="[ btn  btn--accent ]" value="確認" />
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from 'axios'
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu,
    },
    data() {
        return {
            item: {},
            message: ""
        };
    },
    created: function() {
        this.getItem();
    },
    methods: {
        getItem() {
            let uri = "/items/" + this.$route.params.id;
            axios.get(uri).then(response => {
                this.item = response.data;
            });
        },
        updateItem() {
            let uri = "/items/" + this.$route.params.id;
            axios.put(uri, this.item).then(() => {
                this.$swal({
                    icon: "success",
                    text: "Updated Success!"
                });
                this.$router.push({ name: "Index" });
            });
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
