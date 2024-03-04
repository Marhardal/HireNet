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
    <FormKit type="form" submit-label="Sign-up" @submit="authStore.Register(values)" v-if="authStore.authUser">
        <div class="grid grid-cols-2 gap-x-4 mx-auto justify-center max-w-4xl">
            <div class="col-span-1">
                <FormKit type="text" placeholder="Enter your First Name." v-model="values.first_name" label="First Name"
                    validation="required" :value="authStore.authUser.first_name" />
            </div>
            <div class="col-span-1">
                <FormKit type="text" label="Surname" placeholder="Enter your Surname." v-model="values.surname"
                    validation="required" :value="authStore.authUser.surname" />
            </div>
            <div class="col-span-1">
                <FormKit type="tel" label="Phone Number" validation="required" v-model="values.phone"
                    placeholder="Enter your Phone Number." :value="authStore.authUser.phone" />
            </div>
            <div class="col-span-1">
                <FormKit type="text" label="Username" placeholder="Enter your Username." v-model="values.username"
                    validation="required" :value="authStore.authUser.username" />
            </div>
            <div class="col-span-1">
                <FormKit type="email" label="Email Address" validation="required|email"
                    placeholder="Enter your Email Address." v-model="values.email" :value="authStore.authUser.email" />
            </div>
            <div class="col-span-1">
                <FormKit type="date" label="Date of Birth" validation="required|date"
                    placeholder="Enter your Date of Birth." v-model="values.dob" :value="authStore.authUser.dob" />
            </div>
            <div class="col-span-1">
                <FormKit type="password" name="password" v-model="values.password" label="Password"
                    placeholder="Enter your Password." validation="required" :value="authStore.authUser.password" />
            </div>
            <div class="col-span-1">
                <FormKit type="password" name="password_confirm" label="Confirm Password"
                    placeholder="Please Confirm Password." validation="required|confirm"
                    validation-label="Password confirmation" />
            </div>
        </div>
    </FormKit>
</template>

<style lang="scss" scoped></style>