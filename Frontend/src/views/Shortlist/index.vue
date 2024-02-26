<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Navigation from '@/components/Sections/Navigation.vue';
import { ref } from 'vue';
import axios from 'axios';

const shortlist = ref();

const getShortlists = async () => {
    const response = await axios.get();
}
</script>
<template>
    <Base>
    <template v-slot:header>
        <Header title="Shortlist" />
    </template>
    <template v-slot:navigation>
        <Navigation />
    </template>
    <template v-slot:main>
        
    </template>
    </Base>
</template>
<style lang="scss" scoped></style>