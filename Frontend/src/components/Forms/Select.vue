<template>
    <div class="mt-4 mx-auto max-w-2xl">
        <label for="hs-select-label" class="block text-sm font-medium mb-2 text-black">{{ label }}</label>
        <select id="hs-select-label"
            class="py-3 px-4 pe-9 block w-full border border-gray-400 text-black rounded-md text-sm focus:border-gray-600 focus:ring-gray-600 disabled:opacity-50 disabled:pointer-events-none">
            <option selected class="text-gray-600 selection:text-gray-600">Open this select menu</option>
            <option v-for="option in options" :value="option.id" class="">{{ option.name }}</option>
        </select>
    </div>
</template>

<script setup>
defineProps({
    options: {
        type: Object,
        required: true,
    },

    label: {
        type: String,
        required: true
    }
})
</script>

<style lang="scss" scoped></style>