<template>
    <div>
        <div class="w-full md:w-1/2 lg:w-full" v-if="notifications">
            <div class="grid grid-cols-2 my-4">
                <div class="cols-span-1 ">
                    <div class="w-1/2">
                        <Button value="Mark all as Read" @clicked="updateAll"/>
                    </div>
                </div>
                <div class="cols-span-1 flex justify-end">
                    <div class="w-1/2">
                        <Button value="Delete all" @clicked="DeleteAll"/>
                    </div>
                </div>
            </div>
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

<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import Notification from "@/components/Cards/Notification.vue";
import Button from "@/components/Forms/Button.vue";
import { useToast } from 'vue-toastification';

const authToken = localStorage.getItem('authToken');

const toast = useToast();

const notifications = reactive({});

const errors = ref([]);

const updateAll = async () => {
    // console.log(authToken);
    await axios.put(`http://127.0.0.1:8000/api/notifications/1`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        console.log(response.data);
        toast.success("Marked all as read Successfully.");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error("Failed to Marked all as read!");
    });
}

const DeleteAll = async () => {
    await axios.delete(`http://127.0.0.1:8000/api/notifications/1`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success("All Notifications Deleted.");
        // router.push('notifications')
    }).catch(error => {
        toast.error("Failed to delete a notification.");
    });
}

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