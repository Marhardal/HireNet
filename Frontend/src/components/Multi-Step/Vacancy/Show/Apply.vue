<script setup>
import { onMounted, shallowRef, shallowReactive } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';

const user = shallowRef({});

const userId = shallowRef(1);

const toast = useToast();

onMounted(async () => {
    getUser(userId.value);
});

const getUser = async (userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/users/${userId}`);
    user.value = response.data.user;
}

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
    user_id: userId.value,
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
    // console.log(formData);
    await axios.post("http://127.0.0.1:8000/api/apply", formData).then((response) => {
        // const message = response.data;
        toast.success("You have applied to a vacancy successfully.");
        router.push('/');
    }).catch((error) => {
        // errors.value = error?.response?.data?;
        toast.error("Encountered an error while applying.");
    });
}
</script>

<template>
    <FormKit type="form" submit-label="Apply Now" @submit="Apply" default="">
    <!-- <form action=""  enctype="multipart/form-data"> -->
        <FormKit type="text" v-model="user.first_name" label="First Name" disabled="true" />
        <FormKit type="text" v-model="user.surname" label="Surname" disabled="true" />
        <FormKit type="text" v-model="user.phone" label="Phone Number" disabled="true" />
        <FormKit type="text" v-model="user.email" label="Email" disabled="true" />
        <!-- <input type="file" v-model="form.document" id=""> -->
        <FormKit type="file" label="Resume" v-model="form.document" accept=".pdf,.doc,.docx"
            placeholder="Select your resume." validation="required" />
        <FormKit type="textarea" v-model="form.message" label="Message" validation="required"
            placeholder="Write your Cover Letter here or add any comments which you want the recruiters know." />
        <!-- <FormKit type="button" @click="Apply">Apply Now</FormKit> -->
    <!-- </form> -->
    </FormKit>
</template>

<style lang="scss" scoped></style>