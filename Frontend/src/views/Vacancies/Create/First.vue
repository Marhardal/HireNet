<script setup>
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import Select from '@/components/Forms/Select.vue';
import Base from '../../Base.vue';
import Header from '@/components/Sections/Header.vue';
import Button from '@/components/Forms/Button.vue';

const props = defineProps(['input']);

const arrangements = ref([]);

const errors = ref([]);
onMounted(async () => {
    getArrangements()
});

const getArrangements = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/arrangements');
    arrangements.value = response.data;
}

const values = reactive({
    job_id: '1',
    num: '',
    arrangement_id: '',
    about: '',
    organisation_id: '1',
    due_date: '',
});

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
    <Base>
    <template v-slot:header>
        <Header title="Create Vacancy" />
    </template>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto">
            <form action="" @submit.prevent="createVacancy">
                <div class="my-4">
                    <Input placeholder="Enter a Job Title." label="Job Title." type="text" v-model="values.job_id"
                        :errors="errors.job_id" />
                </div>
                <div class="my-4">
                    <Input placeholder="Enter Number of Employees Wanted." label="Number of Employees." type="number"
                        v-model="values.num" :errors="errors.num" />
                </div>
                <div class="my-4">
                    <Select v-model="values.arrangement_id" v-if="arrangements.length > 0" :options="arrangements"
                        label="Select Job Arrangement Type" placeholder="Select an Arrangement for the job."
                        :errors="errors.arrangement_id" />
                </div>
                <div class="my-4">
                    <Input placeholder="Enter a Job Location." label="Job Application Closes on" type="date"
                        v-model="values.due_date" :errors="errors.due_date" />
                </div>
                <div class="my-4">
                    <Textarea placeholder="Enter a Job Summary." label="Job Summary" type="text" v-model="values.about"
                        :errors="errors.about" />
                </div>
                <div class="my-4">
                    <Button value="Create" @clicked="createVacancy" />
                </div>
            </form>
        </div>
    </template>
    </Base>
</template>

<style src=""></style>