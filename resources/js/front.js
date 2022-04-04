require('./bootstrap');

window.Vue = require('vue');

import App from './views/App';
import Apartment from './pages/Apartment';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes:  [
            {
                path: '/apartments/:id',
                name: 'apartment',
                props: true, 
                component: Apartment
            },
        ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});

