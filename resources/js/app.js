/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Vuex from 'vuex'
Vue.use(Vuex)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./components/pages/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('menu-component', require('./Vue/components/MenuComponent.vue').default);
Vue.component('card-component', require('./Vue/components/CardComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//  pages Vue
import LoginPage from './Vue/pages/LoginPage';
import ProfilePage from './Vue/pages/ProfilePage';
import CadastroPage from './Vue/pages/CadastroPage';
import LivrosPage from './Vue/pages/LivrosPage';
import ForgotPage from './Vue/pages/ForgotPage';
import mixin from './Vue/mixin';

const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginPage
        },
        {
            path: '/livros',
            name: 'livros',
            component: LivrosPage,
            meta: { requiresLogin: true }
        },
        {
            path: '/profile',
            name: 'profile',
            component: ProfilePage,
            meta: { requiresLogin: true }
        },
        {
            path: '/cadastrar',
            name: 'cadastrar',
            component: CadastroPage
        },
        {
            path: '/esqueci-minha-senha',
            name: 'forgot',
            component: ForgotPage
        },
    ],
});

import vuexStore from './Vue/vuexStore';

router.beforeEach((to, from, next) => {
    if (vuexStore.getters.autenticado) {
        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + vuexStore.state.accessToken;
    }
    if (to.meta.requiresLogin !== undefined && !vuexStore.getters.autenticado) {
        next({ name: 'login' })
    } else {
        next()
    }
    if (to.name === 'login') {
        next({name: 'livros'})
    }
})

const app = new Vue({
    el: '#app',
    router,
    mixins: [mixin],
    store: vuexStore,
});
