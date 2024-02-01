<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from './Base.vue';
import Navigation from '@/components/Sections/Navigation.vue';
import Footer from '@/components/Sections/Footer.vue';

</script>

<template>
  <Base>
    <template v-slot:header>
      <Header title="Home"/>
    </template>
    <template v-slot:navigation>
      <Navigation />
    </template>
    <template v-slot:main></template>
    <template v-slot:other>
      <Footer/>
    </template>
  </Base>
</template>
