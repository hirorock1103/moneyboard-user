import axios from 'axios'


const axios_instance = axios.create();
axios_instance.interceptors.request.use(async function(config) {
    config.headers = {
        'Authorization' :'Bearer ' + localStorage.getItem('authToken')
    }
    return config
}, function(error) {
    // エラーハンドリング
    return Promise.reject(error);
});

axios_instance.interceptors.response.use(function (response) {
    if(localStorage.getItem('authToken') && response.data.message==='Unauthorized'){

        // console.log('認証失敗(axios)！！');
        // トークンを削除
        localStorage.removeItem('authToken');
        localStorage.removeItem('expierAt');

        // ToDo:状態管理で保持してる情報を削除
        // ログイン画面へ
        // ToDo:メッセージ投げる
        // this.$router.push('/login')
        location.href='/401';
    }
    return response; // 成功時の処理
}, function (error) { // 失敗時の処理
    switch (error.response?.status) {
        case 401: // HTTPステータスに応じて処理
        case 403:
        default:
        // 例外処理
    }
});

export default axios_instance;
