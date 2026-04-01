<template>
    <Header v-if="!$route.meta.hideDefaultLayout" />
    <RouterView />
    <Footer v-if="!$route.meta.hideDefaultLayout" />
    <p id="exscript" style="margin-bottom: 0"></p>
</template>

<script>
import Header from "./components/HeaderComponent.vue";
import Footer from "./components/FooterComponent.vue";
import { NOT_FOUND, UNAUTHORIZED, INTERNAL_SERVER_ERROR } from "./util";

export default {
    components: {
        Header,
        Footer,
    },
    computed: {
        errorCode() {
            return this.$store.state.error.code;
        },
    },
    watch: {
        errorCode: {
            async handler(val) {
                if (val === INTERNAL_SERVER_ERROR) {
                    this.$router.push("/500");
                } else if (val === UNAUTHORIZED) {
                    this.$router.push("/401");
                } else if (val === NOT_FOUND) {
                    this.$router.push("/not-found");
                } else if (val === "NG") {
                    // トークンを削除
                    localStorage.removeItem("authToken");
                    // ストアのuserをクリア
                    this.$store.commit("auth/setUser", null);
                    // ストアの情報をクリア
                    this.$store.commit("auth/setCompany", null);
                    this.$store.commit("auth/setCard", null);
                    this.$store.commit("auth/setContract", null);
                    this.$store.commit("auth/setApiStatus", false);
                    // ログイン画面へ
                    this.$router.push("/login");
                }
            },
            immediate: true,
        },
        $route() {
            this.$store.commit("error/setCode", null);
        },
    },
};
</script>
