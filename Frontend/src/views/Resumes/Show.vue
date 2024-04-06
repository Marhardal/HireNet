<script setup>
import { useAuthStore } from '@/Stores/Auth';
import { onMounted, reactive, ref, } from 'vue';
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Navigation from '@/components/Sections/Navigation.vue';
import axios from 'axios';
import one from '@/components/Templates/one.vue';
import { AcademicCapIcon, Bars3BottomLeftIcon, Bars3Icon, BriefcaseIcon, LightBulbIcon, UserGroupIcon, ArrowDownIcon, EnvelopeIcon, PrinterIcon, TrashIcon } from "@heroicons/vue/24/solid";

const authStore = useAuthStore();

let userId = ref();

const authToken = localStorage.getItem('authToken');

onMounted(async () => {
    await authStore.getUser();
    userId.value = authStore.authUser.id;
    getResume(userId.value);
});

const resume = ref({});

const getResume = async (userId) => {
    // console.log(userId);
    const response = await axios.get(`http://127.0.0.1:8000/api/resume/${userId}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    resume.value = response.data.resume;
    console.log(resume.value);
}

const url = `http://127.0.0.1:8000/api/view/resume/8`;

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
        <div class="grid grid-cols-12 gap-2 max-h-fit" v-if="resume">
            <div class="col-span-4">
                <div class="max-w-sm rounded bg-white mx-auto shadow flex flex-col p-2 my-3">
                    <div class="w-full rounded flex relative">
                        <h3 class="text-base font-semibold text-black text-center mx-auto">My Curriculum Vitae</h3>
                    </div>
                    <div class="w-full h-full grid grid-cols-2 gap-2 my-4">
                        <div class="col-span-1">

                        </div>
                        <div class="col-span-1">
                            <div class="grid grid-cols-3 space-y-4 px-4 mx-auto w-full">
                                <div class="col-span-3">
                                    <h5 class="text-base text-center">Wanna Pocket your CV?</h5>
                                </div>
                                <div class="col-span-1 mx-auto"><ArrowDownIcon class="w-5 h-5 fill-black "/></div>
                                <div class="col-span-1 mx-auto"><EnvelopeIcon  class="w-5 h-5 fill-black "/></div>
                                <div class="col-span-1 mx-auto"><PrinterIcon class="w-5 h-5 fill-black "/></div>
                                <div class="col-span-3">
                                    <h5 class="text-base text-center">Wanna Delete your CV?</h5>
                                </div>
                                <div class="col-span-3 mx-auto"><TrashIcon class="w-5 h-5 fill-black"/></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-sm rounded bg-white h-96 mx-auto shadow flex flex-col p-2 my-3">
                    <div class="w-full shadow rounded border h-10 flex relative bg-gray-200">
                        <div
                            class="w-full elSwitch bg-white shadow text-gray-800 items-center rounded transition-all py-2 flex justify-center">
                            <button>Templates</button>
                        </div>
                        <div class="w-full flex justify-center">
                            <button>Sections</button>
                        </div>
                        <!-- <span
                            class="elSwitch bg-white shadow text-gray-800 flex items-center justify-center w-1/2 rounded h-8 transition-all top-[4px] absolute left-1 ">
                            Templates
                        </span> -->
                    </div>
                    <div class="w-full h-full grid grid-cols-2 gap-2 my-4">
                        <div class="col-span-1">
                            <Bars3BottomLeftIcon class="fill-black h-12 w-12 mx-auto text-center" />
                            <h3 class="mx-auto text-center">Professional Summary</h3>
                        </div>
                        <div class="col-span-1 mx-auto text-center">
                            <AcademicCapIcon class="fill-black h-12 w-12 mx-auto text-center" />
                            <h3>Education</h3>
                        </div>
                        <div class="col-span-1 mx-auto text-center">
                            <BriefcaseIcon class="fill-black h-12 w-12 mx-auto text-center" />
                            <h3>Work History</h3>
                        </div>
                        <div class="col-span-1 mx-auto text-center">
                            <LightBulbIcon class="fill-black h-12 w-12" />
                            <h3>Skills</h3>
                        </div>
                        <div class="col-span-1 mx-auto text-center">
                            <UserGroupIcon class="fill-black h-12 w-12" />
                            <h3>Referrals</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-8">
                <iframe :src="url" frameborder="0"
                    class="w-full h-full bg-white my-2 mx-2 py-2"></iframe>
                <!-- <one :resume="resume" /> -->
            </div>
            <div class="col-span-12">   
                
            </div>
        </div>
        <div class="grid grid-cols-12 gap-2 max-h-fit w-full" v-else>
            <div class="justify-center align-middle text-center">
                <RouterLink :to="{path: '/resume/create'}">Create Resume</RouterLink>
            </div>
        </div>
    </template>
    </Base>

</template>

<style lang="scss" scoped></style>