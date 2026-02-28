import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'

import auth from './modules/auth';
import error from './modules/error';

const store = new Vuex.Store({
    modules: {
        auth,
        error
    },
    plugins: [createPersistedState({
        storage: window.sessionStorage,
        reducer: (state) => {
            // loadingStatusは永続化しない
            const { auth: { loadingStatus, ...authRest }, ...rest } = state;
            return {
                ...rest,
                auth: {
                    ...authRest,
                    loadingStatus: false
                }
            };
        }
    })],
})

export default store
