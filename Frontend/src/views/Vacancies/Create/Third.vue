<template>
    <div>
        <div class="col-span-10">
            <form action="">
                <div class="mx-auto max-w-2xl" v-if="duties">
                    <CheckboxGroup v-if="duties.length > 0" :options="duties" v-model="input.Third.duty_id" />
                </div>
                <div class="my-4">
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import CheckboxGroup from '@/components/Forms/CheckboxGroup.vue';
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';

const props = defineProps(['input']);

const duties = ref([]);

onMounted(async () => {
    getDuties()
});

const getDuties = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/duties');
    duties.value = response.data;
    // console.log(duties.value);
}
</script>

<style lang="scss" scoped></style>