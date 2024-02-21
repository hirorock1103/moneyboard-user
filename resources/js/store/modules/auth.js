import { OK, CREATED, UNPROCESSABLE_ENTITY } from "../../util";
import axios from "../../src/plugins/axios.js";

const state = {
  user: {
    additional_licenses: "",
    address: "",
    admin_password: "",
    available_licenses_total: "",
    company_code: "",
    company_name: "",
    company_rep: "",
    created_at: "",
    email_address: "",
    id: "",
    mobile_number: "",
    motivated_by: "",
    token: "",
    phone_number: "",
    plan_id: "",
    payment_type: 1,
    updated_at: "",
    user_type: "",
  },
  card: {
    number: "",
    valid_year: "",
    valid_month: "",
    security_code: "",
    name: "",
    stripe_token: "",
  },
  apiStatus: null,
  loadingStatus: null,
  signupErrorMessages: null,
  verifyErrorMessages: null,
  loginErrorMessages: null,
  resetLinkErrorMessages: null,
  passwordResetErrorMessages: null,
  company: null,
  contract: null,
  clients: null,
  notifications: null,
  temps: null,
  changeflg: 0,
};

const getters = {
  user: (state) => state.user,
  card: (state) => state.card,
  company: (state) => state.company,
  contract: (state) => state.contract,
  clients: (state) => state.clients,
  //    clientsNumber: state => state.clients.length,
  notifications: (state) => state.notifications,
  temps: (state) => state.temps,
  changeflg: (state) => state.changeflg,
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setLicense(state, license) {
    state.license = license;
  },
  setUserEmail(state, email_address) {
    state.user.email_address = email_address;
  },
  setAddress(state, address) {
    state.user.address = address;
  },
  setCompanyAddress(state, address) {
    state.company.address = address;
  },
  // setUserToken (state, token) {
  //         state.user.token = token
  //     },
  setCard(state, card) {
    state.card = card;
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
  },
  setLoadingStatus(state, status) {
    state.loadingStatus = status;
  },
  setSignupErrorMessages(state, messages) {
    state.signupErrorMessages = messages;
  },
  setVerifyErrorMessages(state, messages) {
    state.verifyErrorMessages = messages;
  },
  setLoginErrorMessages(state, messages) {
    state.loginErrorMessages = messages;
  },
  setResetLinkErrorMessages(state, messages) {
    state.resetLinkErrorMessages = messages;
  },
  setPasswordResetErrorMessages(state, messages) {
    state.passwordResetErrorMessages = messages;
  },
  setCompany(state, company) {
    state.company = company;
  },
  setContract(state, contract) {
    state.contract = contract;
  },
  setClients(state, clients) {
    state.clients = clients;
  },
  setNotifications(state, notifications) {
    state.notifications = notifications;
  },
  setTemps(state, temps) {
    state.temps = temps;
  },
  resetTemps(state) {
    state.temps = null;
  },
  setChangeFlg(state, changeflg) {
    state.changeflg = changeflg;
  },
};

