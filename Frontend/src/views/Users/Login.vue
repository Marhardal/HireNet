<template>
    <Base>
        <template v-slot:header><Header title="Login"/></template>
        <template v-slot:other>
            <form @submit.prevent action="" class="mx-auto max-w-2xl">
                <h2 class="my-4 text-xl font-bold">Welcome Back</h2>
                <h2 class="my-4 text-md font-semibold">Please Fill in all Fields.</h2>
                <Input placeholder="Enter Your Username or Email" label="Username or Email" v-model="values.username" :errors="errors.username"/>
                <Input placeholder="Enter Your Password" label="Password" type="password" v-model="values.password" :errors="errors.password"/>
                <Button value="Sign-in" @clicked="Login"/>
            </form>
        </template>
    </Base>
</template>

<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Input from '@/components/Forms/Input.vue';
import Button from '@/components/Forms/Button.vue';
import axios from 'axios';
import { reactive, ref } from 'vue';

const values = reactive({
    'username': '',
    'password': ''
})

const errors = ref([]);

const Login = async () => {
    await axios.post(`http://127.0.0.1:8000/api/sign-in`, values).then((response) => {
        console.log(response.data);
    }).catch((error)=>{
        errors.value = error.response.data.errors;
    });
}


</script>

<style lang="scss" scoped>

</style>