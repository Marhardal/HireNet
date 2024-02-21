<script setup>
import Applicant from '@/components/Cards/Applicant.vue';
import axios from "axios";
import { shallowRef, onMounted } from 'vue';
import { useRoute } from 'vue-router';

    const applicants = shallowRef([]);

    const id = useRoute().params.id;

    onMounted( async () => {
        console.log(id);
        getApplicants(id)
    });

    const getApplicants = async (id) => {
        const authToken = localStorage.getItem('authToken');
        const response = await axios.get(`http://127.0.0.1:8000/api/vacancies/${id}`, {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${authToken}`
            }
        });
        applicants.value = response.data.applicants;
    }
</script>
<template>
    <div class="" v-if="applicants.length > 0">
        {{ id.value }}
        <Applicant v-for="(applicant, index) in applicants" :key="index" :applicant="applicant" :postId="id"/>
    </div>
</template>

<style lang="scss" scoped>

</style>