import './bootstrap';
import { createApp } from 'vue';
import router from './routes';
import store from './store';
import App from './App.vue';

const app = createApp(App)
app.use(router).use(store).mount("#app")

app.config.globalProperties.$filters = {
    addComma(value) {
        return value.toLocaleString()
    }
}