const actions = {
  // 新規登録
  async sendEmailRegisterRequest(context, data) {
    const user_initial = {
      additional_licenses: "",
      address: "",
      admin_password: "",
      available_licenses_total: "",
      company_code: "",
      company_name: "",
      company_rep: "",
      created_at: "",
      email_address: "",
      id: "",
      mobile_number: "",
      motivated_by: "",
      token: "",
      phone_number: "",
      plan_id: "",
      updated_at: "",
      user_type: "",
    };
    const card_initial = {
      number: "",
      valid_year: "",
      valid_month: "",
      security_code: "",
      name: "",
      stripe_token: "",
    };

    context.commit("setApiStatus", null);
    context.commit("setLoadingStatus", true);
    context.commit("setCompany", null);
    context.commit("setUser", user_initial);
    context.commit("setCard", card_initial);
    context.commit("setContract", null);

    const response = await axios.post(
      process.env.MIX_VUE_APP_API_URL + "com/signup",
      data
    );

    if (response.data.status === "OK") {
      context.commit("setApiStatus", true);
      context.commit("setLoadingStatus", false);
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("setLoadingStatus", false);
    // if (response.status === UNPROCESSABLE_ENTITY) {
    if (response.data.status === "NG") {
      // context.commit('setSignupErrorMessages', response.data.message)
      console.log(response.data);
      context.commit(
        "setSignupErrorMessages",
        "既に登録されているメールアドレスです"
      );
    } else {
      context.commit("error/setCode", response.status, { root: true });
    }
  },
  // 仮登録
  async sendVerifyRequest(context, hash) {
    context.commit("setApiStatus", null);
    context.commit("setLoadingStatus", true);
    const response = await axios.get(
      process.env.MIX_VUE_APP_API_URL + "com/verify/" + hash
    );

    if (response.data.status === "OK") {
      context.commit("setApiStatus", true);
      context.commit("setLoadingStatus", false);
      // context.commit('setUserEmail', response.data.email_address);
      localStorage.setItem("registerToken", response.data.data.register_token);
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("setLoadingStatus", false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit("setVerifyErrorMessages", response.data);
    } else {
      context.commit("error/setCode", response.status, { root: true });
    }
  },
  // メール再登録
  async verifyRequest(context, hash) {
    context.commit("setApiStatus", null);
    context.commit("setLoadingStatus", true);

    let url = process.env.MIX_VUE_APP_API_URL + "com/change/mail";
    let item = { token: hash.token, email_address: hash.email_address };
    const response = await axios.post(url, item);

    if (response.data.status === "OK") {
      context.commit("setApiStatus", true);
      context.commit("setLoadingStatus", false);
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("setLoadingStatus", false);
    if (response.data.status === "NG") {
      console.log(response.data);
      context.commit("setVerifyErrorMessages", "メールの認証に失敗しました。");
    } else {
      context.commit("error/setCode", response.status, { root: true });
    }
  },
  updateUser(context, data) {
    context.commit("setUser", data);
  },
  updateCompany(context, data) {
    context.commit("setCompany", data);
  },
  updateCard(context, data) {
    context.commit("setCard", data);
  },
  updateTemps(context, data) {
    context.commit("setTemps", data);
  },
  resetTemps(context) {
    context.commit("resetTemps");
  },
  // ログイン
  async sendLoginRequest(context, data) {
    context.commit("setApiStatus", null);
    context.commit("setLoadingStatus", true);
    const response = await axios.post(
      process.env.MIX_VUE_APP_API_URL + "com/login",
      data
    );
    const card_initial = {
      number: "",
      valid_year: "",
      valid_month: "",
      security_code: "",
      name: "",
      stripe_token: "",
    };

    // console.log(1,response);

    if (response.data.status === "OK") {
      localStorage.setItem("authToken", response.data.data.access_token);
      const data = await axios.post(process.env.MIX_VUE_APP_API_URL + "com/me");
      //console.log(2,data);
      context.commit("setApiStatus", true);
      context.commit("setLoadingStatus", false);
      context.commit("setUser", data.data.data.me);
      context.commit("setLicense", data.data.data.summery);
      context.commit("setCompany", data.data.auth.company);
      context.commit("setContract", data.data.data.contract);
      context.commit("setCard", card_initial);

      // localStorage.setItem('authToken', response.data.token);
      // console.log(3,context);
      // console.log(4,localStorage);
      // console.log(5,state);
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("setLoadingStatus", false);
    // 何の処理か？
    // if (response.status === UNPROCESSABLE_ENTITY) {
    //     context.commit('setLoginErrorMessages', response.data)
    // } else {
    //     context.commit('error/setCode', response.status, { root: true })
    // }
    if (response.data.status === "NG") {
      context.commit("setLoginErrorMessages", response.data.message);
    }
  },
  // ログアウト
  async sendLogoutRequest(context) {
    context.commit("setApiStatus", null);
    const response = await axios.post(
      process.env.MIX_VUE_APP_API_URL + "com/logout"
    );

    if (response.data.status === "OK") {
      context.commit("setApiStatus", true);
      context.commit("setUser", null);
      context.commit("setCompany", null);
      context.commit("setCard", null);
      context.commit("setContract", null);
      localStorage.removeItem("authToken");
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("error/setCode", response.data.status, { root: true });
  },
  async sendResetLinkRequest(context, data) {
    context.commit("setApiStatus", null);
    context.commit("setLoadingStatus", true);
    const response = await axios.post(
      // process.env.MIX_VUE_APP_API_URL + 'user/password/reset/send-email',
      process.env.MIX_VUE_APP_API_URL + "com/reset/password/verify",
      data
    );
    // console.log(response);
    if (response.status === OK) {
      context.commit("setApiStatus", true);
      context.commit("setLoadingStatus", false);
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("setLoadingStatus", false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit("setResetLinkErrorMessages", response.data);
    } else {
      context.commit("error/setCode", response.status, { root: true });
    }
  },
  async sendPasswordResetRequest(context, data) {
    context.commit("setApiStatus", null);
    context.commit("setLoadingStatus", true);
    const response = await axios.post(
      //            process.env.MIX_VUE_APP_API_URL + 'user/password/reset',
      process.env.MIX_VUE_APP_API_URL + "com/reset/password/do",
      data
    );

    console.log("--data--");
    console.log(data);
    console.log("--response--");
    console.log(response);

    if (response.data.status === "OK") {
      context.commit("setApiStatus", true);
      context.commit("setLoadingStatus", false);
      return false;
    }

    context.commit("setApiStatus", false);
    context.commit("setLoadingStatus", false);
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit("setPasswordResetErrorMessages", response.data);
    } else {
      context.commit("error/setCode", response.status, { root: true });
    }
  },
  async fetchCompany(context, data) {
    const response = await axios.get(
      process.env.MIX_VUE_APP_API_URL + "user/company",
      data
    );

    if (response.status !== OK) {
      context.commit("error/setCode", response.status, { root: true });
    }

    context.commit("setCompany", response.data);
  },
  async fetchClients(context, data) {
    const response = await axios.get(
      process.env.MIX_VUE_APP_API_URL + "company/clients-list",
      data
    );

    if (response.status !== OK) {
      context.commit("error/setCode", response.status, { root: true });
    }

    context.commit("setClients", response.data);
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
  //},
  // データ更新
  async updateState(context) {
    const data = await axios.post(process.env.MIX_VUE_APP_API_URL + "com/me");
    // console.log('data',data);
    context.commit("setApiStatus", true);
    context.commit("setLoadingStatus", false);
    context.commit("setUser", data.data.data.me);
    context.commit("setLicense", data.data.data.summery);
    context.commit("setCompany", data.data.auth.company);
    context.commit("setContract", data.data.data.contract);
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
