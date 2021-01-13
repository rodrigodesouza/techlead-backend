export default {
    data() {
        return {
            statusLivro: null,
            galeriaLivros: null,
            pedidos: null,
            done: false,
            historicos: null,
        }
    },
    methods: {
        getPedidos() {
            this.$axios.get('/api/pedidos/emprestados').then((res) => {
                this.pedidos = res.data.data;
                this.done = true;
            });
        },
        getHistorico() {
            this.$axios.get('/api/pedidos/historico', {
                params: {
                    status_pedido: 'devolvido',
                    limit: 9,
                    order: 'desc'
                }
            }).then((res) => {
                this.historicos = res.data.data;
            });
        },
        alteraStatusLivro(livro_id, solicitacao) {
            if (this.galeriaLivros !== null && Object.keys(this.galeriaLivros).length > 0) {
                this.galeriaLivros = this.galeriaLivros.map((v, i) => {
                    if (v.id === livro_id) {
                        let novo = {
                            status_disponivel: 'solicitado'
                        }
                        return {...v, ...novo};
                    } else {
                        return v;
                    }
                })
            }
        },
        solicitarPedido: function(livro_id, el) {
            var self = this;
            el.acao.classList.add("disabled");

            this.$axios.post('/api/livros/solicitar', {
                livro_id,
            })
            .then(function(response) {
                if (response.data.error !== undefined && response.data.error == true ) {
                    self.$notify({
                        title: 'Error!',
                        text: (response.data.message !== undefined) ? response.data.message : '',
                        style: 'error',
                    });
                } else if (response.status !== undefined && (response.status == 200 || response.status == 201)) {
                    self.$notify({
                        title: 'Sucesso!',
                        text: (response.data.message !== undefined) ? response.data.message : '',
                        style: 'success',
                    });

                    if (response.data?.solicitacao !== undefined) {
                        self.alteraStatusLivro(livro_id, response.data.solicitacao)
                    }
                }
                el.acao.classList.remove("disabled");
            })
            .catch(function(e) {
                var msg = 'Erro ao enviar pedido';
                if (e.response?.data?.message !== undefined) {
                    msg = e.response.data?.message
                }
                self.$notify({
                    title: 'Error!',
                    text: msg,
                    style: 'error'
                })
                el.acao.classList.remove("disabled");
            })

        },
        devolverLivro: function(pedido_id, el) {
            var self = this;
            el.devolver.classList.add("disabled");

            this.$axios.put('/api/livros/devolver', {
                pedido_id,
            })
            .then(function(response) {
                if (response.data.error !== undefined && response.data.error == true ) {
                    self.$notify({
                        title: 'Error!',
                        text: (response.data.message !== undefined) ? response.data.message : '',
                        style: 'error',
                    });
                } else if (response.status !== undefined && (response.status == 200 || response.status == 201)) {
                    self.$notify({
                        title: 'Sucesso!',
                        text: 'livro devolvido.',
                        style: 'success',
                    });
                    el.pedido.remove();
                    self.getPedidos();
                    self.getHistorico()
                }
                el.devolver.classList.remove("disabled");
            })
            .catch(function(e) {
                var msg = 'Erro ao enviar pedido';
                if (e.response?.data?.message !== undefined) {
                    msg = e.response.data?.message
                }
                self.$notify({
                    title: 'Error!',
                    text: msg,
                    style: 'error'
                })
                el.devolver.classList.remove("disabled");
            })
        },
    },
    computed: {
        getUsuario() {
            return this.$store.state.usuario;
        }
    }
}
