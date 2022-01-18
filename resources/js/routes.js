import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home.vue';
import Signup from './views/Signup.vue';
import Completion from './views/Completion.vue';
import Verify from './views/Verify.vue';
import RegisterUser from './views/register/User.vue';
import RegisterUserConfirm from './views/register/UserConfirm.vue';
import RegisterCard from './views/register/Card.vue';
import RegisterCardConfirm from './views/register/CardConfirm.vue';
import Login from './views/Login.vue';
import PasswordEmail from './views/password/Email.vue';
import PasswordReset from './views/password/Reset.vue';
import MypageHome from './views/mypage/Home.vue';
import SystemError from './views/errors/System.vue';
import NotFound from './views/errors/NotFound.vue';

//Vue.config.devtools = true;

const guest = (to, from, next) => {
    if (!localStorage.getItem('authToken')) {
        return next();
    } else {
        return next('/');
    }
};

const auth = (to, from, next) => {
    if (localStorage.getItem('authToken')) {
        return next();
    } else {
        return next('/login');
    }
};

const routes = [
    {
        path: '/',
        component: Home,
        name:'home',
    },
    {
        path: '/signup',
        component: Signup,
        name:'signup',
    },
    {
        path: '/signup/completion',
        component: Completion,
        name:'signup-completion',
        props: true,
    },
    {
        path: '/verify/:hash',
        component: Verify,
        name:'verify',
        props: true,
    },
    {
        path: '/register/user',
        component: RegisterUser,
        name:'register-user',
        beforeEnter: auth,
    },
    {
        path: '/register/user-confirm',
        component: RegisterUserConfirm,
        name:'register-user-confirm',
        beforeEnter: auth,
    },
    {
        path: '/register/card',
        component: RegisterCard,
        name:'register-card',
        beforeEnter: auth,
    },
    {
        path: '/register/card-confirm',
        component: RegisterCardConfirm,
        name:'register-card-confirm',
        beforeEnter: auth,
    },
    {
        path: '/register/completion',
        component: Completion,
        name:'register-completion',
        beforeEnter: auth,
        props: true,
    },
    {
        path: '/login',
        component: Login,
        name:'login',
    },
    {
        path: '/password/email',
        component: PasswordEmail,
        name:'password-email',
        beforeEnter: guest,
    },
    {
        path: '/password/request/completion',
        component: Completion,
        name:'request-completion',
        beforeEnter: guest,
        props: true,
    },
    {
        path: '/password/reset',
        component: PasswordReset,
        name:'password-reset',
        beforeEnter: auth,
    },
    {
        path: '/mypage',
        component: MypageHome,
        name:'mypage-home',
        beforeEnter: auth,
    },
    {
        path: '/500',
        component: SystemError
    },
    {
        path: '/:catchAll(.*)',
        component: NotFound
    }
];

const router = createRouter({
    routes,
    history: createWebHistory(),
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    }
})

export default router;
