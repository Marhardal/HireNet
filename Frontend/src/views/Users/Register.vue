<script setup>
import Button from "@/components/Forms/Button.vue";
import Input from "@/components/Forms/Input.vue";
import Header from "@/components/Sections/Header.vue";
import { reactive, ref } from "vue";
import axios from "axios";
import Base from "../Base.vue";

const values = reactive({
    'first_name': '',
    'surname': '',
    'dob': '',
    'email': '',
    'phone': '',
    'username': '',
    'password': '',
    // 'password_confirmation': '',
    'role_id': 1,
    'organisation_id': null
});

const errors = ref([]);

const newUser = async () => {
    // console.log(values.first_name);
    axios.post("http://127.0.0.1:8000/api/users", values).then((response) => {
        console.log(response.data);
        router.push('/');
    }).catch((error) => {
        errors.value = error.response.data.errors;
        console.log(values);
    });
}

</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Register" />
    </template>
    <template v-slot:other>
        <form @submit.prevent class="grid grid-cols-2 gap-x-4 mx-auto justify-center max-w-4xl">
            <div class="col-span-2">
                <h2 class="my-4 text-xl font-bold">Welcome</h2>
                <h2 class="text-md font-semibold">Please Fill in all Fields.</h2>
            </div>
            <div class="col-span-1">
                <Input label="First Name" placeholder="Enter your First Name." v-model="values.first_name"
                    :errors="errors.first_name" />
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
                <Input label="Email" placeholder="Enter your Email Address." type="email" v-model="values.email"
                    :errors="errors.email" />
            </div>
            <div class="col-span-1">
                <Input label="Phone Number" placeholder="Enter your Phone Number." v-model="values.phone" type="tel"
                    :errors="errors.phone" />
            </div>
            <div class="col-span-1">
                <Input label="Username" placeholder="Enter Username you will be Using." v-model="values.username"
                    :errors="errors.username" />
                <!-- <span class="text-red-500" v-if="errors" v-for="message in errors.username">{{ message }}</span> -->
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
                <Button value="Sign Up" @clicked="newUser" v-bind:inputValue="values" />
            </div>
        </form>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>