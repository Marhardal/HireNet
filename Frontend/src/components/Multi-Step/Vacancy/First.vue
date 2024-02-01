<script setup>
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import Select from '@/components/Forms/Select.vue';
import Button from '@/components/Forms/Button.vue';

const props = defineProps(['input']);

const arrangements = ref([]);

onMounted(async () => {
    getArrangements()
});

const getArrangements = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/arrangements');
    arrangements.value = response.data;
}

const createVacancy = async () => {
    axios.post('http://127.0.0.1:8000/api/vacancies', values).then((response) => {
        console.log(response.data);
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        console.log(errors);
    });
    // console.log(props.input.First);
}

</script>

<template>
    <div class="col-span-10">
        <form action="" @submit.prevent>
            <div class="my-4">
                <Input placeholder="Enter a Job Title." label="Job Title." type="text" v-model="input.First.job_id" :errors="errors.First.job_id" />
            </div>
            <div class="my-4">
                <Input placeholder="Enter Number of Employees Wanted." label="Number of Employees." type="number"
                    v-model="input.First.num" :errors="errors.First.num"/>
            </div>
            <div class="my-4">
                <Select v-model="input.First.arrangement_id" v-if="arrangements.length > 0" :options="arrangements"
                    label="Select Job Arrangement Type" placeholder="Select an Arrangement for the job." />
            </div>
            <div class="my-4">
                <Input placeholder="Enter a Job Location." label="Job Location" type="text" v-model="input.First.location" />
            </div>
            <div class="my-4">
                <Input placeholder="Enter a Job Location." label="Job Application Closes on" type="date"
                    v-model="input.First.due_date" />
            </div>
            <div class="my-4">
                <Textarea placeholder="Enter a Job Summary." label="Job Summary" type="text" v-model="input.First.about" />
            </div>
        </form>
    </div>
</template>

<style src=""></style>