<script setup>
import { onMounted, shallowRef, shallowReactive } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { useAuthStore } from '@/Stores/Auth';

const user = shallowRef({});

const userId = shallowRef(1);

const toast = useToast();

const authStore = useAuthStore();

onMounted(async () => {
    authStore.getUser();
});

const props = defineProps({
    show: {
        type: Object,
        required: true,
        default: {}
    },
    click: {
        type: Array,
        required: true,
        default: []
    }
});

const form = shallowReactive({
    user_id: authStore.authUser.id,
    post_id: props.show.id,
    document: "",
    message: "",
});

const errors = shallowRef({});

const Apply = async () => {
    // console.log(form.document[0].name);
    const formData = new FormData();
    form.document.forEach(fileItem => {
        formData.append('document', fileItem.file);
    });
    formData.append('user_id', form.user_id);
    formData.append('post_id', form.post_id);
    formData.append('message', form.message);
    await axios.post("http://127.0.0.1:8000/api/applicants", formData, {
        headers: {
            Authorization: `Bearer ${authStore.authToken}`,
        }
    }).then((response) => {
        toast.success("You have applied to a vacancy successfully.");
        router.push('/');
    }).catch((error) => {
        toast.error("Encountered an error while applying.");
    });
}
</script>

<template  v-if="authStore.authRole">
    <div class="my-5">
        <FormKit type="form" submit-label="Apply Now" @submit="Apply" default="" v-if="authStore.authRole.name='Seeker'">
        <div class="grid grid-cols-2 gap-x-4 mx-auto justify-center max-w-4xl">
            <div class="col-span-2 mb-2">
                <h2 class="text-base font-semibold">Please fill in all fields to Apply.</h2>
            </div>
            <div class="col-span-1">
                <FormKit type="text" v-model="authStore.authUser.first_name" label="First Name" disabled="true" />
            </div>
            <div class="col-span-1">
                <FormKit type="text" v-model="authStore.authUser.surname" label="Surname" disabled="true" />
            </div>
            <div class="col-span-1">
                <FormKit type="text" v-model="authStore.authUser.phone" label="Phone Number" disabled="true" />
            </div>
            <div class="col-span">
                <FormKit type="text" v-model="authStore.authUser.email" label="Email" disabled="true" />
            </div>
            <FormKit type="hidden" v-model="authStore.authUser.id" />
            <div class="col-span-2">
                <FormKit type="file" label="Resume" v-model="form.document" accept=".pdf,.doc,.docx" placeholder="Select your resume." validation="required" />
            </div>
            <div class="col-span-2">
                <FormKit type="textarea" v-model="form.message" label="Message" validation="required"
                placeholder="Write your Cover Letter here or add any comments which you want the recruiters know." />
            </div>
        </div>
    </FormKit>
    </div>
</template>

<style lang="scss" scoped></style>