export default {
    created: function () {

    },
    methods: {
      login: function (data) {
        var Axios = this.$axios;

        return Axios.post('/api/login', data).then((res) => {
            if (res.data.token !== undefined) {
                this.setUserLogin(res.data);
            }
            return res;
        }).catch((e) => e.response)
      },
      cadastrar: function (data) {
        return this.$axios.post('/api/signup', data).then((res) => {
            return res;
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
          this.$axios.post('/api/logout').then(function (res) {
              self.$store.commit('setUsuario', null);
              self.$store.commit('setToken', null);
              self.$router.push({name: 'login'})
          })
          .catch(e => console.log(e, ' e'))
      },
    }
  }
