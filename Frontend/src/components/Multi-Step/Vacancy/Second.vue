<template>
    <div class="col-span-10">
        <form action="">
            {{ input.skill_id }}
            <div class="mx-auto max-w-2xl" v-if="skills">
                <Listbox v-model="selectedPeople" multiple>
                    <ListboxButton>
                        {{ selectedPeople.map((Skill) => Skill.name).join(', ') }}
                    </ListboxButton>
                    <ListboxOptions>
                        <ListboxOption v-for="Skill in name" :key="Skill.id" :value="Skill">
                            {{ Skill.name }}
                        </ListboxOption>
                    </ListboxOptions>
                </Listbox>
            </div>
            <div class="my-4">skills
            </div>
        </form>
    </div>
</template>

<script setup>
import CheckboxGroup from '@/components/Forms/CheckboxGroup.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import { ref } from 'vue'
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

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