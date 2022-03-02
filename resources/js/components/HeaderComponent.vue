<template>
    <header class="[ header  header--fixed ]">
        <div class="header__inner">
            <div class="header__title">
                <router-link to="/" class="header__logo">
                    <span class="header__logo-image">
                        <img src="/images/header_logo.png">
                    </span>
                    <span class="header__logo-title  [ logo  logo__font-main ]">MoneyBoard</span>
                </router-link>
                <div class="header__subtitle">
                    <span class="[ logo  logo__font-sub ]">Finance × Technology × Laboratory</span>
                </div>
            </div>
            <nav class="[ nav  nav--inline  nav--primary ]  [ display-none  display-block-large ]">
                <ul>
                    <li v-if="company">
                        <button class="[ btn btn--link ]" @click="logout">ログアウト</button>
                    </li>
                    <li v-else>
                        <router-link to="/login" class="nav__link">ログイン</router-link>
                    </li>
                    <li
                        v-if="company"
                        class="[ margin-left--0 margin-right--0 ]  [ margin-left-medium--12 margin-right-medium--12 ]">
                        <router-link to="/mypage"  class="[ btn  btn--accent ]">マイページへ</router-link>
                    </li>
                    <li
                        v-else
                        class="[ margin-left--0 margin-right--0 ]  [ margin-left-medium--12 margin-right-medium--12 ]">
                        <router-link to="/signup"  class="[ btn  btn--accent ]">新規登録</router-link>
                    </li>
                </ul>
            </nav>
            <nav class="menu-button  display-none-large" v-on:click="MenuBtn =! MenuBtn" v-bind:class="{ 'menu-visible': MenuBtn }">
                <div class="menu-button__bar bar1"></div>
                <div class="menu-button__bar bar2"></div>
                <div class="menu-button__bar bar3"></div>
            </nav>
            <Menu v-bind:class="{ 'menu-visible': MenuBtn }" />
        </div>
    </header>
</template>

<script>
import Menu from './MenuComponent.vue';
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {
            MenuBtn: false,
        };
    },
    name: 'Header',
    components: {
        Menu
    },

    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters('auth', ['company'])
    },

    methods: {
        ...mapActions('auth', ['sendLogoutRequest']),
        async logout () {
            this.sendLogoutRequest().then(() => {
                if (this.apiStatus) {
                    this.$router.push('/login')
                }
            });
        }
    }
}
</script>
