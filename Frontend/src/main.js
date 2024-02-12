import './assets/index.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { plugin, defaultConfig} from "@formkit/vue"
import config from "./formkit.config"
import '@formkit/themes/genesis'

import Toast, {POSITION} from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp(App);

app.use(router)

const options = {
    timeout: 5000,
    position: POSITION.TOP_LEFT
};

app.use(plugin, defaultConfig(config));

app.use( Toast, options)

app.mount('#app');

// createApp(App).use(vuetify).mount('#app');