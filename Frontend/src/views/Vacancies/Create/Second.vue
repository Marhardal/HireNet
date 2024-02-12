<template>
    <Base>
    <template v-slot:header>
        <Header title="Add Vacancy Skills" />
    </template>
    <template v-slot:other>
        <div class="max-w-4xl mx-auto">
            <form action="" @submit.prevent>
                <div class="mx-auto max-w-2xl" v-if="skills">
                    <Listbox v-model="selectedSkill" >
                        <ListboxButton class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm">{{ selectedSkill.name }}</ListboxButton>
                        <ListboxOptions>
                            <ListboxOption v-for="skill in skills" :key="skill.id" :value="skill"
                                :disabled="skill.unavailable">
                                {{ skill.name }}
                            </ListboxOption>
                        </ListboxOptions>
                    </Listbox>
                    <!-- <CheckboxGroup v-if="skills.length > 0" :options="skills" v-model="form.skill_id" /> -->
                    <!-- <Multiselect v-model="form.skill_id" label="Select Skills" :options="skills" placeholder="Select the skills required for the position"/> -->
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
import Button from '@/components/Forms/Button.vue';
import Header from '@/components/Sections/Header.vue';
import Base from '@/views/Base.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

const form = reactive({
    skill_id: "",
    post_id: ""
});

const skills = [
    { id: 1, name: 'Durward Reynolds', unavailable: false },
    { id: 2, name: 'Kenton Towne', unavailable: false },
    { id: 3, name: 'Therese Wunsch', unavailable: false },
    { id: 4, name: 'Benedict Kessler', unavailable: true },
    { id: 5, name: 'Katelyn Rohan', unavailable: false },
];


const selectedSkill = ref(skills[0]);

onMounted(async () => {
    // getSkills()
    // console.log(skills.map((Skill) => ({ id: Skill.id, name: Skill.name })));
});

const getSkills = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/skills');
    skills.value = response.data.skills.map((Skill) => ([id => Skill.id, name => Skill.name]))
    // console.log(skills.id);
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

<!-- <style src="@vueform/multiselect/themes/default.css"></style> -->