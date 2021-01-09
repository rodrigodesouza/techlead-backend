/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./components/pages/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//  pages Vue
import LoginComponent from './components/pages/LoginComponent';
import ProfileComponent from './components/pages/ProfileComponent';
import CadastroComponent from './components/pages/CadastroComponent';
import ForgotComponent from './components/pages/ForgotComponent';

const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginComponent
        },
        {
            path: '/profile',
            name: 'profile',
            component: ProfileComponent
        },
        {
            path: '/cadastrar',
            name: 'cadastrar',
            component: CadastroComponent
        },
        {
            path: '/esqueci-minha-senha',
            name: 'forgot',
            component: ForgotComponent
        },
    ],
});

const app = new Vue({
    el: '#app',
    router,
});
