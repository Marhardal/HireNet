<script setup>
import axios from 'axios';
import { onMounted, reactive, shallowRef } from 'vue';
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
import Base from '../Base.vue';
import Show from '@/components/Multi-Step/Vacancy/Show/Show.vue';
import Apply from '@/components/Multi-Step/Vacancy/Show/Apply.vue';

const step = shallowRef(0);
const show = shallowRef({});
const vacancies = shallowRef([]);
const checks = shallowRef();
const user_id = shallowRef(1);

const vid = reactive({
    'post_id': '',
    'user_id': 1
});

let errors = shallowRef([]);

onMounted(async => {
    const id = useRoute().params.id;
    showVacancy(id);
    bookMarkCheck(user_id.value);
    vid.post_id = id;
});

const steps = shallowRef([
    Show,
    Apply
])

const showVacancy = async (id) => {
    let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/${id}`);
    show.value = response.data.post;
    // console.log(show);
}

const nextPage = () => {
    step.value ++;
}

const previousPage = () => {
    step.value --;
}
// const getVacancies = async () => {
//     let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/`);
//     vacancies.value = response.data;
//     console.log(response.data);
// }


const bookMarkCheck = async (user_id) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/bookmark/${user_id.data}`);
    checks.data = response.data;
}
</script>

<template>
    <Base>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto">
            <component :is="steps[step]" :show="show" input="vid" :click="[nextPage, previousPage]"></component>
        </div>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>