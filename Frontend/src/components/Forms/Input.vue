<template>
    <div class="mt-4 mx-auto max-w-2xl">
        <label for="input-label" class="block text-sm font-medium mb-2 text-black">{{ label }}</label>
        <input :type="type" id="input-label"
            class="py-3 px-4 block w-full border border-gray-400 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  text-black dark:focus:ring-gray-600 "
            :placeholder="placeholder">
    </div>
</template>

<script setup>
defineProps({
    placeholder: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        required: false
    },
    label: {
        type: String,
        required: false,
    }
})
</script>

<style lang="scss" scoped></style>