<template>
    <div class="" v-if="applicant">
        <router-link :to="{ path: 'shortlist/applicant/' + applicant.id }">
            <div class="bg-blue-200 rounded-md w-full">
                <div class="grid grid-cols-3 my-4 text-base text-black py-2">
                    <div class="col-span-1 mx-auto">
                        <UserCircleIcon class="w-12 h-12 fill-black my-2" />
                    </div>
                    <div class="col-span-1 mx-auto my-auto text-center">
                        <p>{{ applicant.first_name + ' ' + applicant.surname }}</p>
                        <p v-if="applicant.pivot">Application received {{ moment(applicant.pivot.created_at).fromNow() }}.</p>
                    </div>
                    <div class="col-span-1 mx-auto my-auto text-center">
                        <ResumeIcon class="fill-black"/>
                    </div>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script setup>
import { shallowRef } from 'vue';
import Button from '../Forms/Button.vue';
import Applicant from '../Multi-Step/Vacancy/Show/Applicant.vue';
import ResumeIcon from '../icons/ResumeIcon.vue';
import { onMounted } from 'vue';
import { UserCircleIcon } from "@heroicons/vue/24/solid";
import moment from "moment";


const attach = shallowRef([]);

onMounted(async => {
    // if (props.applicant.pivot) {
    //     console.log(props.applicant.pivot.post_id);
    // }
});

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

const props = defineProps({
    applicant: {
        type: Object,
        required: true,
    },
    postId: {
        type: [String, Number],
        required: true,
    },

})
</script>

<style lang="scss" scoped></style>