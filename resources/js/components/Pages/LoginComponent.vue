<template>
    <div class="col d-flex justify-content-center mt-5">
        <aside class="col-sm-6">
            <p>Login form style 1</p>
            <div class="card">
                <article class="card-body">
                    <!-- <a href="" class="float-right btn btn-outline-primary">Sign up</a> -->
                    <router-link :to="{name: 'cadastrar'}" class="float-right btn btn-outline-primary">Cadastre-se</router-link>
                    <h4 class="card-title mb-4 mt-1">Sign in</h4>
                    <form>
                        <div class="form-group">
                            <label>Your email</label>
                            <input name="" class="form-control" placeholder="Email" type="email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <router-link class="float-right" :to="{ name: 'forgot' }">Forgot?</router-link>
                            <label>Your password</label>
                            <input class="form-control" placeholder="******" type="password">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                        <div class="checkbox">
                            <label> <input type="checkbox"> Save password </label>
                        </div> <!-- checkbox .// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Login  </button>
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
