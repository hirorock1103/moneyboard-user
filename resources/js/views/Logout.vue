<template>
    <p style="text-align: center; margin: 100px 0">ログイン画面に遷移します</p>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: "/logoff",
    methods: {
        ...mapActions("auth", ["sendLogoutRequest"]),

        async logout() {
            this.sendLogoutRequest().then(() => {
                this.$router.push("/login");
            });
        },
    },
    mounted() {
        this.logout();
    },
};
</script>
