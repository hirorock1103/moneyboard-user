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

                    <div v-show="message" class="alert alert-danger">{{message}}</div>

                    <form v-on:submit.prevent="Store">
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4>
                                    <span class="[ icon  solid ] fa-pencil-alt  padding-right--12  text-accent"></span>
                                    ご意見・ご要望
                                </h4>
                                <hr>
                                <div class="padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    企業名
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ]  padding-bottom--16">
                                                    <input 
                                                    type="text" 
                                                    class="form-input  margin-top--8"
                                                    v-model="item.company_name"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-middle [ display-table-row  display-table-cell-large ]">
                                                    名前
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input 
                                                    type="text" 
                                                    name="name"
                                                    class="form-input  margin-top--8"
                                                    v-model="item.inquiry_rep"/>
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
                                                    v-model="item.inquiry_email"/>
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
                                                    v-model="item.inquiry_title"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="vertical-top [ padding-top--16 padding-top-large--24 ][ display-table-row  display-table-cell-large ]">
                                                    お問合せ
                                                </th>
                                                <td class="[ display-table-row  display-table-cell-large ] ">
                                                    <input 
                                                    type="text" 
                                                    class="form-textarea  margin-top--8"
                                                    v-model="item.inquiry_contents"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
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
import axios from 'axios'
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
            let url = "http://money-board-api.loc.com/com/inquiry/test/store";
            this.item.inquiry_type = 2;
            try {
                const response = await axios.post(url, this.item);
                console.log(response);
                // Todo:簡単なバリデーション
                // Todo:確認画面作成
                this.$router.push({name: 'mypage-reps', params: {message: "ご意見・ご要望ありがとうございます。今後のシステム改訂に検討させていただきます。"}})
            } catch (e){
                console.log(e);
                // Todo:エラーメッセージ表示
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
