<template>
    <div class="display-flex">
        <SideMenu v-if="isShow" />
        <main class="mypage__main" :class="{ noside_main: !isShow }">
            <section
                class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
            >
                <div class="container">
                    <h2 class="text-center heading-primary">
                        特定商取引法に基づく表記
                    </h2>
                    <article data-v-cb07a6b6="">
                        <div class="" data-v-cb07a6b6="">
                            <div class="" data-v-cb07a6b6="">
                                <table id="tokutei">
                                    <tbody>
                                        <tr>
                                            <th>販売業者</th>
                                            <td>株式会社マネーボード</td>
                                        </tr>
                                        <tr>
                                            <th>運営統括責任者</th>
                                            <td>北本幸市郎</td>
                                        </tr>
                                        <tr>
                                            <th>所在地</th>
                                            <td>
                                                大阪府大東市大野１丁目５番９号
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>連絡先</th>
                                            <td>info@moneyboard.tech</td>
                                        </tr>
                                        <tr>
                                            <th>TEL</th>
                                            <td>06-7777-0464</td>
                                        </tr>
                                        <tr>
                                            <th>利用が可能となる時期</th>
                                            <td>
                                                お申し込み手続き完了後直ちにご利用いただけます
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>返品・キャンセル</th>
                                            <td>
                                                サービスの性質上、返品・返金はお受けしておりません
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>利用料金</th>
                                            <td>
                                                詳しくは<a
                                                    href="/"
                                                    class="btn--link"
                                                    >こちら</a
                                                >の「利用料金」をご確認ください
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>お支払い方法</th>
                                            <td>
                                                口座振替・銀行振込・クレジットカードとなります<br />
                                                詳しくは<a
                                                    href="/"
                                                    class="btn--link"
                                                    >こちら</a
                                                >の「決済方法」をご確認ください
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>中途解約について</th>
                                            <td>
                                                月の途中の解約となった場合も１ヶ月分の料金が発生し、日割清算等による返金を含めた一切の返金は行われません
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import SideMenu from "../../components/SideMenuComponent.vue";

export default {
    components: {
        SideMenu,
    },
    data() {
        return {
            isShow: false,
        };
    },
    computed: {
        getCompany() {
            return this.$store.getters["auth/company"];
        },
    },
    methods: {
        clearAuthToken() {
            localStorage.removeItem("authToken");
        },
    },
    created() {
        if (localStorage.getItem("authToken") && this.getCompany === null) {
            this.clearAuthToken();
        }

        // trueにしたりfalseにしたり
        this.isShow = localStorage.getItem("authToken");
    },
    mounted: function () {
        document.title = "利用規約 | MoneyBoard";
    },
};
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
<style>
#tokutei {
    width: 90%;
    min-width: 640px;
    margin: 0 auto 20px;
    border-collapse: collapse;
}
#tokutei tr th:nth-child(1) {
    background: #49c5f0;
}

#tokutei tr *:nth-child(2) {
    background: white;
}

#tokutei tr *:nth-child(3) {
    background: #649cdf;
}

#tokutei tr *:nth-child(4) {
    background: #6e87d7;
}

#tokutei th {
    width: 250px;
    color: rgb(78, 78, 78);
    color: white;
    border: solid 1px rgb(78, 78, 78);
    text-align: center;
    padding: 15px;
}

#tokutei td {
    color: rgb(78, 78, 78);
    border: solid 1px rgb(78, 78, 78);
    /* text-align: center; */
    padding: 15px;
}
</style>
