import Index from "./components/Index.vue";
import './bootstrap';

import router from "./router";
import {createApp} from "vue";


createApp(Index).use(router).mount('#app')





