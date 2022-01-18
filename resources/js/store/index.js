import Vuex from 'vuex';

import auth from './modules/auth';
import error from './modules/error';

const store = new Vuex.Store({
    modules: {
        auth,
        error
    }
})

export default store
