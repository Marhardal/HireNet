<template>
    <div class="" v-if="value">
        <RouterLink :to="{ path: '/vacancies/' + value.data.post_id}" @click="updateNotification">
            <div class="flex justify-between py-6 px-4 bg-white/30 rounded-md w-full">
                <div class="flex items-center space-x-4 bg-white rounded-full p-2">
                    <BuildingOfficeIcon class="h-12 w-12" />
                </div>
                <div class="flex flex-col text-center space-y-1" v-if="value.data">
                    <span class="font-bold">{{ value.data.title }}</span>
                    <span class="text-sm">{{ value.data.message }}</span>
                </div>
                <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm leading-5">
                    {{ moment(value.created_at).fromNow() }}
                </div>
            </div>
        </RouterLink>
    </div>
</template>

<script setup>
import moment from "moment";
import axios from "axios";
import { BuildingOfficeIcon } from "@heroicons/vue/24/solid";
import { ref } from "vue";

const read = async () => {
    // console.log(props.value.id);
}

const props = defineProps({
    value: {
        type: Object,
        required: true
    }
});

const authToken = localStorage.getItem('authToken');
const errors = ref([]);

const updateNotification = async () => {
    // console.log(authToken);
    await axios.put(`http://127.0.0.1:8000/api/notifications/${props.value.id}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        console.log(response.data);
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
    });
}
</script>

<style lang="scss" scoped></style>