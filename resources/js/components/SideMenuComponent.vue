<template>

    <aside class="mypage__aside  [ display-none  display-block-large ]  flex-grow-1-large">
        <nav class="nav  menu">
            <div class="menu__inner  text-white">

                <ul
                    v-for="(menu, index) in menuItems"
                    :class="{ 'menu__list--top':index === 'topMenu','menu__list--bottom':index === 'bottomMenu' }"
                    :key="index">

                    <li
                        v-for="item in menu"
                        :class="{ 'menu__link--active': item.active == true }"
                        class="menu__link"
                        :key="item.id">

                        <router-link
                            v-if="item.url !== ''"
                            :to="item.url"
                            exact-active-class="menu__link--active">
                            <span class="menu__icon  icon  solid" :class="[item.icon]"></span>

                            <span v-if="item.subtitle !== ''">
                                {{ item.title }}<br>
                                <small>{{ item.subtitle }}</small>
                            </span>

                            <span v-else>{{ item.title }}</span>
                        </router-link>

                        <button v-else @click="logout" class="btn">
                            <span class="menu__icon  icon  solid" :class="[item.icon]"></span>
                            <span>{{ item.title }}</span>
                        </button>
                    </li>

                </ul>

            </div>
        </nav>
    </aside>

</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {
            menuItems: {
                topMenu: [
                    {
                        id: 1,
                        url: '/mypage',
                        icon: 'fa-home',
                        title: 'マイページTOP',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 2,
                        url: '/mypage/company',
                        icon: 'fa-pen-nib',
                        title: '登録情報の確認・変更',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 3,
                        url: '/mypage/company/reps-list',
                        icon: 'fa-user-circle',
                        title: '担当者情報の登録・変更・削除',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 4,
                        url: '/mypage/company/client/rep',
                        icon: 'fa-building',
                        title: '登録企業の担当者変更・削除',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 5,
                        url: '/mypage/company/plan',
                        icon: 'fa-list',
                        title: 'プラン変更 / 使用会社数の増減',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 6,
                        url: '/mypage/company/premium/client-list',
                        icon: 'fa-medal',
                        title: 'プレミアムプラン',
                        subtitle: '(顧客情報管理)',
                        active: false
                    },
                    {
                        id: 7,
                        url: '/mypage/company/email',
                        icon: 'fa-envelope',
                        title: 'メールアドレスの変更',
                        subtitle: '(管理者サイトログインID)',
                        active: false
                    },
                    {
                        id: 8,
                        url: '/mypage/company/password',
                        icon: 'fa-key',
                        title: 'パスワードの変更',
                        subtitle: '(管理者サイトログインパス)',
                        active: false
                    }
                ],
                bottomMenu: [
                    {
                        id: 9,
                        url: '/mypage/opinion',
                        icon: 'fa-comments',
                        title: 'ご意見・ご要望',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 10,
                        url: '/mypage/inquiry',
                        icon: 'fa-question-circle',
                        title: 'お問い合わせ',
                        subtitle: '',
                        active: false
                    },
                    {
                        id: 11,
                        url: '/logout',
                        icon: 'fa-sign-out-alt',
                        title: 'ログアウト',
                        subtitle: '',
                        active: false
                    }
                ]
            },
            activeButton: false,
        };
    },
    name: 'SideMenu',

    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters('auth', ['user'])
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
