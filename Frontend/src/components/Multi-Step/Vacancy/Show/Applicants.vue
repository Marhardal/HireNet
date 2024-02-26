<script setup>
import Applicant from '@/components/Cards/Applicant.vue';
import Button from '@/components/Forms/Button.vue';
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

    defineProps({
        // click: {
        //     type: Array,
        //     required: true,
        //     default: []
        // }
    })
</script>
<template>
    <div class="bg-blue-200 flex flex-wrap gap-2 w-full rounded-md" v-if="applicants.length > 0">
        <Applicant v-for="(applicant, index) in applicants" :key="index" :applicant="applicant" :postId="id"/>
    </div>
</template>

<style lang="scss" scoped>

</style>