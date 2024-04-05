<template>
    <div>
        <div class="w-full md:w-1/2 lg:w-full" v-if="notifications">
            <div class="flex flex-col space-y-4" v-for="(notification, index) in notifications">
                <div class="" v-for="notify in notification">
                    <Notification v-if="notify.read_at ==! null" :value="notify" :key="index" />
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 lg:w-1/3" v-else>
            <div class="flex flex-col space-y-4">
                You don't have any notifications at the moment.
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import Notification from "@/components/Cards/Notification.vue";

const authToken = localStorage.getItem('authToken');

const notifications = reactive({});

onMounted(async () => {
    getNotifications();
})

const getNotifications = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/notifications', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    notifications.data = response.data;
    console.log(notifications.data);
}
</script>

<style lang="scss" scoped></style>