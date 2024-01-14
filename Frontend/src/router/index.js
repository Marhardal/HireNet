import { createRouter, createWebHistory } from 'vue-router'
import vacancies from "@/views/Vacancies/index.vue";
import Vacancy from '@/views/Vacancies/show.vue';
import create from "@/views/vacancies/Create.vue";
import settings from '@/views/Settings.vue';

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
      component: create,
    },
    {
      path: '/settings',
      name: 'Seeker Settings',
      component: settings,
    },
  ]
})

export default router
