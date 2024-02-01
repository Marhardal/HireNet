<template>
    <div>
        This is the Applied Tab.
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from "axios";

const bookMarks = ref();

const userId = ref(1);

onMounted( async () => {
    getBookMarks(userId);
});

const getBookMarks = async (userId) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/applied/${userId}`);
    bookMarks.value = response.data;
}
</script>

<style lang="scss" scoped>

</style>