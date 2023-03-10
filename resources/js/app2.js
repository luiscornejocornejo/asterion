
import './bootstrap';
import { createApp } from 'vue';


const app2 = createApp({});

import LuisComponent from './components/ClienteComponent.vue';



app2.component('cliente-component', LuisComponent);


app2.mount('#App');
