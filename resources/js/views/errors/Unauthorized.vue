<template>

    <main>

        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">

            <div class="container">

                <h2 class="text-center  heading-primary">Unauthorized</h2>

                <h3 class="text-center">接続権限がありません</h3>

                <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">

                    <p class="[ padding-right--16  padding-left--16 ]">接続権限がありません。<br>セッション切れの可能性があります。</p>

                    <p class="margin-bottom--88  [ padding-right--16  padding-left--16 ]">再度ログインし直してください。</p>

                    <router-link to="/login" class="[ btn  btn--accent ]">ログイン画面へ戻る</router-link>

                </div>

            </div>

        </section>

    </main>

</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: '/401',
    methods: {
        ...mapActions('auth',['clearAuth']),

        async logout () {
            this.clearAuth().then(() => {
            });
        },

    },
    mounted(){
        sessionStorage.removeItem('client-search-params');
        sessionStorage.removeItem('premium-search-params');
        this.logout()
    }
}
</script>