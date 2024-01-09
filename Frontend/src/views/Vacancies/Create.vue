<script setup>
import Input from '@/components/Forms/Input.vue';
import Select from '@/components/Forms/Select.vue';
import Tiptap from '@/components/Forms/Tiptap.vue';
import Header from '@/components/Sections/Header.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const arrangements = ref([]);

onMounted(async () => {
    // console.log("object");
    getArrangements()
});

const getArrangements = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/arrangements');
    arrangements.value = response.data;
    console.log(response.data);
}
</script>

<template>
    <div class="grid grid-cols-1 gap-4">
        <div class="col-span-10">
            <Header title="Create Job" />
        </div>
        <div class="col-span-10">
            <Input placeholder="Enter a Job Title." label="Job Title." type="text"/>
        </div>
        <div class="col-span-10">
            <Input placeholder="Enter Number of Employees Wanted." label="Number of Employees." type="number" />
        </div>
        <div class="col-span-10" v-if="arrangements.length > 0">
            <Select :options="arrangements" label="Job Arrangement Type" type="text"/>
        </div>
        <div class="col-span-10">
            <Input placeholder="Enter a Job Location." label="Job Location" type="text"/>
        </div>
        <div class="col-span-10">
            <Tiptap />
        </div>
    </div>
</template>

<style lang="scss" scoped></style>