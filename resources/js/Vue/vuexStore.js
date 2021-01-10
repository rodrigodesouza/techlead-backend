import store from './store';
import Vuex from 'vuex'
window.Vue = require('vue').default;

Vue.use(Vuex)

const stores = new Vuex.Store(store);

export default stores
