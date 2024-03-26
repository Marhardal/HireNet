<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Applicant from '@/components/Cards/Applicant.vue';
import { shallowRef } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';

const Applicants = shallowRef([]);

const id = useRoute().params.id;

onMounted(async => {
    getApplicants(id)
})

const authToken = localStorage.getItem('authToken');

const getApplicants = async (id) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/shortlist/${id}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    Applicants.value = response.data.applicants;
    console.log(Applicants.value);
}

174114
</script>
<template>
    <Base>
        <template v-slot:header>
            <Header title="Shortlisted Applicants"/>
        </template>
        <template v-slot:other>
            <div class="flex justify-center bg-gradient-to-t h-full bg-no-repeat bg-center w-full mx-auto">
                <div class="w-full md:w-1/2 lg:w-full">
                    <Applicant v-for="Applicant in Applicants" :applicant="Applicant" :postId="Applicant.pivot.post_id"/>
                </div>
            </div>
        </template>
    </Base>
</template>


<style lang="scss" scoped>

</style>