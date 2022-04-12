import axios from 'axios'

const axios_instance = axios.create();
axios_instance.interceptors.request.use(config => {
    config.headers = {
        'Authorization' :'Bearer ' + localStorage.getItem('authToken') 
    }
    return config
})

axios_instance.interceptors.response.use(function (response) {
    if(response.data.message==='Unauthorized'){
        // トークンを削除
        localStorage.removeItem('authToken')
        // ToDo:状態管理で保持してる情報を削除
        // ログイン画面へ
        // ToDo:メッセージ投げる
        console.log('test');
        this.$router.push({
           name: 'login',
           params: {
               message2: "テスト",
            },
        })
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