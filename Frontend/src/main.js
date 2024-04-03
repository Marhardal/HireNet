import './assets/index.css'

import { createApp, markRaw } from 'vue'
import App from './App.vue'
import router from './router'
// import { createProPlugin, inputs } from '@formkit/pro'
import { plugin, defaultConfig} from "@formkit/vue"
import config from "./formkit.config"
import '@formkit/themes/genesis'
import { createProPlugin, inputs } from '@formkit/pro'

import Toast, {POSITION} from "vue-toastification";
import "vue-toastification/dist/index.css";

import { createPinia } from 'pinia';

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const pro = createProPlugin('fk-6335b120ad1', inputs)

const pinia = createPinia();

const app = createApp(App);

app.component('QuillEditor', QuillEditor)


pinia.use(({store}) => {
    store.router = markRaw(router);
});

app.use(pinia);

app.use(router);

const options = {
    timeout: 5000,
    position: POSITION.TOP_LEFT
};

app.use(plugin, defaultConfig(config, { plugins: [pro] }));

app.use( Toast, options);

app.mount('#app');

// createApp(App).use(vuetify).mount('#app');