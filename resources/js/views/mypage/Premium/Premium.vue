<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                    <div class="
                    [ display-flex  justify-content-between-large  align-items-baseline  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2 class="[ margin-bottom--4  margin-bottom-large--16 ]">
                            プレミアムプラン（顧客情報管理）
                        </h2>
                    </div>
                    <h4 class="padding-left--48 margin-bottom--24">
                        <span class="[ icon  solid ] fa-building  padding-right--12  text-accent"></span>
                        データ登録している企業情報一覧
                    </h4>
                    <article class="">
                        <div class="[ margin-left-medium--48  margin-left-large--48 ] [ margin-right-medium--48  margin-right-large--48 ] bg-white">
                            <table class="table--bordered table-scrollable" style="white-space: nowrap;overflow-y: hidden;max-height: none;">
                                <thead>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th colspan="3"></th>
                                        <th colspan="2">会社規模</th>
                                        <th></th>
                                        <th colspan="2">企業情報</th>
                                        <th colspan="5">会社の評価（5段階評価：平均値3）</th>
                                        <th colspan="3">成約の可能性（「A：可能性大」~「E：厳しい」）</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th class="text-left padding-left--12">会社名
                                        </th>
                                        <th class="text-left padding-left--12">更新日時
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">法人番号
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">担当者
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">業種
                                        </th>
                                        <th class="text-left padding-left--12">年商（単位：万円）
                                        </th>
                                        <th class="text-left padding-left--12">資本金（単位：万円）
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">面談場所
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">代表者年齢
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">従業員平均年齢
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">重要指標
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">安全性指標
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">収益性指標
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">資金効率性指標
                                        </th>
                                        <th class="text-left padding-left--12">余剰金目安（単位：万円）
                                        </th>
                                        <th class="text-left padding-left--12">今回
                                        </th>
                                        <th class="text-left padding-left--12">前回
                                        </th>
                                        <th class="text-left padding-left--12">前々回
                                        </th>
                                        <th class="text-left padding-left--12 padding-right--12">コメント
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length" v-bind:class="{'blur': blur_flg!==2, '': blur_flg==2}">
                                    <!-- <tr>
                                        <td>株式会社サンプルカンパニー{{blur_flg}}</td>
                                        <td>0000/00/00　00:00</td>
                                        <td>12345678910</td>
                                        <td>田中太郎</td>
                                        <td>飲食業</td>
                                        <td>3,500</td>
                                        <td>3,500</td>
                                        <td>大阪府大阪市北区天神橋1-1-1</td>
                                        <td>60</td>
                                        <td>60</td>
                                        <td>5</td>
                                        <td>5</td>
                                        <td>5</td>
                                        <td>5</td>
                                        <td>500</td>
                                        <td>A</td>
                                        <td>A</td>
                                        <td>A</td>
                                        <td></td>
                                    </tr> -->
                                    <tr v-for="item in items" :key="item._id">
                                        <td>{{ item.client_name }}</td>
                                        <td>{{ formatDate(item.updated_at) }}</td>
                                        <td>{{ item.corporate_number }}</td>
                                        <td>{{ item.user_id }}</td>
                                        <td>{{ item.business_type }}</td>
                                        <td>{{ item.anualsales }}</td>
                                        <td>{{ item.capital }}</td>
                                        <td>{{ item.interview_place }}</td>
                                        <td>{{ item.ceo_age }}</td>
                                        <td>{{ item.average_age }}</td>
                                        <td>{{ item.important_index }}</td>
                                        <td>{{ item.safety_index }}</td>
                                        <td>{{ item.profit_index }}</td>
                                        <td>{{ item.fund_efficiency_index }}</td>
                                        <td>{{ item.surplus_guideline }}</td>
                                        <td>{{ item.close_possibility_now }}</td>
                                        <td>{{ item.close_possibility_previous }}</td>
                                        <td>{{ item.close_possibility_befpre }}</td>
                                        <td>{{ item.comment }}</td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>プレミアムプラン情報はありません</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>

            </section>
        </main>
    </div>
</template>

<script>
import axios from '../../../src/plugins/axios.js'
import dayjs from 'dayjs'
import SideMenu from '../../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            items: [],
            blur_flg : this.$store.state.auth.user.plan_id,
        };
    },
    created: function() {
        this.fetchItems();
    },
    methods: {
        formatDate: dateStr => dayjs(dateStr).format('YYYY/MM/DD'),
        async fetchItems() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/client/index";
            try {
                const response = await axios.post(url, {company_id: this.$store.state.auth.company.id});
                this.items = response.data.data.data_list.data;
            } catch (e){
                console.log(e);
                this.message = e
                setTimeout(() => {this.message = false;}, 2000);
            }
        },
    }
}

// ToDo:ソートと検索？
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
