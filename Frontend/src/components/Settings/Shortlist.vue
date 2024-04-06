<template>
    <div class="flex flex-wrap gap-2 w-full rounded-md max-h-fit" v-if="shortlists.length > 0">
        <!-- v-if="applied.value.length > 0" -->
        <Job v-for="shortlist in shortlists" :job="shortlist" />
    </div>
    <div class="flex flex-wrap gap-2 w-full rounded-md" v-else>
        <div class="">
            <p>You haven't applied for any jobs.</p>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from "axios";
import { useAuthStore } from '@/Stores/Auth';
import Job from '../Cards/Job.vue';

const authStore = useAuthStore();

const shortlists = ref([]);

const userId = ref();

const authToken = localStorage.getItem('authToken');

onMounted(async () => {
    await authStore.getUser();
    getShortlist();
});

const getShortlist = async () => {
    const response = await axios.get(`http://127.0.0.1:8000/api/shortlist/`, {
        headers: {
            Authorization: `Bearer ${authToken}`,
        }
    });
    shortlists.value = response.data.shortlist;
}
</script>

<style lang="scss" scoped></style>