<template>
    <div class="col-span-10">
        <form action="">
            {{ input.skill_id }}
            <div class="mx-auto max-w-2xl" v-if="skills">
                <div class="grid sm:grid-cols-2 gap-2">
                    <div  v-for="(skill, key) in skills" :key="key"
                        class="flex p-3  w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                        <label :for="key" class="text-sm text-gray-500 dark:text-gray-400">{{ skill.name }}</label>
                        <input type="checkbox"
                            class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                            :id="key" :value="skill.id" v-model="input.skill_id">
                    </div>
                </div>
            </div>
            <div class="my-4">
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';

const props = defineProps(['input']);

const skills = ref([]);

onMounted(async () => {
    getSkills()
});

const getSkills = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/skills');
    skills.value = response.data;
    // console.log(skills.value);
}
</script>