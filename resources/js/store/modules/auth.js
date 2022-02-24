import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../../util';

const state = {
    user: {
        company_name: '',
        address: '',
        phone_number: '',
        company_rep: '',
        mobile_number: '',
        email_address: '',
        password: '',
        password_confirm: '',
        app_password: '',
        app_password_confirm: '',
        plan_id: '',
        additional_licences: '',
        motivated_by: ''
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
    async sendEmailRegisterRequest(context, data) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + 'com/signup',
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
    async sendVerifyRequest(context, hash) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.get(
            process.env.MIX_VUE_APP_API_URL + 'user/verify/' + hash
        );

        if (response.status === OK) {
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            context.commit('setUserEmail', response.data.email_address);
            localStorage.setItem('authToken', response.data.token);
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
    async sendLoginRequest(context, data) {
        context.commit('setApiStatus', null);
        context.commit('setLoadingStatus', true);
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + 'user/login',
            data
        );

        if (response.status === OK) {
            context.commit('setApiStatus', true);
            context.commit('setLoadingStatus', false);
            context.commit('setUser', response.data.user);
            localStorage.setItem('authToken', response.data.token);
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
    async sendLogoutRequest (context) {
        context.commit('setApiStatus', null)
        const response = await axios.post(
            process.env.MIX_VUE_APP_API_URL + 'user/logout'
        );

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', null)
            localStorage.removeItem('authToken');
            return false
        }

        context.commit('setApiStatus', false)
        context.commit('error/setCode', response.status, { root: true })
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
