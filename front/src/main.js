import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from "./store";
import './assets/styles/tailwind.css';

const app = createApp(App);

app.use(router)

app.config.globalProperties.$store=store;
app.config.globalProperties.$router=router;

app.mount('#app')