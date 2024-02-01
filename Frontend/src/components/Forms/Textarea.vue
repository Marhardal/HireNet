<template>
    <div class="">
        <label class="block text-sm font-medium mb-2 text-black">{{ label }}</label>
        <textarea
            class="py-3 px-4 block w-full border border-gray-400 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  text-black dark:focus:ring-gray-600"
            rows="3" :placeholder="placeholder" @input="$emit('update:modelValue', $event.target.value)" :value="modelValue"></textarea>
        <span class="text-rose-600" v-if="errors.length > 0" v-for="error in errors">{{ error }}</span>
    </div>
</template>

<script setup>
defineProps({
    placeholder: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: false,
    },
    modelValue: {
        type: String,
    },
    errors: {
        type: Array,
        required: false,
        default: []
    },
});

defineEmits([
    'update:modelValue'
])
</script>

<style lang="scss" scoped></style>