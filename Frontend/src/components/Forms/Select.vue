<template>
    <div class="my-4">
        <label for="hs-select-label" class="block text-sm font-medium mb-2 dark:text-white">{{ label }}</label>
        <select id="hs-select-label"
            class="py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
            @input="$emit('update:modelValue', $event.target.value)">
            <option selected>Open this select menu</option>
            <option v-for="option in options" :value="option.id">{{ option.name }}</option>
        </select>
    </div>
</template>

<script setup>
defineProps({
    options: {
        type: Array,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    modelValue: {
        type: String,
        default: ""
    },
    errors: {
        type: Array,
        required: false,
        default: []
    }


})
</script>

<style lang="scss" scoped></style>