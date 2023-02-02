
import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import LuisComponent from './components/LuisComponent.vue';



app.component('luis-component', LuisComponent);


app.mount('#App');
