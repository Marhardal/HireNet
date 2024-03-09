<script setup>
import Button from "@/components/Forms/Button.vue";
import Input from "@/components/Forms/Input.vue";
import Header from "@/components/Sections/Header.vue";
import { reactive, ref } from "vue";
import Base from "../Base.vue";
import { useAuthStore } from "../../Stores/Auth";

const authStore = useAuthStore();

const values = reactive({
    'first_name': '',
    'surname': '',
    'dob': '',
    'email': '',
    'phone': '',
    'username': '',
    'password': '',
    'role_id': 1,
    'organisation_id': null
});

const handleIconClick = (node, e) => {
  node.props.suffixIcon = node.props.suffixIcon === 'eye' ? 'eyeClosed' : 'eye'
  node.props.type = node.props.type === 'password' ? 'text' : 'password'
}
</script>

<template>
    <Base>
    <!-- <template v-slot:header>
        <Header title="Register" />
    </template> -->

    <template v-slot:other>
        <div class="grid grid-col-12 max-w-2xl max-h-full mx-auto items-center">
            <div class="col-span-12">
                <FormKit type="form" submit-label="Sign-up" @submit="authStore.Register(values)">
                    <div class="grid grid-cols-2 gap-x-4 mx-auto">
                        <div class="col-span-1">
                            <FormKit type="text" placeholder="Enter your First Name." v-model="values.first_name"
                                label="First Name" validation="required" />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="text" label="Surname" placeholder="Enter your Surname."
                                v-model="values.surname" validation="required" />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="tel" label="Phone Number" validation="required" v-model="values.phone"
                                placeholder="Enter your Phone Number." />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="text" label="Username" placeholder="Enter your Username."
                                v-model="values.username" validation="required" />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="email" label="Email Address" validation="required|email"
                                placeholder="Enter your Email Address." v-model="values.email" />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="date" label="Date of Birth" validation="required|date"
                                placeholder="Enter your Date of Birth." v-model="values.dob" />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="password" name="password" v-model="values.password" label="Password"
                                placeholder="Enter your Password." validation="required"
                                suffix-icon="eyeClosed" @suffix-icon-click="handleIconClick"
                                suffix-icon-class="hover:text-blue-500" />
                        </div>
                        <div class="col-span-1">
                            <FormKit type="password" name="password_confirm" label="Confirm Password"
                                placeholder="Please Confirm Password." validation="required|confirm"
                                validation-label="Password confirmation" />
                        </div>
                    </div>
                </FormKit>
            </div>
        </div>
        <!-- <form @submit.prevent="authStore.Register(values)" class="grid grid-cols-2 gap-x-4 mx-auto justify-center max-w-4xl">
            <div class="col-span-2">
                <h2 class="my-4 text-xl font-bold">Welcome</h2>
                <h2 class="text-md font-semibold">Please Fill in all Fields.</h2>
            </div>
            <div class="col-span-1">
                <FormKit name="values" type="text" />
                <Input label="First Name" placeholder="Enter your First Name." v-model="first_name"
                    :errors="errors.first_name" />
            </div>
            <div class="col-span-1">
                <Input label="Surname" placeholder="Enter your Surname." v-model="surname"
                    :errors="errors.surname" />
            </div>
            <div class="col-span-1">
                <Input label="Date of Birth" placeholder="Enter your Date of Birth." v-model="dob" type="date"
                    :errors="errors.dob" />
            </div>
            <div class="col-span-1">
                <Input label="Email" placeholder="Enter your Email Address." type="email" v-model="email"
                    :errors="errors.email" />
            </div>
            <div class="col-span-1">
                <Input label="Phone Number" placeholder="Enter your Phone Number." v-model="phone" type="tel"
                    :errors="errors.phone" />
            </div>
            <div class="col-span-1">
                <Input label="Username" placeholder="Enter Username you will be Using." v-model="username"
                    :errors="errors.username" />
            </div>
            <div class="col-span-1">
                <Input label="Password" placeholder="Enter Password you will be Using." v-model="values.password"
                    type="password" :errors="errors.dob" />
            </div>
            <div class="col-span-2">
                <Button value="Sign Up" />
            </div>
        </form> -->
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>