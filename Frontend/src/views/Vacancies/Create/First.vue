<script setup>
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import Select from '@/components/Forms/Select.vue';
import Base from '../../Base.vue';
import Header from '@/components/Sections/Header.vue';
import Button from '@/components/Forms/Button.vue';
import { useToast } from 'vue-toastification';

const props = defineProps(['input']);

const arrangements = ref([]);
const jobs = ref([]);

const toast = useToast();

const errors = ref([]);
onMounted(async () => {
    getArrangements()
    getJobs();
});

const getArrangements = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/arrangements');
    arrangements.value = response.data.map((arrangement) => ({value : arrangement.id, label : arrangement.name}));
}

const getJobs = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/jobs');
    jobs.value = response.data.jobs.map((job) => ({value : job.id, label : job.name}));
    // console.log(jobs.value);
}

const values = reactive({
    job_id: '',
    num: '',
    arrangement_id: '',
    about: '',
    organisation_id: '1',
    due_date: '',
});

const createVacancy = async () => {
    axios.post('http://127.0.0.1:8000/api/vacancies', values).then((response) => {
        toast.success(response.data)
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error('Please make sure you have filled in all fields.')
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
                <FormKit type="form"  submit-label="Create Vacancy" @submit="createVacancy">
                    <FormKit type="select" v-model="values.job_id" placeholder="Select an Arrangement for the job." :options="jobs" label="Select Job Name." validation="required" />
                    <FormKit type="number" v-model="values.num" label="Number of Employees" placeholder="Enter Number of Employees Wanted." validation="required"/>
                    <FormKit type="select" v-model="values.arrangement_id" placeholder="Select an Arrangement for the job." :options="arrangements" label="Select Job Arrangement Type" validation="required" />
                    <FormKit type="date" v-model="values.due_date" label="Job Application Closes on" placeholder="Enter a Job Location." validation="required" />
                    <FormKit type="textarea" v-model="values.about" label="Job Summary" placeholder="Enter a Job Summary." validation="required" />
                </FormKit>
        </div>
    </template>
    </Base>
</template>

<style src=""></style>