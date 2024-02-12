<script setup>
import Header from '@/components/Sections/Header.vue';
import { onMounted, ref, reactive } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import Button from '@/components/Forms/Button.vue';
import File from '@/components/Forms/File.vue';
import Base from '@/views/Base.vue';

const user = ref({});

const userId = ref(1);
const id = ref();
const show = ref({});

onMounted(async () => {
    const id = useRoute().params.id;
    getUser(userId.value);
    showVacancy(id);
    
});

const getUser = async (userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/users/${userId}`);
    user.value = response.data.user;
}

const showVacancy = async (id) => {
    let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/${id}`);
    show.value = response.data.post;
    console.log(show.value);
}

const form = reactive({
    user_id: userId.value,
    post_id: id,
    document: "",
    message: "",
});

const errors = ref({});

const Apply = async () => {
    // console.log(form.document);
    axios.post("http://127.0.0.1:8000/api/apply", form).then((response) => {
        const message = response.data;
        router.push('/');
    }).catch((error) => {
        errors.value = error.response.data.errors;
    });
}
</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Apply for a Job" />
    </template>
    <template v-slot:other>
        <div class="text-semibold text-md" v-if="show.job">
            <h3>Applying for a {{ show.job.name }} role.</h3>
        </div>
        <FormKit type="form" submit-label="Apply Now" @submit="Apply">
            <FormKit type="text" v-model="user.first_name" label="First Name" disabled="true" />
            <FormKit type="text" v-model="user.surname" label="Surname" disabled="true" />
            <FormKit type="text" v-model="user.phone" label="Phone Number" disabled="true" />
            <FormKit type="text" v-model="user.email" label="Email" disabled="true" />
            <FormKit type="file" label="Resume" accept=".pdf,.doc,.docx" placeholder="Select your resume." validation="required"/>
            <FormKit type="textarea" v-model="form.message" label="Message" validation="required"
                placeholder="Write your Cover Letter here or add any comments which you want the recruiters know." />
        </FormKit>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>