<template>
    <div class="display-flex">
        <SideMenu />
        <main class="mypage__main">
            <section
                class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
            >
                <div class="container">
                    <div
                        class="[ display-flex justify-content-between-large align-items-baseline [ flex-column flex-row-large ] ] [ padding-left--16 padding-right-16 padding-medium--0 ] [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] margin-bottom--24 ] border-bottom"
                    >
                        <h2
                            class="[ margin-bottom--4 margin-bottom-large--16 ]"
                        >
                            登録情報の変更確認
                        </h2>
                    </div>
                    <div class="[ padding--24 padding-large--48 ] bg-white">
                        以下の内容で登録します
                    </div>
                    <form v-on:submit.prevent="updateItem">
                        <article
                            class="padding--16 bg-gray [ [ margin-left-medium--48 margin-left-large--24 ] [ margin-right-medium--48 margin-right-large--24 ] [ margin-bottom--48 margin-bottom-large--88 ] ]"
                        >
                            <div
                                class="[ padding--24 padding-large--48 ] bg-white"
                            >
                                <h4>
                                    <span
                                        class="[ icon solid ] fa-pencil-alt padding-right--12 text-accent"
                                    ></span>
                                    担当者情報
                                </h4>
                                <hr />
                                <div class="table-scrollable padding-right--8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    名前
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    {{
                                                        getCompany.company_name
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    郵便番号
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    〒{{
                                                        getCompany.post_number
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    住所
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    {{ getCompany.address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    電話番号
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    {{
                                                        getCompany.phone_number
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    担当者名
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ] padding-bottom--16"
                                                >
                                                    {{ getCompany.company_rep }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    携帯番号
                                                </th>
                                                <td
                                                    class="[ display-table-row display-table-cell-large ]"
                                                >
                                                    {{
                                                        getCompany.mobile_number
                                                    }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </article>
                        <div
                            class="text-center [ margin-bottom-medium--0 margin-bottom--48 ]"
                        >
                            <router-link
                                :to="{ name: 'mypage-company_edit' }"
                                class="[ btn btn--outline ] [ margin-right--24 margin-right-medium--24 margin-right-large--24 ]"
                                >戻る</router-link
                            >
                            <input
                                type="submit"
                                class="[ btn btn--accent ]"
                                value="確定"
                            />
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from "../../../src/plugins/axios.js";
import SideMenu from "../../../components/SideMenuComponent.vue";
import { mapActions } from "vuex";

export default {
    components: {
        SideMenu,
    },
    data() {
        return {
            message: "",
        };
    },
    mounted: function () {
        document.title = "登録情報の変更確認 | MoneyBoard";
    },
    computed: {
        getCompany() {
            return this.$store.getters["auth/company"];
        },
    },
    methods: {
        ...mapActions("auth", ["updateTemps", "resetTemps"]),
        async updateItem() {
            let url = process.env.MIX_VUE_APP_API_URL + "com/company/update";
            try {
                const response = await axios.post(url, this.getCompany);
                if (response.data.status == "NG") {
                    this.message = response.data.message;
                    setTimeout(() => {
                        this.message = false;
                    }, 2000);
                } else {
                    this.resetTemps();
                    // alert('更新しました');
                    this.$store.commit("auth/setChangeFlg", 1);

                    this.$router.push({ name: "mypage-company" });
                }
            } catch (e) {
                console.log(e);
                this.message = e;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }
        },
    },
};

// ToDo:クレジットカードの登録
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
