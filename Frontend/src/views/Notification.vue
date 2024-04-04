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
import All from "@/components/Notifications/All.vue";
import Unread from "@/components/Notifications/Unread.vue";
import Archived from "@/components/Notifications/Archived.vue";
import TabButton from '@/components/Sections/TabButton.vue';


const Tabs = shallowRef([
    {label: 'All', component: All},
    {label: 'Unread', component: Unread},
    {label: 'Archive', component: Archived},
]);

const currentTab = shallowRef(0);

const TabChange = (index)=>{
    currentTab.value = index;
}

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
        <div class="flex justify-center bg-gradient-to-t max-h-3/4 p-6 bg-no-repeat">
            <div class="w-full h-full">
                <div class="border-b border-white dark:border-gray-700 mx-4">
                    <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                        <!-- <TabButton -->
                        <TabButton v-for="(tab, index) in Tabs" :name="tab.label" @click="TabChange(index)" />
                    </nav>
                </div>

                <div class="mt-3 mx-4">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <component :is="Tabs[currentTab].component"></component>
                    </div>
                </div>
            </div>
            <!-- <div class="w-full md:w-1/2 lg:w-full" v-if="notifications">
                <div class="flex flex-col space-y-4" v-for="(notification, index) in notifications">
                    <Notification v-for="notify in notification" :value="notify" :key="index" />
                </div>
            </div>
            <div class="w-full md:w-1/2 lg:w-1/3" v-else>
                <div class="flex flex-col space-y-4">
                    You don't have any notifications at the moment.
                </div>
            </div> -->
        </div>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>