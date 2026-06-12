import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import CadastroView from '@/views/CadastroView.vue'
import LoginView from '@/views/LoginView.vue'
import VagasView from '@/views/VagasView.vue'
import PaginaPrincipalView from '@/views/PaginaPrincipalView.vue'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/cadastro',
      name: 'cadastro',
      component: CadastroView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/vagas',
      name: 'vagas',
      component: VagasView,
    },
    {
      path: '/home',
      name: 'homeprincipal',
      component: PaginaPrincipalView,
    }
  ],
})

export default router
