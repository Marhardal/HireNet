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
import { useToast } from 'vue-toastification';
import Applicant from '@/components/Multi-Step/Vacancy/Show/Applicant.vue';
import MarkdownIt from 'markdown-it';

const md = new MarkdownIt();

const step = shallowRef(2);
const show = shallowRef({});
const markdown = shallowRef();
const checks = shallowRef();


const toast = useToast();

const authStore = useAuthStore();

const userId = shallowRef();


let errors = shallowRef([]);

const authToken = localStorage.getItem('authToken');

const router = useRoute();

const id =router.params.id;

onMounted(async => {
    authStore.getUser();

    showVacancy(id);
    if (authStore.User) {
        userId.value = authStore.User.id;
    }
    bookMarkCheck(userId);
    vid.post_id = id;
});

const vid = reactive({
    'post_id': '',
    'user_id': userId,
});

const steps = shallowRef([
    Applicant,
    Applicants,
    Show,
    Apply,
])

const showVacancy = async (id) => {
    let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/${id}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    show.value = response.data.post;
    markdown.value = response.data.markdown;
    // console.log(show.value);
}

const nextPage = () => {
    step.value++;
}

const previousPage = () => {
    step.value--;
}

const bookMarkCheck = async (userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/bookmark/${userId.data}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    checks.data = response.data;
}

const bookMark = () => {
    axios.post('http://127.0.0.1:8000/api/bookmark/', {'id': id}, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success("This job has been added to your favorites!");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        // console.log(error.response.status);
        if (error.response.status == 409) {
            toast.error("Job Already added to your favorite!");
        }

    });
}

const Approve = () => {
    axios.put(`http://127.0.0.1:8000/api/vacancies/${id}`, {'status': true}, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success("Vacancy Approved Successfully.");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error("Failed to Approve Vacancy!");
    });
}

const Decline = () => {
    axios.put(`http://127.0.0.1:8000/api/vacancies/${id}`, {'status': false}, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        console.log(response.data);
        toast.success("Vacancy Declined Successfully.");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error("Failed to Approve Vacancy!");
    });
}

const vacacyDelete = async () => {
    axios.delete(`http://127.0.0.1:8000/api/vacancies/${id}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success("Vacancy has been deleted successfully");
        router.push('vacancies')
    }).catch(error => {
        toast.error("Failed to delete a vacancy.");
    });
}
</script>

<template>
    <Base>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto" v-if="authStore.User">
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
                    <Button value="Apply Now" @clicked="nextPage" v-if="step == 2" />
                    <Button value="Cancel" @clicked="previousPage" v-if="step == 3" />
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
                    <Button value="Applicants" @clicked="previousPage" v-if="step == 2" />
                    <Button value="Back" @clicked="nextPage" v-if="step == 1" />
                </div>
                <div class="col-span-1" v-if="authStore.authRole.name == 'Admin'">
                    <Button value="Approve" @clicked="Approve" v-if="step == 2" />
                </div>
                <div class="col-span-1" v-if="authStore.authRole.name == 'Admin'">
                    <Button value="Decline" @clicked="Decline" v-if="step == 2" />
                </div>
            </div>
            <component :is="steps[step]" :show="show" :markdown="markdown" :User="authStore.User" />
        </div>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>