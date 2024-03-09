<script setup>
import { useAuthStore } from '@/Stores/Auth';
import { onMounted, reactive, ref, } from 'vue';
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Navigation from '@/components/Sections/Navigation.vue';
import axios from 'axios';

const authStore = useAuthStore();

let userId = ref();

const authToken = localStorage.getItem('authToken');

onMounted(async () => {
    await authStore.getUser();
    userId.value = authStore.authUser.id;
    getResume(userId.value);
});

const resume = ref([]);

const getResume = async (userId) => {
    // console.log(userId);
    const response = await axios.get(`http://127.0.0.1:8000/api/resume/${userId}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    resume.data = response.data.resume;
    console.log(resume.data);
}

</script>

<template>

    <Base>
    <template v-slot:header>
        <Header title="Resume" />
    </template>

    <template v-slot:navigation>
        <Navigation />
    </template>

    <template v-slot:main>
        <div class="max-w-4xl mx-auto text-black" v-if="resume">
            <div class="w-full max-w-sm rounded bg-white h-96 m-auto shadow flex flex-col">
                <div class="mx-8 shadow rounded border h-10 mt-4 flex p-1 relative items-center bg-gray-200">
                    <div class="w-full flex justify-center">
                        <button>Templates</button>
                    </div>
                    <div class="w-full flex justify-center">
                        <button>Sections</button>
                    </div>
                    <span
                        class="elSwitch bg-white shadow text-gray-800 flex items-center justify-center w-1/2 rounded h-8 transition-all top-[4px] absolute left-1 ">
                        Text
                    </span>
                </div>
            </div>
            <p v-text="resume.summary"></p>
        </div>
        <div class="grid grid-cols-12 max-w-2xl mx-auto" v-else>
            <RouterLink :to="{ path: 'resume/create' }">Create Resume</RouterLink>
        </div>
    </template>
    </Base>

</template>

<style lang="scss" scoped></style>