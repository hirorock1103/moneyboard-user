import axios2 from 'axios'

const axios2_instance = axios2.create();
axios2_instance.interceptors.request.use(config => {
    config.headers = {
       'Authorization' :'Bearer sk_test_51KENLHHJkC9uqpQdh7DQExDEWYNl1MDiW3SpoXJgZ9acdiH1L6Adrsf1SHn7wzdsHEywfgVzkpW6gJ8y1bls9YK600Vo2MXJPR'
    }
    return config
})

export default axios2_instance;
