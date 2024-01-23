<script setup>
import First from '@/components/Multi-Step/Vacancy/First.vue';
import Second from '@/components/Multi-Step/Vacancy/Second.vue';
import Final from '@/components/Multi-Step/Vacancy/Final.vue';
import Header from '@/components/Sections/Header.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import Button from '@/components/Forms/Button.vue'
import vacancyInputs from '../../Composables/vacancyInput.js';
import Base from '../Base.vue';

const arrangements = ref([]);

const step = ref(0);

const values = reactive({
    job_id: '1',
    num: '',
    arrangement_id: '1',
    location: '',
    about: '',
    skill_id: [],
    duty_id: [],
    certificate_id: '',
    organisation_id: '1',
    due_date: '',
});

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
    step.value++;
}

// const createVacancy = async () => {
//     axios.post('http://127.0.0.1:8000/api/vacancies', values).then((response) => {
//         console.log(response.data);
//     }).catch((error) => {
//         errors.value = error?.response?.data?.errors;
//         console.log(errors);
//     });
// }

</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Create Job" />
    </template>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto">
            <component v-bind:is="steps[step]" v-bind:input="values"></component>
            <div class="grid grid-cols-2 gap-x-4">
                <div class="col-span-1">
                    <Button value="Previous" v-on:clicked="previousStep" v-if="step > 0" />
                </div>
                <div class="col-span-1 right-0">
                    <Button value="Next" v-on:clicked="nextStep" v-if="step < 2" class=""/>
                </div>
            </div>
        </div>
    </template>
    </Base>
</template> 