<script setup>
import { onMounted, shallowRef } from 'vue';
import axios from "axios";
import Input from '../Forms/Input.vue';
import Button from '../Forms/Button.vue';
import { useAuthStore } from "../../Stores/Auth";

const bookMark = shallowRef([]);

const authStore = useAuthStore();

const values = shallowRef([]);

// const values = shallowReactive({
// 'first_name': '',
// 'surname': '',
// 'dob': '',
// 'email': '',
// 'phone': '',
// 'username': '',
// 'password': '',
// // 'password_confirmation': '',
// 'role_id': 1,
// 'organisation_id': null
// });

const errors = shallowRef([]);

onMounted(async () => {
    await authStore.getToken();
});

</script>

<template>
    <form @submit.prevent class="grid grid-cols-2 gap-x-2 mx-auto justify-center my-6">
        <div class="col-span-2">
            <h2 class="mb-4 text-xl font-bold w-full">Account Settings</h2>
        </div>
        <div class="col-span-2 grid grid-cols-2 gap-x-2 border-y border-white">
            <div class="col-span-1">
                <!-- {{ values.first_name }} -->
                <Input label="First Name" placeholder="Enter your First Name." v-model="values.first_name"
                    :errors="errors.first_name" :modelValue="bookMark.first_name" />
                <!-- <span class="text-red-500" v-if="errors" v-for="message in errors.first_name">{{ message }}</span> -->
            </div>
            <div class="col-span-1">
                <Input label="Surname" placeholder="Enter your Surname." v-model="values.surname"
                    :errors="errors.surname" />
                <!-- <span class="text-red-500" v-if="errors" v-for="message in errors.surname">{{ message }}</span> -->
            </div>
            <div class="col-span-1">
                <Input label="Date of Birth" placeholder="Enter your Date of Birth." v-model="values.dob" type="date"
                    :errors="errors.dob" />
                <!-- <span class="text-red-500" v-if="errors" v-for="message in errors.dob">{{ message }}</span> -->
            </div>
            <div class="col-span-1">
                <Input label="Username" placeholder="Enter Username you will be Using." v-model="values.username"
                    :errors="errors.username" />
                <!-- <span class="text-red-500" v-if="errors" v-for="message in errors.username">{{ message }}</span> -->
            </div>
        </div>
        <div class="col-span-1">
            <Input label="Email" placeholder="Enter your Email Address." type="email" v-model="values.email"
                :errors="errors.email" />
        </div>
        <div class="col-span-1">
            <Input label="Phone Number" placeholder="Enter your Phone Number." v-model="values.phone" type="tel"
                :errors="errors.phone" />
        </div>
        <div class="col-span-1">
            <Input label="Password" placeholder="Enter Password you will be Using." v-model="values.password"
                type="password" :errors="errors.dob" />
            <!-- <span class="text-red-500" v-if="errors" v-for="message in errors.password">{{ message }}</span> -->
        </div>
        <div class="col-span-1">
            <!-- <Input label="Confirm Password" placeholder="Confirm Password." v-model="values.password_confirmation" type="password"/>
                    <span class="text-red-500" v-if="errors" v-for="message in errors.password_confirmation">{{ message }}</span> -->
        </div>
        <div class="col-span-2">
            <Button value="Sign Up" @clicked="" />
        </div>
    </form>
</template>

<style lang="scss" scoped></style>