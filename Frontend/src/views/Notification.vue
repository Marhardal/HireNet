<script setup>
import Header from "@/components/Sections/Header.vue";
import Base from "./Base.vue";
import Navigation from "@/components/Sections/Navigation.vue";
import { useAuthStore } from "@/Stores/Auth";
import { onMounted, reactive, ref } from "vue";
import axios from "axios";
import Notification from "@/components/Cards/Notification.vue";
import { BuildingOfficeIcon } from "@heroicons/vue/24/solid";
import { shallowRef } from "vue";

const Tabs = shallowRef([
    {label: 'All', component: All}
]) 

const authStore = useAuthStore();

const authToken = localStorage.getItem('authToken');

const notifications = reactive({});

onMounted(async () => {
    await authStore.getUser();
    // console.log(authStore.authUser);
    getNotifications()
});

const getNotifications = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/notifications', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    notifications.data = response.data;
    // console.log(notifications.data);
}
</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Notification" />
    </template>
    <template v-slot:navigation>
        <Navigation />
    </template>
    <template v-slot:main>
        <div class="flex justify-center bg-gradient-to-t h-full p-6 bg-no-repeat bg-center w-full">
            <div class="w-full md:w-1/2 lg:w-full" v-if="notifications">
                <div class="flex flex-col space-y-4" v-for="(notification, index) in notifications">
                    <Notification v-for="notify in notification" :value="notify" :key="index" />
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3" v-else>
                <div class="flex flex-col space-y-4">
                    You don't have any notifications at the moment.
                </div>
            </div>
        </div>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>