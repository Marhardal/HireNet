<script setup>
import Nav from "../components/Sections/Navigation.vue";
import Header from "../components/Sections/Header.vue";
import Job from "../components/Cards/Job.vue";

import axios from "axios";
import { onMounted, ref } from "vue";

const vacancies = ref([])

onMounted(async () => (
    getVacancies()
))

const getVacancies = async () => {
    let response = await axios.get("http://127.0.0.1:8000/api/vacancies");
    vacancies.value = response.data;
    console.log(response.data);
}

</script>

<template>
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <Header />
        </div>
        <div class="col-span-1">
            <Nav />
        </div>
        <div class="col-span-11 mr-5">
            <main class="flex flex-wrap gap-2 w-full bg-blue-200 right-2 mt-5 rounded-md" v-if="vacancies.length > 0">
                <Job v-for="(vacancy, index) in vacancies" :key="index" :job="vacancy" />
            </main>
        </div>
    </div>
    
</template>

<style lang="scss" scoped></style>