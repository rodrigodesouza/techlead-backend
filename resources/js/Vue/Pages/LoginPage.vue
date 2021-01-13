<template>
    <div class="row">
        <div class="col d-flex justify-content-center mt-5">
            <aside class="col-sm-6">
                <p class="text-white">Login</p>
                <div class="card">
                    <article class="card-body">
                        <router-link :to="{name: 'cadastrar'}" class="float-right btn btn-outline-primary">Cadastre-se</router-link>
                        <h4 class="card-title mb-4 mt-1">Sou cadastrado</h4>
                        <form id="LOGIN" @submit="logar" action="javascript:void(0)" method="post">
                            <p v-if="errors.length || titulo_erros" class="alert alert-danger">
                                <b v-text="titulo_erros"></b>
                                <ul>
                                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                                </ul>
                            </p>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" placeholder="Email" type="email"  id="email" name="email" v-model="dados.email">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <router-link class="float-right" :to="{ name: 'forgot' }">Esqueceu?</router-link>
                                <label>Senha</label>
                                <input class="form-control" placeholder="" type="password" autocomplete="off" aria-autocomplete="off" name="password" id="password" v-model="dados.password">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                            <!-- <div class="checkbox">
                                <label> <input type="checkbox"> Save password </label>
                            </div>  -->
                            <!-- checkbox .// -->
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" > Login  </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
                </div> <!-- card.// -->
            </aside>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                titulo_erros: null,//'Por favor, corrija o(s) seguinte(s) erro(s):',
                errors: [],
                dados: {
                    email: null,
                    password: null,
                }
            }
        },
        methods: {
            logar: async function(e) {
                e.preventDefault();
                this.errors = [];

                if (!this.dados.email) {
                    this.errors.push('O email é obrigatório.');
                } else if(!this.$root.validaEmail(this.dados.email)) {
                    this.errors.push('Utilize um e-mail válido.');
                }

                if (!this.dados.password) {
                    this.errors.push('A senha é obrigatório.');
                }

                if (!this.errors.length) {
                    let retorno = await this.$root.login(this.dados);

                    if (retorno.data.token !== undefined) {
                        this.$root.setUserLogin(retorno.data)
                        this.$router.push({name: 'meusLivros'})
                    } else {
                        if (retorno.status !== 200 || retorno.status !== 201) {
                            this.titulo_erros = retorno.data.message;
                            if (retorno.data.errors !== undefined) {
                                var errors = retorno.data.errors;
                                for (var [key, value] of Object.entries(errors)) {
                                    for (let a = 0; a < value.length; a++) {
                                        this.errors.push(value[a]);
                                    }
                                }
                            }
                        }
                    }

                }


            }
        },
    }
</script>
