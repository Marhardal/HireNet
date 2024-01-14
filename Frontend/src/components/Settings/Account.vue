<template>
    <div>
        This is the Account Tab.
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from "axios";

const bookMarks = ref();

const uid = ref();

onMounted( async () => {
    uid = 1;
    getBookMarks(uid);
});

const getBookMarks = async (uid) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/account/${uid}`);
    bookMarks.value = response.data;
}
</script>

<style lang="scss" scoped>

</style>