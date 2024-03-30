<template>
     <div class="w-full md:w-1/2 lg:w-full">
        <Applicant v-for="Applicant in Applicants" :applicant="Applicant" :postId="Applicant.pivot.post_id"/>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import Applicant from '@/components/Cards/Applicant.vue';

const authToken = localStorage.getItem('authToken');

const id = useRoute().params.id;

const Applicants = ref([]);

onMounted(async () => {
    getApplicants(id);
});

const getApplicants = async (id) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/shortlist/${id}/?search=0`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    Applicants.value = response.data.applicants;
    // console.log(Applicants.value);
}
</script>

<style lang="scss" scoped>

</style>