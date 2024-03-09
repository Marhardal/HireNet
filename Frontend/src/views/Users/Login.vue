<template>
    <Base>
    <!-- <template v-slot:header>
        <Header title="Login" />
    </template> -->
    <template v-slot:other>
        <div class="max-w-md  max-h-52 mx-auto justify-center align-middle ">
            <div class="text-2xl font-bold py-2">
                <h1>Welcome Back</h1>
            </div>
            <div class="text-xl font-semibold py-2">
                <h2>Please fill in all fields.</h2>
            </div>
            <FormKit type="form" submit-label="Sign-in" @submit="authStore.Login(values)">
                <FormKit type="text" placeholder="Enter your Username." v-model="values.username" label="Username"
                    validation="required" />
                <FormKit type="password" label="Password" placeholder="Enter your Password."
                    v-model="values.password" validation="required" />
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
import { reactive } from 'vue';
import { useAuthStore } from "../../Stores/Auth";

const authStore = useAuthStore();

const values = reactive({
    'username': '',
    'password': ''
})

</script>

<style lang="scss" scoped></style>