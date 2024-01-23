<script setup>
import { computed, reactive, ref } from "vue";

const props = defineProps({
    placeholder: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        required: false,
        default: "text"
    },
    label: {
        type: String,
        required: false,
    },
    modelValue: {
        type: String,
        default: ""
    },
    errors: {
        type: Array,
        required: false,
        default: []
    },
});

const check = computed(()=>({
    'border-gray-400 focus:border-blue-500': noError.value && props.errors.length == 0,
    'border-rose-500 focus:border-rose-500 focus:ring-red-500': hasError.value && props.errors.length > 0
}));

defineEmits([
    'update:modelValue'
])
</script>

<template>
    <div class="my-4">
        <label class="block text-sm font-medium mb-2 text-black">{{ label }}</label>
        <input :type="type"
            class="py-3 px-4 block w-full rounded-md text-sm border border-gray-400 disabled:opacity-50 disabled:pointer-events-noneborder-gray-400 focus:border-blue-500 text-black dark:focus:ring-gray-600"
            :placeholder="placeholder" @input="$emit('update:modelValue', $event.target.value)" :value="modelValue">
        <span class="text-rose-600" v-if="errors.length > 0" v-for="error in errors">{{ error }}</span>

    </div>
</template>

<style lang="scss" scoped></style>