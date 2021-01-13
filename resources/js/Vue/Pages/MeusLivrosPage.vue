<template>
    <div class="card">
        <div class="card-header">
            Livros comigo
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4" v-for="pedido of $root.pedidos" :key="pedido.id">
                    <card-component :livro="pedido.livro" :pedido="pedido" :devolver="true" />
                </div>
            </div>
            <div class="row" v-if="$root.done && Object.keys($root.pedidos).length === 0">
                <div class="col-sm-12">
                    <p>ainda não tem nenhum livro com você.</p>
                    <router-link :to="{name: 'livros'}" class="btn btn-primary">Selecionar livro(0)</router-link>
                </div>
            </div>
        </div>
        <div class="card-header">
            Histórico (seus últimos livros)
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4" v-for="historico of $root.historicos" :key="historico.id">
                    <card-component :livro="historico.livro" :historico="historico" :showButtons="false"/>
                </div>
            </div>
            <div class="row" v-if="$root.historicos !== null && Object.keys($root.historicos).length === 0">
                <div class="col-sm-12">
                    <p>ainda não tem nenhum livro no seu histórico.</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {

        }
    },
    created() {
        this.$root.getPedidos()
        this.$root.getHistorico()
    },
    methods: {

    },
}
</script>
