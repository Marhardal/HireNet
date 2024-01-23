<script setup>
import Input from '@/components/Forms/Input.vue';
import Textarea from '@/components/Forms/Textarea.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import Multiselect from '@vueform/multiselect';
import Select from '@/components/Forms/Select.vue';

const props = defineProps(['input']);

const arrangements = ref([]);

onMounted(async () => {
    getArrangements()
});

const getArrangements = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/arrangements');
    arrangements.value = response.data;
}

</script>

<template>
    <div class="col-span-10">
        <form action="">
            <div class="my-4">
                <Input placeholder="Enter a Job Title." label="Job Title." type="text" v-model="input.job_id" />
            </div>
            <div class="my-4">
                <Input placeholder="Enter Number of Employees Wanted." label="Number of Employees." type="number"
                    v-model="input.num" />
            </div>
            <div class="my-4">
                <Select v-model="input.arrangement_id" v-if="arrangements.length > 0" :options="arrangements" label="Select Job Arrangement Type"
                    placeholder="Select an Arrangement for the job." />
            </div>
            <div class="my-4">
                <Input placeholder="Enter a Job Location." label="Job Location" type="text" v-model="input.location" />
            </div>
            <div class="my-4">
                <Input placeholder="Enter a Job Location." label="Job Application Closes on" type="date"
                    v-model="input.due_date" />
            </div>
            <div class="my-4">
                <Textarea placeholder="Enter a Job Summary." label="Job Summary" type="text" v-model="input.about" />
            </div>
        </form>
    </div>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>