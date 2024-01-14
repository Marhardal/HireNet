<template>
    <div class="col-span-10">
        <div class="flex justify-center">
            <ul>
                <li class="list-item" v-text="input.job_id"></li>
                <li class="list-item" v-text="input.number"></li>
                <li class="list-item" v-text="input.location"></li>
                <li class="list-item" v-text="input.about"></li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';

defineProps([
    'input'
]);


</script>

<style lang="scss" scoped>

</style>