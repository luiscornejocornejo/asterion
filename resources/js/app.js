
import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import LuisComponent from './components/LuisComponent.vue';

import ClienteComponent from './components/ClienteComponent.vue';


app.component('luis-component', LuisComponent);
app.component('cliente-component', ClienteComponent);


app.mount('#App');
