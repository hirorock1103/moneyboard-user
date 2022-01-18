<template>

    <Header />

    <RouterView />

    <Footer />

</template>

<script>
import Header from './components/HeaderComponent.vue';
import Footer from './components/FooterComponent.vue';
import { NOT_FOUND, UNAUTHORIZED, INTERNAL_SERVER_ERROR } from './util';

export default {
    components: {
        Header,
        Footer
    },

    computed: {
        errorCode () {
            return this.$store.state.error.code
        }
    },

    watch: {
        errorCode: {
            async handler (val) {
                if (val === INTERNAL_SERVER_ERROR) {
                    this.$router.push('/500')
                } else if (val === UNAUTHORIZED) {
                    // トークンを削除
                    localStorage.removeItem('authToken')
                    // ストアのuserをクリア
                    this.$store.commit('auth/setUser', null)
                    // ログイン画面へ
                    this.$router.push('/login')
                } else if (val === NOT_FOUND) {
                    this.$router.push('/not-found')
                }
            },
            immediate: true
        },
        $route () {
            this.$store.commit('error/setCode', null)
        }
    }
}
</script>
