import VueRouter from 'vue-router'

// Vue.use(VueRouter)

import LoginPage from './pages/LoginPage';
import ProfilePage from './pages/ProfilePage';
import CadastroPage from './pages/CadastroPage';
import LivrosPage from './pages/LivrosPage';
import MeusLivrosPage from './pages/MeusLivrosPage';
import ForgotPage from './pages/ForgotPage';

export default new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginPage
        },
        {
            path: '/livros',
            name: 'livros',
            component: LivrosPage,
            meta: { requiresLogin: true }
        },
        {
            path: '/meus-livros',
            name: 'meusLivros',
            component: MeusLivrosPage,
            meta: { requiresLogin: true }
        },
        {
            path: '/profile',
            name: 'profile',
            component: ProfilePage,
            meta: { requiresLogin: true }
        },
        {
            path: '/cadastrar',
            name: 'cadastrar',
            component: CadastroPage
        },
        {
            path: '/esqueci-minha-senha',
            name: 'forgot',
            component: ForgotPage
        },
    ],
});
