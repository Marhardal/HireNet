<template>
    <Base>
    <template v-slot:header>
        <Header title="Add Vacancy Skills" />
    </template>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto">
            <form action="" @submit.prevent>
                <div class="mx-auto max-w-2xl" v-if="skills">
                    <!-- <CheckboxGroup v-if="skills.length > 0" :options="skills" v-model="form.skill_id" /> -->
                        <Multiselect v-model="form.skill_id" label="Select Skills" :options="skills" placeholder="Select the skills required for the position"/>
                        <!-- <multiselect v-model="value" :options="options"></multiselect> -->
                </div>
                <div class="my-4">
                </div>
                <div class="my-4">
                    <Button value="Create" @clicked="createVacancySkills" />
                </div>
            </form>
        </div>
    </template>
    </Base>
</template>

<script setup>
import Multiselect from "@vueform/multiselect";
import Button from '@/components/Forms/Button.vue';
import CheckboxGroup from '@/components/Forms/CheckboxGroup.vue';
import Header from '@/components/Sections/Header.vue';
import Base from '@/views/Base.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';

const form = reactive({
    skill_id: "",
    post_id: ""
});

const skills = reactive({});

onMounted(async () => {
    getSkills()
});

const getSkills = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/skills');
    skills.value = response.data.skills;
    console.log(skills.value);
}

const createVacancySkills = async () => {
    // console.log(form.skill_id.data);
    // axios.post('http://127.0.0.1:8000/api/skills', form).then((response) => {
    //     console.log(response.data);
    // }).catch((error) => {
    //     errors.value = error?.response?.data?.errors;
    //     console.log(errors);
    // });
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>