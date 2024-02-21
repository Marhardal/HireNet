<template>
    <div class="flex flex-wrap gap-2 w-full rounded-md">
        <!-- v-if="applied.value.length > 0" -->
        <Job v-for="Apply in applied" :job="Apply" />
    </div>
</template>

<script setup>
import { onMounted, shallowRef } from 'vue';
import axios from "axios";
import Job from '../Cards/Job.vue';
import { useAuthStore } from '@/Stores/Auth';

const authStore = useAuthStore();

const applied = shallowRef();

let userId = shallowRef();

onMounted(async () => {
    authStore.getUser();
    userId.value = authStore.authUser.id;
    getAppliedPosts(userId.value);

});

const getAppliedPosts = async (userId) => {
    // console.log(userId);
    const response = await axios.get(`http://127.0.0.1:8000/api/applied/${userId}`, {
        headers: {
            Authorization: `Bearer ${authStore.authToken}`,
        }
    });
    applied.value = response.data.posts;
    console.log(applied.value)
}
</script>

<style lang="scss" scoped></style>