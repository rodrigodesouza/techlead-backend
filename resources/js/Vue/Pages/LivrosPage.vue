<template>
    <div class="card">
        <div class="card-header">
            Livros
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4" v-for="livro of livros" :key="livro.id">
                    <card-component :livro="livro" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            livros: null,
        }
    },
    created() {
        this.getLivros()
    },
    methods: {
        getLivros() {
            window.axios.get('/api/livros').then((res) => {
                this.livros = res.data;
            })
        }
    },
}
</script>
