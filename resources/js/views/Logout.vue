<template>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: '/logoff',
    methods: {
        ...mapActions('auth',['sendLogoutRequest']),

        async logout () {
            this.sendLogoutRequest().then(() => {
                this.$router.push('/login')
            });
        },

    },
    mounted(){
        this.logout()
    }
}
</script>
