<template>
    <div class="flex flex-wrap gap-2 w-full rounded-md">
        <!-- v-if="bookMarks.value.length > 0" -->
        <Job v-for="bookMark in bookMarks" :job="bookMark.post" />
    </div>
</template>

<script setup>
import { onMounted, shallowRef } from 'vue';
import axios from "axios";
import Job from '../Cards/Job.vue';
import { useAuthStore } from '@/Stores/Auth';

const bookMarks = shallowRef([]);

const userId = shallowRef();

const authStore = useAuthStore();

onMounted(async () => {
    await authStore.getUser();
    userId.value = authStore.authUser.id;
    getBookMarks(userId.value);
    // console.log(bookMarks.post);
});

const getBookMarks = async ($userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/bookmark/`, {
        headers: {
            Authorization: `Bearer ${authStore.authToken}`,
        }
    });
    bookMarks.value = response.data.post;
    // console.log(bookMarks.value);
}
</script>

<style lang="scss" scoped></style>