import createPersistedState from "vuex-persistedstate";

export default {
    state: {
        count: 0,
        accessToken: null,
        usuario: null,
    },
    mutations: {
        increment (state) {
            state.count++
        },
        setToken (state, val) {
            state.accessToken = val;
        },
        setUsuario (state, val) {
            state.usuario = val;
        },
    },
    getters: {
        autenticado: function(state) {
            return (state.usuario &&  state.accessToken) ? true : false;
        }
    },
    plugins: [createPersistedState()],
}
