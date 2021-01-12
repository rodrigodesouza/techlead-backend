<template>
    <div class="card" style="">
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title" v-text="livro.nome">Card title</h5>
            <p class="card-text" v-text="livro.resumo">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="javascript:void(0)" class="btn btn-primary" @click="$root.solicitarPedido(livro.id)">Solicita empréstimo</a>
        </div>
    </div>
</template>
<script>
export default {
    props: ['livro']
}
</script>
