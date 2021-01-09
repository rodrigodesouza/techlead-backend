<template>
    <div class="col d-flex justify-content-center mt-5">
        <aside class="col-sm-6">
            <p>Recuperar senha</p>
            <div class="card">
                <article class="card-body">
                    <router-link :to="{ name: 'login' }" class="float-right btn btn-outline-primary">Login</router-link>
                    <h4 class="card-title mb-4 mt-1">Sign in</h4>
                    <form>
                        <div class="form-group">
                            <label>Your email</label>
                            <input name="" class="form-control" placeholder="Email" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Enviar e-mail </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div> <!-- card.// -->
        </aside>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
