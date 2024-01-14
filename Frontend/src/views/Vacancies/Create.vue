<script setup>
import First from '@/components/Multi-Step/Vacancy/First.vue';
import Second from '@/components/Multi-Step/Vacancy/Second.vue';
import Final from '@/components/Multi-Step/Vacancy/Final.vue';
import Header from '@/components/Sections/Header.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import Button from '@/components/Forms/Button.vue'
import vacancyInputs from '../../Composables/vacancyInput.js';

const arrangements = ref([]);

const step = ref(0);

// const {
//     values
// } = vacancyInputs();

const values = reactive({
    job_id: '1',
    num: '',
    arrangement_id: '1',
    location: '',
    about: '',
    skill_id: '',
    duty_id: '',
    certificate_id: '',
    organisation_id: '1',
    due_date: '',
});

const selectedValue = reactive({});

const sendValues = () => {
    if (step.value == 0) {
        selectedValue = [
            values.job_id,
            values.num,
            values.arrangement_id,
            values.location,
            values.about]
        }
    else if (step.value == 1) {
        selectedValue = [
            values.job_id,
            values.skill_id
        ]
    }
    else {
        selectedValue = [
            values.job_id,
            values.duty_id
        ]
    }
}

const errors = ref();

const steps = [
    First,
    Second,
    Final
];

const previousStep = () => {
    step.value--;
}
const nextStep = () => {
    // if (step.value == 0) {
    //     createVacancy();
    // } 
    // else if (step.value == 1) {
    //     createVacancySkills();
    // }
    // else {
    //     createVacancyDuties();
    // }
    // console.log(selectedValue);
    step.value++;
}

const createVacancy = async () => {
    axios.post('http://127.0.0.1:8000/api/vacancies', values).then((response) => {
        console.log(response.data);
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        console.log(errors);
    });
}

</script>

<template>
    <div class="grid grid-cols-10 gap-4">
        <div class="col-span-10">
            <Header title="Create Job" />
        </div>
        <component v-bind:is="steps[step]" v-bind:input="sendValues"></component>
        <div class="col-span-5">
            <Button value="Previous" v-on:clicked="previousStep" v-if="step > 0" />
            <Button value="Cancel" v-on:clicked="" v-if="step == 0" />
        </div>
        <div class="col-span-5">
            <Button value="Next" v-on:clicked="nextStep" v-if="step < 1" />
            <Button value="Submit" v-on:clicked="createVacancy" v-if="step == 0" />
        </div>
    </div>
</template> 