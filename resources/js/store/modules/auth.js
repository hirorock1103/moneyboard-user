import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../../util';
import axios from '../../src/plugins/axios.js'

const state = {
    user: {
        additional_licenses: '',
        address: '',
        admin_password: '',
        available_licenses_total: '',
        company_code: '',
        company_name: '',
        company_rep: '',
        created_at: '',
        email_address: '',
        id: '',
        mobile_number: '',
        motivated_by: '',
        token: '',
        phone_number: '',
        plan_id: '',
        updated_at: '',
        user_type: '',
        // password: '',
        // password_confirm: '',
        // app_password: '',
        // additional_licences: '',
    },
    card: {
        number: '',
        valid_year: '',
        valid_month: '',
        security_code: '',
        name: '',
    },
    apiStatus: null,
    loadingStatus: null,
    signupErrorMessages: null,
    verifyErrorMessages: null,
    loginErrorMessages: null,
    resetLinkErrorMessages: null,
    passwordResetErrorMessages: null,
    company: null,
    clients: null,
    notifications: null
}

const getters = {
    user: state => state.user,
    card: state => state.card,
    company: state => state.company,
    clients: state => state.clients,
    clientsNumber: state => state.clients.length,
    notifications: state => state.notifications
};

const mutations = {
    setUser (state, user) {
        state.user = user
    },
    setUserEmail (state, email_address) {
        state.user.email_address = email_address
    },
    // setUserToken (state, token) {
    //         state.user.token = token
    //     },
    setCard (state, card) {
        state.card = card
    },
    setApiStatus (state, status) {
        state.apiStatus = status
    },
    setLoadingStatus (state, status) {
        state.loadingStatus = status
    },
    setSignupErrorMessages (state, messages) {
        state.signupErrorMessages = messages
    },
    setVerifyErrorMessages (state, messages) {
        state.verifyErrorMessages = messages
    },
    setLoginErrorMessages (state, messages) {
        state.loginErrorMessages = messages
    },
    setResetLinkErrorMessages (state, messages) {
        state.resetLinkErrorMessages = messages
    },
    setPasswordResetErrorMessages (state, messages) {
        state.passwordResetErrorMessages = messages
    },
    setCompany(state, company) {
        state.company = company
    },
    setClients(state, clients) {
        state.clients = clients
    },
    setNotifications(state, notifications) {
        state.notifications =notifications
    }
}

const actions = {
    // 新規登録
    async sendEmailRegisterRequest(context, data) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + "com/signup",
            data
        );

        if (response.status === OK) {
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            return false;
        }

        context.commit('setApiStatus', false);
        context.commit('setLoadingStatus', false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setSignupErrorMessages', response.data)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
    // 仮登録
    async sendVerifyRequest(context, hash) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.get(
            process.env.MIX_VUE_APP_API_URL + "com/verify/" + hash,
        );

        if (response.data.status === OK) {
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            // ToDo:ひとまず
            // context.commit('setUserEmail', response.data.email_address);
            context.commit('setUserEmail', 'test@gamil.com');
            localStorage.setItem('authToken', response.data.data.register_token);
            return false;
        }

        context.commit('setApiStatus', false);
        context.commit('setLoadingStatus', false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setVerifyErrorMessages', response.data)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
    updateUser(context, data) {
        context.commit('setUser', data);
    },
    updateCard(context, data) {
        context.commit('setCard', data);
    },
    // ログイン
    async sendLoginRequest(context, data) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + "com/login",
            data
        );

        console.log(1,response);

        if (response.data.status === 'OK') {
            localStorage.setItem('authToken', response.data.data.access_token);
            const data = await axios.post(
                process.env.MIX_VUE_APP_API_URL + "com/me"
            );
            // console.log(2,data);
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            context.commit('setUser', data.data.data.me);
            context.commit('setCompany', data.data.auth.company);
            // localStorage.setItem('authToken', response.data.token);
            // console.log(3,context);
            // console.log(4,localStorage);
            // console.log(5,state);
            return false;
        }

        context.commit('setApiStatus', false);
        context.commit('setLoadingStatus', false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setLoginErrorMessages', response.data)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
    // ログアウト
    async sendLogoutRequest (context) {
        context.commit('setApiStatus', null)
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + "com/logout"
        );

        if (response.data.status === "OK") {
            context.commit('setApiStatus', true)
            context.commit('setUser', null)
            context.commit('setCompany', null)
            localStorage.removeItem('authToken');
            return false
        }

        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.data.status, { root: true })
    },
    async sendResetLinkRequest(context, data) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + 'user/password/reset/send-email',
            data
        );

        if (response.status === OK) {
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            return false;
        }

        context.commit('setApiStatus', false);
        context.commit('setLoadingStatus', false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setResetLinkErrorMessages', response.data)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
    async sendPasswordResetRequest(context, data) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + 'user/password/reset',
            data
        );

        if (response.status === OK) {
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            return false;
        }

        context.commit('setApiStatus', false);
        context.commit('setLoadingStatus', false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setPasswordResetErrorMessages', response.data)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
    async fetchCompany(context, data) {
        const response = await axios.get(
            process.env.MIX_VUE_APP_API_URL + 'user/company',
            data
        );

        if (response.status !== OK) {
            context.commit('error/setCode', response.status, { root: true })
        }

        context.commit('setCompany', response.data);
    },
    async fetchClients(context, data) {
        const response = await axios.get(
            process.env.MIX_VUE_APP_API_URL + 'company/clients-list',
            data
        );

        if (response.status !== OK) {
            context.commit('error/setCode', response.status, { root: true })
        }

        context.commit('setClients', response.data);
    },
    // TODO: お知らせのAPIが作成された後、URLを合わせてコメント削除
    //async fetchNotifications(context) {
    //    const response = await axios.get(
    //        process.env.MIX_VUE_APP_API_URL + 'notifications'
    //    );

    //    if (response.status !== OK) {
    //        context.commit('error/setCode', response.status, { root: true })
    //    }

    //    context.commit('setNotifications', response.data);
    //}
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
