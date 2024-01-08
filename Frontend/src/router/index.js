import { createRouter, createWebHistory } from 'vue-router'
import vacancies from "@/views/Vacancies.vue";
import Vacancy from '@/views/Vacancy.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/vacancies',
      name: '/vacancies',
      component: vacancies
    },
    {
      path: '/vacancies/:id',
      name: 'vacancies',
      component: Vacancy
    }
  ]
})

export default router
