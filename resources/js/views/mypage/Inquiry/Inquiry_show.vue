<template>
    <div class="display-flex">
        <loading
            v-model:active="loadingStatus"
            :can-cancel="false"
            :is-full-page="false"
            :color="'#2FBCED'"
            :height="90"
            :width="100"
        />

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
                            お問い合わせ/詳細（{{ type[topic.type] }}）
                        </h2>
                    </div>
                    <!--
                    <form v-on:submit.prevent="clientSearch(1)">
                        <article class="padding--16 bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ] ]">
                            <div class="padding--16 bg-white">
                                <div class="[ padding--16 ]  bg-white  display-flex">
                                    <h4 class="" style="width:10%;">
                                        <span class="[ icon  solid ] fa-search  padding-right--12  text-accent"></span>
                                        検索
                                    </h4>
                                </div>
                                <table>
                                    <tr>
                                        <th style="padding: 0 5px 0 20px;"><label>企業名</label></th>
                                        <td><input v-model="client_name" class="form-input" placeholder="会社名を入力"></td>
                                        <th style="padding: 0 5px 0 20px;"><label>担当者名</label></th>
                                        <td>
                                            <select v-model="user_name" class="form-input">
                                                <option v-for="user in user_list">
                                                    {{user.user_name}}
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <button style="margin:20px 0 0 0" type="submit" class="[ btn  btn--small btn--accent ]">検索</button>
                            </div>
                        </article>
                    </form>
                    -->

                    <div class="text-center" v-if="message">
                        <p class="text-danger">{{ message }}</p>
                    </div>

                    <article class="">
                        <div class="[ padding--24 padding-large--48 ] bg-white">
                            <div v-if="pagenation.total > pagenation.per_page">
                                <p style="font-size: 14px">
                                    <span style="font-size: 20px">{{
                                        pagenation.current_page
                                    }}</span
                                    >ページ目／{{
                                        pagenation.last_page
                                    }}ページ（合計：{{ pagenation.total }}件）
                                </p>
                                <button
                                    v-if="pagenation.current_page !== 1"
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="fetchItems(1)"
                                >
                                    最初
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                >
                                    最初
                                </button>

                                <button
                                    v-if="pagenation.current_page !== 1"
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.prev_page)
                                    "
                                >
                                    前へ
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.prev_page)
                                    "
                                >
                                    前へ
                                </button>

                                <button
                                    v-if="
                                        pagenation.current_page !==
                                        pagenation.last_page
                                    "
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.next_page)
                                    "
                                >
                                    次へ
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.next_page)
                                    "
                                >
                                    次へ
                                </button>

                                <button
                                    v-if="
                                        pagenation.current_page !==
                                        pagenation.last_page
                                    "
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.last_page)
                                    "
                                >
                                    最後
                                </button>
                                <button
                                    v-else
                                    disabled
                                    style="margin: 5px"
                                    class="[ btn btn--small btn--outline ]"
                                    v-on:click="
                                        fetchItems(pagenation.last_page)
                                    "
                                >
                                    最後
                                </button>
                            </div>
                            <table class="table table--bordered">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>送信日</th>
                                        <th>送信者</th>
                                        <th style="width: 700px">本文</th>
                                    </tr>
                                </thead>
                                <tbody v-if="items.length">
                                    <tr v-for="item in items" :key="item._id">
                                        <!-- <td>{{ item.id }}</td> -->
                                        <td>
                                            {{
                                                item.created_at.substring(0, 10)
                                            }}
                                        </td>

                                        <td v-if="item.attribute === 0">
                                            お客様
                                        </td>
                                        <td v-else>運営</td>
                                        <td>
                                            <p
                                                style="margin-bottom: 0px"
                                                v-for="str of item.body.split(
                                                    '\n'
                                                )"
                                            >
                                                {{ str }}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <td>お問い合わせはありません</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </article>
                    <div class="text-center [ padding--24 ]">
                        <router-link
                            to="/mypage/inquiry"
                            class="[ btn btn--outline ] [ margin-right-medium--24 margin-right-large--24 ]"
                            >戻る</router-link
                        >
                        <router-link
                            v-if="topic.status === 0"
                            :to="{
                                name: 'mypage-inquiry_add',
                                params: { id: topic_id, type: topic.type },
                            }"
                            class="[ btn btn--accent ]"
                            >返信</router-link
                        >
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import axios from "../../../src/plugins/axios.js";
import { mapActions } from "vuex";
import SideMenu from "../../../components/SideMenuComponent.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    components: {
        SideMenu,
        Loading,
    },
    data() {
        return {
            items: [],
            message: null,
            topic: [],
            type: {
                0: "料金について",
                1: "プランについて",
                2: "使い方について",
                3: "ご意見・ご要望",
                4: "その他",
                5: "利用料のご請求について",
                6: "運営からのご連絡",
            },
            topic_id: "",
            pagenation: {
                prev_page: 0,
                next_page: 0,
                current_page: 0,
                last_page: 0,
                total: 0,
                per_page: 0,
            },
            loadingStatus: true,
        };
    },
    created: function () {
        this.fetchItems(1);
    },
    mounted: function () {
        document.title = "お問い合わせ/詳細 | MoneyBoard";
    },
    methods: {
        ...mapActions("auth", ["updateTemps", "resetTemps"]),
        async fetchItems(page) {
            this.loadingStatus = true;
            this.resetTemps();

            let url =
                process.env.MIX_VUE_APP_API_URL +
                "com/inquiry/show" +
                "?page=" +
                page;
            this.topic_id = this.$route.params.id;
            try {
                const response = await axios.get(url, {
                    params: {
                        id: this.topic_id,
                    },
                });

                if (
                    typeof response.data.error_code === "undefined" ||
                    response.data.error_code === "null" ||
                    response.data.error_code === ""
                ) {
                    this.items = response.data.data.data_list.data;
                    this.topic = response.data.data.topic;

                    //ページネーション情報の設定
                    this.pagenation.per_page =
                        response.data.data.data_list.per_page;
                    this.pagenation.current_page =
                        response.data.data.data_list.current_page;
                    this.pagenation.last_page =
                        response.data.data.data_list.last_page;
                    this.pagenation.total = response.data.data.data_list.total;
                    if (this.pagenation.current_page === 1) {
                        this.pagenation.prev_page = 1;
                    } else {
                        this.pagenation.prev_page =
                            this.pagenation.current_page - 1;
                    }
                    if (
                        this.pagenation.current_page ===
                        this.pagenation.last_page
                    ) {
                        this.pagenation.next_page = this.pagenation.last_page;
                    } else {
                        this.pagenation.next_page =
                            this.pagenation.current_page + 1;
                    }
                } else {
                    this.$router.push({ name: "logoff" });
                }
            } catch (e) {
                console.log(e);
                this.message = e;

                this.loadingStatus = false;
                setTimeout(() => {
                    this.message = false;
                }, 2000);
            }

            this.loadingStatus = false;
        },
    },
};
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/pages/_mypage.scss";
</style>
