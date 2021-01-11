export default {
    created: function () {
      this.hello()
    },
    methods: {
      hello: function () {
        console.log('hello from mixin!')
      },
      login: function (data) {
        var Axios = window.axios;
        var self = this;

        return Axios.post('/api/login', data).then((res) => {
            // this.$store.commit('setToken', res.data.token)

            // self.$router.push({name: 'profile'})
            if (res.data.token !== undefined) {
                this.setUserLogin(res.data);
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.token;
            }
            return res;
        }).catch((e) => e.response)
      },
      cadastrar: function (data) {
        return window.axios.post('/api/signup', data).then((res) => {
            return res;
            // this.$store.commit('setToken', res.data.token)
            // Axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.token;
            // self.$router.push({name: 'profile'})
        }).catch((e) => {
            return e.response;
        })
      },
      validaEmail: function (email) {
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      },
      setUserLogin: function(data) {
        this.$store.commit('setUsuario', data);
        this.$store.commit('setToken', data.token);
      },
      userLogout: function(data) {
          var self = this;
          window.axios.post('/api/logout').then(function (res) {
              self.$store.commit('setUsuario', null);
              self.$store.commit('setToken', null);
              self.$router.push({name: 'login'})
              console.log('deslogou')
          })
          .catch(e => console.log(e, ' e'))
      },
    }
  }
