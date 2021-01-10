<template>
    <div class="row">
        <div class="col-sm-12">
            Profile
        </div>
    </div>
</template>
<script>
export default {
    created() {
        window.axios.get('/api/livros').then(response => {
            console.log(response)
        });
        this.$store.commit('increment')
    console.log(this.$store.state.count)
    },
}
</script>
