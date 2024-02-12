import { createRouter, createWebHistory } from 'vue-router'
import vacancies from "@/views/Vacancies/index.vue";
import Vacancy from '@/views/Vacancies/show.vue';
import settings from '@/views/Settings.vue';
import LoginVue from '@/views/Users/Login.vue';
import registerVue from '@/views/Users/Register.vue';
import FirstVue from '@/views/Vacancies/Create/First.vue';
import SecondVue from '@/views/Vacancies/Create/Second.vue';
import ThirdVue from '@/views/Vacancies/Create/Third.vue';
import HomeViewVue from '@/views/HomeView.vue';
import ApplyVue from '@/views/Apply.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeViewVue
    },
    {
      path: '/vacancies',
      name: 'Vacancy index',
      component: vacancies
    },
    {
      path: '/vacancies/:id',
      name: 'Vacancy Show',
      component: Vacancy
    },
    {
      path: '/vacancy/create',
      name: 'Vacancy Create',
      component: FirstVue
    },
    {
      path: '/vacancy/skills/create',
      name: 'Vacancy Skills Create',
      component: SecondVue
    },
    {
      path: '/vacancy/duties/create',
      name: 'Vacancy duties Create',
      component: ThirdVue
    },
    {
      path: '/settings',
      name: 'Seeker Settings',
      component: settings,
    },
    {
      path: '/sign-up',
      name: 'User Register',
      component: registerVue
    },
    {
      path: '/sign-in',
      name: 'User Login',
      component: LoginVue,
    },
    {
      path: '/apply/:id',
      name: 'Vacancy Apply',
      component: ApplyVue,
    },
    
  ]
})

export default router
