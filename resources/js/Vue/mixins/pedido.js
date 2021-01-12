export default {
    methods: {
        solicitarPedido: function(livro_id) {
            var self = this;

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
                }
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
            })
        }
    }
}
