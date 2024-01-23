<script setup>
import Header from '@/components/Sections/Header.vue';
import { onMounted, shallowRef, shallowReactive } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import Button from '@/components/Forms/Button.vue';

const user = shallowRef({});

const userId = shallowRef(1);

onMounted(async () => {
    getUser(userId.value);
});

const getUser = async (userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/users/${userId}`);
    user.value = response.data.user;
    console.log(user.value);
}

const props = defineProps({
    show: {
        type: Object,
        required: true,
        default: {}
    }
});
</script>

<template>
    <form class="grid grid-cols-2 gap-x-4 mx-auto justify-center max-w-4xl">
        <div class="col-span-2" v-if="show.job">
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
            <Input v-model="user.first_name" placeholder="Enter your First Name." label="First Name"/>
        </div>
        <div class="col-span-2">
            <Textarea label="Message" placeholder="Enter any information you would like to let us know."/>
        </div>
        <div class="col-span-1 my-4"><Button value="Cancel"/></div>
        <div class="col-span-1 my-4"><Button value="Submit Application"/></div>
    </form>
</template>

<style lang="scss" scoped></style>