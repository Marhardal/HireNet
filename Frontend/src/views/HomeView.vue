<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from './Base.vue';
import Navigation from '@/components/Sections/Navigation.vue';
import Footer from '@/components/Sections/Footer.vue';
import { useAuthStore } from "../Stores/Auth";
import Pie from '@/components/Dashboard/pie.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { Icon } from '@iconify/vue';
import Seeker from '@/components/Dashboard/Seeker.vue';
import Recruiter from '@/components/Dashboard/Recruiter.vue';
import Admin from '@/components/Dashboard/Admin.vue';

const authStore = useAuthStore();

const authToken = localStorage.getItem('authToken');

const dashboard = ref([]);
const notifications = ref([]);

onMounted(async () => {
  await authStore.getUser();
  await getDashboard();
  console.log(authStore.authRole.name);
});
const getDashboard = async () => {
  const response = await axios.get(`http://127.0.0.1:8000/api/dashboard`, {
    headers: {
      Accept: 'application/json',
      Authorization: `Bearer ${authToken}`
    }
  });
  dashboard.value = response.data.dashboard;
  notifications.value = response.data.notifications;
  console.log(dashboard.value);
}
</script>

<template>
  <Base>
  <template v-slot:header>
    <Header title="Home" />
  </template>
  <template v-slot:navigation>
    <Navigation />
  </template>
  <template v-slot:main>
    <div class="" v-if="dashboard">
      <div class="grid grid-rows-3 grid-cols-2 gap-2" v-if="authStore.authRole && authStore.authRole.name == 'Seeker'">
        <Seeker :dashboard="dashboard" :notifications="notifications" />
      </div>
      <div class="grid grid-cols-2 gap-2" v-if="authStore.authRole && authStore.authRole.name == 'Recruiter'">
        <Recruiter :dashboard="dashboard" :notifications="notifications" />
      </div>
      <div class="grid grid-cols-2 gap-2" v-if="authStore.authRole && authStore.authRole.name == 'Admin'">
        <Admin :dashboard="dashboard" :notifications="notifications" />
      </div>
    </div>
    <div class="" v-else>Loading</div>
  </template>
  <template v-slot:other>
    <!-- <Footer /> -->
  </template>
  </Base>
</template>
