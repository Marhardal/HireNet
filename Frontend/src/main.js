import './assets/index.css'

import { createApp, markRaw } from 'vue'
import App from './App.vue'
import router from './router'
import { plugin, defaultConfig} from "@formkit/vue"
import config from "./formkit.config"
import '@formkit/themes/genesis'

import Toast, {POSITION} from "vue-toastification";
import "vue-toastification/dist/index.css";

import { createPinia } from 'pinia'

const pinia = createPinia();

const app = createApp(App);

pinia.use(({store}) => {
    store.router = markRaw(router);
});

app.use(pinia);

app.use(router);

const options = {
    timeout: 5000,
    position: POSITION.TOP_LEFT
};

app.use(plugin, defaultConfig(config));

app.use( Toast, options);

app.mount('#app');

// createApp(App).use(vuetify).mount('#app');