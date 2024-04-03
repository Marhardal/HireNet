<script setup>
import Button from "@/components/Forms/Button.vue";
import Input from "@/components/Forms/Input.vue";
import Header from "@/components/Sections/Header.vue";
import { reactive, ref } from "vue";
import Base from "../Base.vue";
import { useAuthStore } from "../../Stores/Auth";

const authStore = useAuthStore();

const values = reactive({});

const handleIconClick = (node, e) => {
    node.props.suffixIcon = node.props.suffixIcon === 'eye' ? 'eyeClosed' : 'eye'
    node.props.type = node.props.type === 'password' ? 'text' : 'password'
}
</script>

<template>
    <div class="flex flex-col max-w-2xl mt-20 mx-auto justify-center align-middle">
        <div class="col-span-12 mt-10">
            <FormKit type="form" submit-label="Sign-up" @submit="authStore.Register(values)">
                <div class="grid grid-cols-2 gap-2 mx-auto">
                    <div class="col-span-2">
                        <h2 class="text-xl font-bold">Welcome</h2>
                        <h3 class="text-base font-semibold">Please Fill in all field to continue</h3>
                    </div>
                    <div class="col-span-1">
                        <FormKit type="text" placeholder="Enter your First Name." v-model="values.first_name"
                            label="First Name" validation="required" />
                    </div>
                    <div class="col-span-1">
                        <FormKit type="text" label="Surname" placeholder="Enter your Surname." v-model="values.surname"
                            validation="required" />
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
                            placeholder="Enter your Password." validation="required" suffix-icon="eyeClosed"
                            @suffix-icon-click="handleIconClick" suffix-icon-class="hover:text-blue-500" />
                    </div>
                    <div class="col-span-1">
                        <FormKit type="password" name="password_confirm" label="Confirm Password"
                            placeholder="Please Confirm Password." validation="required|confirm"
                            validation-label="Password confirmation" />
                    </div>
                </div>
            </FormKit>
            <div class="text-base py-2">
                <h3>Create an <RouterLink :to="{ path: '/create/organisation' }">Organisation</RouterLink>.
                </h3>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>