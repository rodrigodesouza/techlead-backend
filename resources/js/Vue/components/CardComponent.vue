<template>
    <div class="card mb-5" style="" ref="pedido">
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title" v-text="livro.nome">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted" v-text="livro.autor.nome">Card subtitle</h6>
            <p class="card-text" v-text="livro.resumo">card's content.</p>

            <a href="javascript:void(0)" class="btn btn-primary solicitar" @click="$root.solicitarPedido(livro.id, $refs)" ref="acao"
                v-if="showButtons && livro.status_disponivel == 'disponivel'"
            > Solicita empréstimo</a>

            <a href="javascript:void(0)" class="btn btn-secondary disabled" disabled
                v-if="showButtons && livro.status_disponivel == 'indisponivel'"
            > Indisponível</a>

            <a href="javascript:void(0)" class="btn btn-warning"
                v-if="showButtons && livro.status_disponivel == 'solicitado'"
            > Solicitação enviada</a>

            <a href="javascript:void(0)" class="btn btn-success"
                v-if="showButtons && livro.status_disponivel == 'solicitado_aprovado'"
            > Solicitação aprovada</a>

            <a href="javascript:void(0)" class="btn btn-primary float-right" @click="$root.devolverLivro(pedido.id, $refs)" ref="devolver"
                v-if="showButtons && devolver && pedido"
            > Devolver</a>

        </div>
    </div>
</template>
<script>
export default {
    props: {
        livro: Object,
        pedido: Object,
        devolver: {
            type: Boolean,
            default: false
        },
        showButtons: {
            type: Boolean,
            default: true,
        }
    },
    computed: {}

}
</script>
