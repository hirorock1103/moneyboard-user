<template>
    <nav class="nav  [ menu  menu__hidden ] display-none-large">
        <div class="menu__inner  text-white">

            <ul v-if="company" class="menu__list--top">

                <li class="menu__link">
                    <router-link to="/mypage">
                        <span class="menu__icon  [ icon  solid  fa-home ]"></span>
                        <span>マイページTOP</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company">
                        <span class="menu__icon  [ icon  solid  fa-pen-nib ]"></span>
                        <span>登録情報</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/card">
                        <span class="menu__icon  [ icon  solid  fa-pen-nib ]"></span>
                        <span>カード情報</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company/reps-list">
                        <span class="menu__icon  [ icon  solid  fa-user-circle ]"></span>
                        <span>担当者一覧</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company/client/rep">
                        <span class="menu__icon  [ icon  solid  fa-building ]"></span>
                        <span>登録企業の担当者変更・削除</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company/plan">
                        <span class="menu__icon  [ icon  solid  fa-list ]"></span>
                        <span>ご利用プラン</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company/premium/client-list">
                        <span class="menu__icon  [ icon  solid  fa-medal ]"></span>
                        <span>プレミアムプラン<br>
                            <small>(顧客情報管理)</small>
                        </span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company/email">
                        <span class="menu__icon  [ icon  solid  fa-envelope ]"></span>
                        <span>メールアドレス変更<br>
                            <small>(管理者サイトログインID)</small>
                        </span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/mypage/company/password">
                        <span class="menu__icon  [ icon  solid  fa-key ]"></span>
                        <span>パスワード変更<br>
                            <small>(管理者サイトログインパス)</small>
                        </span>
                    </router-link>
                </li>

            </ul>

            <ul v-if="company" class="menu__list--bottom">

                <li class="menu__link">
                    <router-link to="/mypage/opinion">
                        <span class="menu__icon  [ icon  solid  fa-comments ]"></span>
                        <span>ご意見・ご要望</span>
                    </router-link>
                </li>
                <li class="menu__link">
                    <router-link to="/mypage/inquiry">
                        <span class="menu__icon  [ icon  solid  fa-question-circle ]"></span>
                        <span>お問い合わせ</span>
                    </router-link>
                </li>
                <li class="menu__link">
                    <button @click="logout" class="btn">
                        <span class="menu__icon  [ icon  solid  fa-sign-out-alt ]"></span>
                        <span>ログアウト</span>
                    </button>
                </li>
            </ul>


            <ul v-else class="menu__list--top">

                <li class="menu__link">
                    <router-link to="/login">
                        <span class="menu__icon  [ icon  solid  fa-sign-in-alt ]"></span>
                        <span>ログイン</span>
                    </router-link>
                </li>

                <li class="menu__link">
                    <router-link to="/signup">
                        <span class="menu__icon  [ icon  solid  fa-pen ]"></span>
                        <span>新規登録</span>
                    </router-link>
                </li>

            </ul>

        </div>
    </nav>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    name: 'Menu',

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
