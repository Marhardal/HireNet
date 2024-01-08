<template>
    <div class="">
        <button class="bg-blue-500 py-2 text-base text-white font-semibold rounded-md items-center w-full">{{ value }}</button>
    </div>
</template>

<script setup>
    const props = defineProps({
        value: {
            type: String,
            required: true,
            default: 'Submit'   
        }
    })
</script>

<style lang="scss" scoped>

</style>