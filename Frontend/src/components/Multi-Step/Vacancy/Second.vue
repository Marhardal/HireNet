<template>
    <div class="col-span-10">
        <form action="">
            {{ input.skill_id }}
            <div class="mx-auto max-w-2xl" v-if="skills">
                <CheckboxGroup v-if="skills.length > 0" :options="skills" v-model="input.Second.skill_id" />
            </div>
            <div class="my-4">
            </div>
        </form>
    </div>
</template>

<script setup>
import CheckboxGroup from '@/components/Forms/CheckboxGroup.vue';
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