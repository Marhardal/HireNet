<script setup>
import axios from 'axios';
import { onMounted, reactive, ref } from 'vue';
import { useRoute } from 'vue-router';
import Button from "@/components/Forms/Button.vue";
import due from "@/components/icons/WarningDate.vue";
import creation from "@/components/icons/CreationDate.vue";
import companyIcon from "@/components/icons/Company.vue";
import locationIcon from "@/components/icons/Location.vue";
import contractIcon from "@/components/icons/Contract.vue";
import backIcon from "@/components/icons/Back.vue";
import Job from "@/components/Cards/Job.vue";

import moment from 'moment';

const show = ref([]);
const vacancies = ref([]);
const checks = ref();
const user_id = ref();

const vid = reactive({
    'post_id': '',
    'user_id': 1
});

let errors = ref([]);

onMounted(async => {
    const id = useRoute().params.id;
    showVacancy(id);
    user_id.data = 1;
    bookMarkCheck(user_id);
    // getVacancies()
    vid.post_id = id;
});

const showVacancy = async (id) => {
    let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/${id}`);
    show.value = response.data.post;
}

// const getVacancies = async () => {
//     let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/`);
//     vacancies.value = response.data;
//     console.log(response.data);
// }

const bookMark = () => {
    console.log(vid);
    axios.post('http://127.0.0.1:8000/api/bookmark/', vid).then((response) => {
        console.log(response.data);
        router.push('/');
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        // console.log(errors);
    });
}

const bookMarkCheck = async (user_id) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/bookmark/${user_id.data}`);
    checks.data = response.data;
}
</script>

<template>
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between">
            <RouterLink to="/vacancies"
                class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-600">
                <backIcon /> Back
            </RouterLink>
        </div>
        <h1 v-if="show.job" class="w-full text-center">{{ show.job.name }}</h1>
        <div class="flex flex-wrap max-w-md bg-gray-500 justify-center rounded-md py-2 gap-x-4 mx-auto"
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
        <form class="grid grid-cols-3 gap-2 my-4" @submit.prevent>
            <div class="col-span-1">
                <Button value="Apply Now" />
            </div>
            <div class="col-span-1" >
                <Button value="Bookmark" @clicked="bookMark" :input="show.id"/>
            </div>
            <div class="col-span-1">
                <Button value="Share" />
            </div>
        </form>
        <div class="flex flex-wrap justify-center gap-4 my-4">
            <div class="flex gap-x-2">
                <creation />
                <span class="text-base text-black font-semibold">Created {{ moment(show.created_at).fromNow() }}</span>
            </div>
            <div class="flex gap-x-2">
                <due />
                <span class="text-base text-black font-semibold">Application Closes {{ moment(show.due_date).fromNow()
                }}</span>
            </div>
        </div>
        <hr>
        <div class="w-full my-4 text-base" v-if="show.organisation">
            <h3 class="font-semibold text-xl mb-2">Company Background</h3>
            <p>{{ show.organisation.about }}</p>
        </div>
        <div class="w-full my-4 text-base">
            <h3 class="font-semibold text-xl mb-2">Position Summary</h3>
            <p>{{ show.about }}</p>
        </div>
        <div class="w-full my-4 text-base" v-if="show.duty != 0">
            <h3 class="font-semibold text-xl mb-2">Responsibilities</h3>
            <ol>
                <li v-for="duty in show.duty">{{ duty.name }}</li>
            </ol>
        </div>
        <div class="w-full my-4 text-base" v-if="show.skills != 0">
            <h3 class="font-semibold text-xl mb-2">Skills</h3>
            <ol>
                <li v-for="skill in show.skills">{{ skill.name }}</li>
            </ol>
        </div>
        <div class="w-full my-4 text-base" v-if="show.certificate != 0">
            <h3 class="font-semibold text-xl mb-2">Qualification</h3>
            <ol>
                <li v-for="cert in show.certificate">{{ cert.name }}</li>
            </ol>
        </div>
        <main class="flex flex-wrap gap-2 w-full rounded-md" v-if="vacancies.length > 0">
            <Job v-for="(vacancy, index) in vacancies" :key="index" :job="vacancy" />
        </main>
    </div>
</template>

<style lang="scss" scoped></style>