<template>
    <div class="col d-flex justify-content-center mt-5">
        <aside class="col-sm-6">
            <!-- <p>Novo cadastro</p> -->
            <div class="card">
                <article class="card-body">
                    <router-link :to="{ name: 'login' }" class="float-right btn btn-outline-primary">Login</router-link>
                    <h4 class="card-title mb-4 mt-1">Novo cadastro</h4>
                    <form id="cadastro" @submit="cadastrar" action="javascript:void(0)" method="post">
                        <p v-if="errors.length || titulo_erros" class="alert alert-danger">
                            <b v-text="titulo_erros"></b>
                            <ul>
                            <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                            </ul>
                        </p>
                        <div class="form-group">
                            <label>Seu nome</label>
                            <input class="form-control" placeholder="Nome" type="text"  id="name" name="name" v-model="dados.name">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Seu email</label>
                            <input class="form-control" placeholder="Email" type="email"  id="email" name="email" v-model="dados.email">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Senha</label>
                            <input class="form-control" placeholder="" type="password" name="password" id="password" v-model="dados.password">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <label>Confirmar Senha</label>
                            <input class="form-control" placeholder="" type="password" name="password_confirmation" id="password_confirmation" v-model="dados.password_confirmation">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" @click="cadastrar"> Cadastrar </button>
                        </div>
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
        },
        data() {
            return {
                titulo_erros: null,//'Por favor, corrija o(s) seguinte(s) erro(s):',
                errors: [],
                dados: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                }
            }
        },
        methods: {
            cadastrar: async function(e) {
                e.preventDefault();
                this.errors = [];
                this.titulo_erros = null;

                if (!this.dados.name) {
                    this.errors.push('Nome é obrigatório.');
                }

                if (!this.dados.email) {
                    this.errors.push('O email é obrigatório.');
                } else if(!this.$root.validaEmail(this.dados.email)) {
                    this.errors.push('Utilize um e-mail válido.');
                }

                if (!this.dados.password) {
                    this.errors.push('A senha é obrigatório.');
                }
                if (!this.dados.password_confirmation) {
                    this.errors.push('Confirmar Senha é obrigatório.');
                }
                if (this.dados.password && this.dados.password_confirmation) {
                    if (this.dados.password != this.dados.password_confirmation) {
                        this.errors.push('Confirme a senha corretamente.');
                    }
                }
                if (this.errors.length > 0) {
                    this.titulo_erros = 'Por favor, corrija o(s) seguinte(s) erro(s):';
                }

                if (!this.errors.length) {
                    let retorno = await this.$root.cadastrar(this.dados);
                    // console.log(retorno, ' ;;retorno')
                    if (retorno.data.token !== undefined) {
                        this.$root.setUserLogin(retorno.data)
                        this.$router.push({name: 'livros'})
                        // console.log('cadastro realizado')

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
