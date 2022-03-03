import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'

import auth from './modules/auth';
import error from './modules/error';

const store = new Vuex.Store({
    modules: {
        auth,
        error
    },
    plugins: [createPersistedState({storage: window.sessionStorage})],
})

export default store
