<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

                    <div class="
                    [ display-flex  justify-content-between-large  [ flex-column  flex-row-large ] ]  [ padding-left--16  padding-right-16  padding-medium--0 ]  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] margin-bottom--24 ]  border-bottom">
                        <h2>
                            プレミアムプラン（顧客情報管理）
                        </h2>
                        <h5 class="margin-bottom--16">
                            北本先生・アップハーツ様 <br>
                            未加入時のイメージは→<br>
                            を クリックしてください<br>
                        </h5>
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
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">更新日時
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">法人番号
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">担当者
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">業種
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">年商（単位：万円）
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">資本金（単位：万円）
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">面談場所
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">代表者年齢
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">従業員平均年齢
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">重要指標
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">安全性指標
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">収益性指標
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">資金効率性指標
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">余剰金目安（単位：万円）
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">今回
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">前回
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">前々回
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                        <th class="text-left padding-left--12">コメント
                                            <span class="[ icon  solid ] fa-sort-down  padding-right--12  text-accent"></span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
                                    </tr>
                                    <tr>
                                        <td>株式会社サンプルカンパニー</td>
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
import SideMenu from '../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
