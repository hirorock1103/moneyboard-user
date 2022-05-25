<template>
    <Header />
    <RouterView />
    <Footer />
    <p id="exscript" style="margin-bottom:0"></p>
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
                // 本当はここでエラー内容を拾う
                // console.log(val)
                if (val === INTERNAL_SERVER_ERROR) {
                    this.$router.push('/500')
                } else if (val === UNAUTHORIZED || val === 'NG') {
                    console.log('認証失敗(App.vue)！！');
                    // トークンを削除
                    localStorage.removeItem('authToken')
                    // ストアのuserをクリア
                    this.$store.commit('auth/setUser', null)
                    // ストアの情報をクリア
                    this.$store.commit('setCompany', null)
                    this.$store.commit('setCard', null)
                    this.$store.commit('setContract', null)
                    this.$store.commit('setApiStatus', false)
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
