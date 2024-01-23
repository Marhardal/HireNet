<template>
    <button type="button"
        class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-800 hover:text-gray-400 focus:outline-none focus:text-blue-700 focus:font-semibold disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active"
        id="tabs-with-underline-item-1" data-hs-tab="#tabs-with-underline-1" aria-controls="tabs-with-underline-1"
        role="tab">
        {{ name }}
    </button>
</template>

<script setup>
defineProps({
    name: {
        type: String,
        required: true,
    }
})
</script>

<style lang="scss" scoped></style>