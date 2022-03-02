import axios from 'axios'

const axios_instance = axios.create();
axios_instance.interceptors.request.use(config => {
    config.headers = {
        'Authorization' :'Bearer ' + localStorage.getItem('authToken') 
    }
    return config
})

export default axios_instance;