import { createApp } from "vue";

require("./bootstrap");

import App from './App.vue'
import axios from 'axios'
import router from './router'
import "bootstrap/dist/css/bootstrap.css"

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')
