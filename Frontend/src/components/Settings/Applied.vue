<template>
    <div class="flex flex-wrap gap-2 w-full rounded-md">
        <!-- v-if="applied.value.length > 0" -->
        <Job v-for="Apply in applied" :job="Apply" />
    </div>
</template>

<script setup>
import { onMounted, shallowRef } from 'vue';
import axios from "axios";
import Job from '../Cards/Job.vue';

const applied = shallowRef();

const userId = shallowRef(1);

onMounted( async () => {
    getAppliedPosts(userId.value);
});

const getAppliedPosts = async (userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/applied/${userId}`);
    applied.value = response.data.posts;
    console.log(applied.value);
}
</script>

<style lang="scss" scoped>

</style>