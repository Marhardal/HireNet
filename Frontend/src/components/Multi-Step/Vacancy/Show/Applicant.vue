<script setup>
import { onMounted, shallowRef } from 'vue';
import { useRoute } from 'vue-router';
import axios from "axios";
// import { VuePDF, usePDF } from '@tato30/vue-pdf'

const postId = useRoute().params.postId;

const userId = useRoute().params.userId;

const applicant = shallowRef({});

const attach = shallowRef({});

const post = shallowRef({});

const view = shallowRef();

const props = defineProps({
    postId: {
        type: String,
        required: true, 
    },
    userId: {
        type: String,
        required: true, 
    }
});

onMounted(async () => {
    getApplicant([postId, userId]),
    viewPDF([postId, userId])
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

const viewPDF = async (postId, userId) => {
    // console.log(attach.id);
    // const response = await axios.get(`http://127.0.0.1:8000/api/vacancy/${postId}/applicant/${userId}`, {
    //     headers: {
    //         Accept: 'application/json',
    //         Authorization: `Bearer ${authToken}`
    //     }
    // }, {
    //     responseType: 'arraybuffer'
    // });

    // const blob = new Blob([response.data], {
    //     type: 'application/pdf'
    // });

    // const url = window.URL.createObjectURL(blob);

    // view = url;
}

// const { pdf } = usePDF('./Resume.pdf')

// const pdf = 'Resume.pdf'
</script>

<template>
        <div class="w-full my-4 text-base text-black" v-if="attach">
            <h3 class="text-xl font-semibold">Cover Letter</h3>
            <p>{{ attach.message }}</p>
            <!-- <VuePDF :pdf="pdf" /> -->
            <object data="../../../../../public/Resume.pdf" type="application/pdf" width="100%" height="100%"></object>
        </div>
</template>

<style lang="scss" scoped></style>