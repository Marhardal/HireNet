<script setup>
import axios from 'axios';
import { onMounted, reactive, shallowRef } from 'vue';
import { useRoute } from 'vue-router';
import Base from '../Base.vue';
import Show from '@/components/Multi-Step/Vacancy/Show/Show.vue';
import Apply from '@/components/Multi-Step/Vacancy/Show/Apply.vue';
import Applicants from '@/components/Multi-Step/Vacancy/Show/Applicants.vue';
import { useAuthStore } from '@/Stores/Auth';
import companyIcon from "@/components/icons/Company.vue";
import locationIcon from "@/components/icons/Location.vue";
import contractIcon from "@/components/icons/Contract.vue";
import backIcon from "@/components/icons/Back.vue";
import Button from '@/components/Forms/Button.vue';
import { Step } from '@tiptap/pm/transform';

const step = shallowRef(0);
const show = shallowRef({});
const checks = shallowRef();
const user_id = shallowRef(1);

const vid = reactive({
    'post_id': '',
    'user_id': 1
});

const authStore = useAuthStore();

let errors = shallowRef([]);

onMounted(async => {
    authStore.getUser();
    const id = useRoute().params.id;
    showVacancy(id);
    bookMarkCheck(user_id.value);
    vid.post_id = id;
});

const steps = shallowRef([
    Applicants,
    Show,
    Apply,
])

const showVacancy = async (id) => {
    const authToken = localStorage.getItem('authToken');
    let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/${id}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    show.value = response.data.post;
}

const nextPage = () => {
    step.value++;
}

const previousPage = () => {
    step.value--;
}

const bookMarkCheck = async (user_id) => {
    const authToken = localStorage.getItem('authToken');
    const response = await axios.get(`http://127.0.0.1:8000/api/bookmark/${user_id.data}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    checks.data = response.data;
}
</script>

<template>
    <Base>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between">
                <RouterLink to="/vacancies"
                    class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-600 py-2">
                    <backIcon /> Back
                </RouterLink>
            </div>
            <div
                class="h-32 text-white text-center grid bg-cover rounded-md bg-center bg-[url('@/assets/Header/1696668225508.jpg')]">
                <div class="col-start-1 row-start-1 bg-gray-800 bg-opacity-70 w-full h-full rounded-md"></div>
                <div class="col-start-1 row-start-1 mx-auto my-auto">
                    <h1 v-if="show.job" class="w-full text-center text-xl font-bold py-2" v-text="show.job.name"></h1>
                    <div class="flex flex-wrap max-w-full bg-blue-300 text-black justify-center rounded-md py-2 gap-x-4 px-5"
                        v-if="show.organisation">
                        <div class="flex gap-x-2">
                            <companyIcon />
                            <span v-if="show.organisation">{{ show.organisation.name }}</span>
                        </div>
                        <div class="flex gap-x-2">
                            <locationIcon />
                            <span>{{ show.organisation.location }}</span>
                        </div>
                        <div class="flex gap-x-2" v-if="show.arrangement">
                            <contractIcon />
                            <span>{{ show.arrangement.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2 my-4" v-if="authStore.authRole">
                <div class="col-span-1" v-if="authStore.authRole.name == 'Seeker'">
                    <Button value="Apply Now" v-if="steps[1]" @clicked="click[1]" />
                </div>
                <div class="col-span-1" v-if="authStore.authRole.name == 'Seeker'">
                    <Button value="Bookmark" @clicked="bookMark" />
                </div>
                <div class="col-span-1">
                    <Button value="Share" />
                </div>
                <div class="col-span-1" v-if="authStore.authRole.name == 'Recruiter'">
                    <Button value="Delete" @clicked="vacacyDelete" />
                </div>
                <div class="col-span-1" v-if="authStore.authRole.name == 'Recruiter'">
                    <Button value="Applicants" v-if="steps[1]" @clicked="click[2]" />
                </div>
            </div>
            <component :is="steps[Step]" :show="show" :click="[nextPage, previousPage]"></component>
        </div>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>