<script setup>
import Header from '@/components/Sections/Header.vue';
import { onMounted, shallowRef, shallowReactive } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import Button from '@/components/Forms/Button.vue';
import File from '@/components/Forms/File.vue';

const user = shallowRef({});

const userId = shallowRef(1);

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
    console.log(form.document);
    axios.post("http://127.0.0.1:8000/api/apply", form).then((response) => {
        console.log(response.data);
        router.push('/');
    }).catch((error) => {
        errors.value = error.response.data.errors;
    });
}

const handleFileSelected = (selectedFile) => {
    console.log(selectedFile);
}
</script>

<template>
    <form @submit.prevent="Apply" class="grid grid-cols-2 gap-x-4 mx-auto justify-center max-w-4xl" enctype="multipart/form-data">
        <div class="col-span-2">
            <h2 class="mb-4 text-xl font-bold w-full">Applying for {{ show.job.name }} Role.</h2>
        </div>
        <div class="col-span-1">
            <Input v-model="user.first_name" placeholder="Enter your First Name." label="First Name"/>
        </div>
        <div class="col-span-1">
            <Input v-model="user.surname" placeholder="Enter yourSurname." label="Surname"/>
        </div>
        <div class="col-span-1">
            <Input v-model="user.email" placeholder="Enter your Email Address." label="Email Address"/>
        </div>
        <div class="col-span-1">
            <Input v-model="user.phone" placeholder="Enter your Phone Number." label="Phone Number"/>
        </div>
        <div class="col-span-2">
            <!-- <div class="my-4">
        <label for="block text-sm font-medium mb-2 text-black">Select your Resume.</label>
        <div class="">
            <label for="file-input" class="sr-only">Choose file</label>
            <input type="file" name="file-input" id="file-input"
                class="block w-full border border-gray-400 rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 file:bg-gray-200 file:border-0 file:me-4 file:py-3 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400" v-on:change="user.document">
            @input="$emit('update:modelValue', $event.target.value)"
        </div>
        <span class="text-rose-600" v-if="errors.document" v-for="error in errors.document">{{ error }}</span>
    </div> -->
            <File v-on:change="form.document" @fileSelected="handleFileSelected" label="Upload your Resume." :errors="errors.document" :accept="['.pdf', '.doc', '.docx']"/>
        </div>
        <div class="col-span-2">
            <Textarea label="Message" v-model="form.message" placeholder="Enter any information you would like to let us know." :errors="errors.message" />
        </div>
        <!-- <div class="col-span-1 my-4"><Button value="Cancel" @clicked="click[1]"/></div> -->
        <div class="col-span-1 my-4"><Button value="Submit Application" @clicked="Apply"/></div>
    </form>
</template>

<style lang="scss" scoped></style>