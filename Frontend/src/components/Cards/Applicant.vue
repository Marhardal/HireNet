<template>
    <a @click="Applicant(attach)" class="" v-if="applicant">
        <div class="bg-white rounded-md w-1/2" >
            <div class="grid grid-cols-3 my-4 text-base text-black">
                <div class="col-span-1 mx-auto">
                    <img class="w-12 h-12 rounded-full object-cover" src="https://randomuser.me/api/portraits/men/1.jpg"
                        alt="Event image">
                </div>
                <div class="col-span-1 mx-auto my-auto">
                    <p>{{ applicant.first_name + ' ' + applicant.first_name }}</p>
                </div>
                <div class="col-span-1 mx-auto my-auto">
                    <Button :postId="postId" :userId="applicant.id" value="View Applicant"/>
                </div>
            </div>
        </div>
    </a>
</template>

<script setup>
import { shallowRef } from 'vue';
import Button from '../Forms/Button.vue';
import Applicant from '../Multi-Step/Vacancy/Show/Applicant.vue';
import ResumeIcon from '../icons/ResumeIcon.vue';

const attach = shallowRef([]);

const getApplicant = async ([postId, userId]) => {
    const authToken = localStorage.getItem('authToken');
    const response = await axios.get(`http://127.0.0.1:8000/api/vacancy/${postId}/applicant/${userId}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    attach.value = response.data.attach;
}

// const page = shallowRef(0);

//     const pages = shallowRef([
//         Applicants,
//         Applicants
//     ])

//     const nextPage = () => {
//         page++;
//     }

//     const previousPage = () => {
//         page--;
//     }

const props = defineProps({
    applicant: {
        type: Object,
        required: true,
    },
    postId: {
        type: String,
        required: true,
    },
    
})
</script>

<style lang="scss" scoped></style>