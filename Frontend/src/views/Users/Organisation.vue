<template>
    <Base>
    <template v-slot:other>
        <div class="max-w-md  max-h-52 mx-auto justify-center align-middle ">
            <div class="text-2xl font-bold py-2">
                <h1>Welcome Back</h1>
            </div>
            <div class="text-xl font-semibold py-2">
                <h2>Please fill in all fields.</h2>
            </div>
            <FormKit type="form" submit-label="Create" @submit="createOrganisation">
                <FormKit type="text" placeholder="Enter Organisation Name." v-model="values.name" label="Organisation Name"
                    validation="required" />
                <FormKit type="text" label="Organisation Location" placeholder="Enter Organisation Location."
                    v-model="values.location" validation="required" />
                <FormKit type="textarea" label="Organisation About" placeholder="Enter Organisation About."
                    v-model="values.about" validation="required" />
            </FormKit>
            <div class="text-base py-2">
                <h3>Don't have an account.<RouterLink :to="{ path : 'sign-up'}">Create Account.</RouterLink></h3>
            </div>
            <div class="text-base py-2">
                <RouterLink to="">Reset Password.</RouterLink>
            </div>
        </div>
    </template>
    </Base>
</template>

<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import { reactive, ref } from 'vue';
import { useAuthStore } from "../../Stores/Auth";
import axios from 'axios';
import { useRoute } from 'vue-router';
import { useToast } from 'vue-toastification';

const router = useRoute();

const toast = useToast();

const errors = ref([]);

const authStore = useAuthStore();

const values = reactive({
    'name': '',
    'location': '',
    'about': ''
})

const createOrganisation = async () => {
    axios.post('http://127.0.0.1:8000/api/organisation', values).then((response) => {
        console.log(response.data.organisation.id);
        const organisation = response.data.organisation.id;
        localStorage.setItem('organisation_id', organisation)
        toast.success(response.data);
        router.push('/sign-up');
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error('Please make sure you have filled in all fields.')
    });
} 

</script>

<style lang="scss" scoped></style>