import './bootstrap';
import {createApp} from 'vue'
import axios from 'axios';
window.axios = axios;
import App from './components/App.vue'

createApp(App).mount("#app")
