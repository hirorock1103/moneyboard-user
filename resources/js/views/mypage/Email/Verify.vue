<template>
    <main>
        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
            <div class="container">
                <h2 v-show="!verifyErrors" class="text-center  heading-primary">メールアドレスの確認</h2>
                <p v-show="!verifyErrors" class="text-center">少々お待ちください…</p>
                <loading v-model:active="loadingStatus"
                        :can-cancel="false"
                        :is-full-page="false"
                        :color="'#2FBCED'"
                        :height="90"
                        :width="100" />
                <div
                    class="form-text  text-danger  margin-bottom--24"
                    v-if="verifyErrors">
                    <span v-for="msg in verifyErrors" :key="msg">{{ msg }}</span>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import { mapGetters, mapState, mapActions } from 'vuex';

export default {
    name: 'verify',
    components: {
        Loading
    },
    data() {},
    mounted() {
        this.verifyRequest(this.$route.query).then(() => {
            if (this.apiStatus) {
                // ToDo:メッセージ投げる
                this.$router.push({ 
                    name:'Email_complete'
                });
            }
        });
    },
    computed: {
        ...mapGetters('auth', ['user']),
        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            verifyErrors: state => state.auth.verifyErrorMessages,
            loadingStatus: state => state.auth.loadingStatus,
        })
    },
    methods: {
        ...mapActions('auth', ['verifyRequest', 'updateTemps', 'resetTemps']),
        clearError () {
            this.$store.commit('auth/setVerifyErrorMessages', null)
        }
    },
    created () {
        this.clearError()
    }
};
</script>
