<template>
    <div class="flex flex-wrap gap-2 w-full rounded-md">
        <!-- v-if="bookMarks.value.length > 0" -->
        <Job v-for="bookMark in bookMarks" :job="bookMark" />
    </div>
</template>

<script setup>
import { onMounted, shallowRef } from 'vue';
import axios from "axios";
import Job from '../Cards/Job.vue';

const bookMarks = shallowRef([]);

const uid = shallowRef([]);

onMounted(async () => {
    uid.data = 4;
    getBookMarks(uid);
});

const getBookMarks = async (uid) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/bookmark/${uid.data}`);
    bookMarks.value = response.data;
}
</script>

<style lang="scss" scoped></style>