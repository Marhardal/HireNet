<script setup>
import Nav from "@/components/Sections/Navigation.vue";
import Header from "@/components/Sections/Header.vue";
import Job from "@/components/Cards/Job.vue";
import axios from "axios";
import { onMounted, ref } from "vue";
import Base from "../Base.vue";
import { useAuthStore } from "@/Stores/Auth";

const authStore = useAuthStore();

const vacancies = ref([]);

const searchtxt = ref([]);

onMounted(async () => (
    authStore.getUser(),
    getVacancies()
    // getAppliedVacancies()
));

const getSearch = async () => {
    let response = await axios.get(`http://127.0.0.1:8000/api/vacancies/?search=${searchtxt.value}`);
    vacancies.value = response.data;
}

const getVacancies = async () => {
    authStore.getToken()
    const authToken = localStorage.getItem('authToken');
    if (authToken === "") {
        const response = await axios.get("http://127.0.0.1:8000/api/vacancies");
        vacancies.value = response.data;
    }
    else {
        const response = await axios.get("http://127.0.0.1:8000/api/vacancies", {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${authToken}`
            }
        });
        vacancies.value = response.data;
        console.log(vacancies.value);
    }
}

</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Jobs" />
    </template>
    <template v-slot:navigation>
        <Nav />
    </template>
    <template v-slot:main>
        <div class="">
            <div class="flex mx-8 py-4 max-h-3/4">
                <div class="flex justify-start">
                    <div class='flex items-center justify-center'>
                        <div class="flex rounded bg-white">
                            <input
                                class="max-w-full border-none bg-transparent px-4 py-1 text-gray-400 outline-none focus:outline-none "
                                type="search" name="search" placeholder="Search..." v-model="searchtxt"
                                @keyup="getSearch()" />
                            <button type="submit" class="rounded bg-blue-600 py-2 px-4 text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                    viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                    xml:space="preserve">
                                    <path
                                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex w-full justify-end" v-if="authStore.authRole">
                    <RouterLink to="vacancy/create" class="bg-blue-500 py-2 px-4 rounded-md text-white" v-if="authStore.authRole.name == 'Recruiter'">Create Vacancy
                    </RouterLink>
                    <span class="text-base text-black font-semibold" v-if="authStore.authRole.name == 'Seeker'">{{ vacancies.length }} New Vacancies Posted.</span>
                </div>
            </div>
            <main class="flex flex-wrap gap-2 w-full rounded-md" v-if="vacancies.length > 0">
                <Job v-for="(vacancy, index) in vacancies" :key="index" :job="vacancy" />
            </main>
            <div class="flex justify-center" v-else>
                <p class="text-base">No Vacancies Posted Yet.</p>
            </div>
        </div>
    </template>
    </Base>
    <!-- 
    </div> -->
</template>

<style lang="scss" scoped></style>