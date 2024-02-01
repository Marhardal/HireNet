<template>
    <div class="col-span-10">
        <div class="flex justify-center">
            <ul>
                <li class="list-item" v-text="input.Second.skill_id"></li>
                <li class="list-item" v-text="input.Third.duty_id"></li>
                <li class="list-item" v-text="input.First.location"></li>
                <li class="list-item" v-text="input.First.about"></li>
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