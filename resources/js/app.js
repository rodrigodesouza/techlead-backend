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

// const files = require.context('./components/pages/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('menu-component', require('./Vue/components/MenuComponent.vue').default);
Vue.component('card-component', require('./Vue/components/CardComponent.vue').default);

import mixin from './Vue/mixin';
import routes from './Vue/routes';

const router = routes;

import vuexStore from './Vue/vuexStore';

let apiAxios = axios.create({
    timeout: 5000,
});

router.beforeEach((to, from, next) => {
    if (vuexStore.getters.autenticado) {
        apiAxios.defaults.headers.common['Authorization'] = 'Bearer ' + vuexStore.state.accessToken;
    }
    if (to.meta.requiresLogin !== undefined && !vuexStore.getters.autenticado) {
        next({ name: 'login' })
    } else {
        next()
    }
    if (to.name === 'login') {
        next({name: 'livros'})
    }
});

apiAxios.interceptors.response.use((response) => {
    return response;
}, (error) => {
    if (error.response.status !== undefined && error.response.status === 401) {
        vuexStore.commit('setUsuario', null);
        vuexStore.commit('setToken', null);
        router.push({name: 'profile'})
    }

    throw error;
});

Vue.prototype.$axios = apiAxios;

const app = new Vue({
    el: '#app',
    router,
    mixins: [mixin],
    store: vuexStore,
});
