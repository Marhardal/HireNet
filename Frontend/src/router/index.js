import { createRouter, createWebHistory } from 'vue-router'
import vacancies from "@/views/Vacancies/index.vue";
import Vacancy from '@/views/Vacancies/show.vue';
import settings from '@/views/Settings.vue';
import LoginVue from '@/views/Users/Login.vue';
import registerVue from '@/views/Users/Register.vue';
import createVue from '@/views/Vacancies/Create.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
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
      path: '/create',
      name: 'Vacancy Create',
      component: createVue
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

  ]
})

export default router
