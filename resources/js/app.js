import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import '../css/global.css'; // import global styles
import axios from 'axios';

const token = localStorage.getItem('authToken');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

createApp(App).use(router).mount('#app');