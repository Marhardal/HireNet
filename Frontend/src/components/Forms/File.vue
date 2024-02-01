<template>
    <div class="my-4">
        <label for="block text-sm font-medium mb-2 text-black">{{ label }}</label>
        <div class="">
            <label for="file-input" class="sr-only">Choose file</label>
            <input type="file" name="file-input" id="file-input"
                class="block w-full border border-gray-400 rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 file:bg-gray-200 file:border-0 file:me-4 file:py-3 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400"
                accept=".pdf" @change="handleFileChange">
            <!-- @input="$emit('update:modelValue', $event.target.value)" -->
        </div>
        <span class="text-rose-600" v-if="errors.length > 0" v-for="error in errors">{{ error }}</span>
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    label: {
        type: String,
        required: true,
        default: ""
    },
    modelValue: {
        type: String,
        required: true,
        default: ""
    },
    accept: {
        type: Array,
        required: true,
        default: []
    },
    errors: {
        type: Array,
        required: false,
        default: []
    },
}, ['emit']);

defineEmits([
    'update:modelValue'
]);

const selectedFile = ref(null);

// Accepted file types
const acceptedFileTypes = props.accept && props.accept.length > 0 ? props.accept.join(',') : '';

// Event handler for file input change
const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file.type !== 'application/pdf') {
        this.$emit("invalidFile")
    }
};
</script>

<style lang="scss" scoped></style>