<template>
    <div class="grid sm:grid-cols-2 gap-2">
        <div v-for="(option, key) in options" :key="key"
            class="flex p-3  w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            <label :for="key" class="text-sm text-gray-500 dark:text-gray-400">{{ option.name }}</label>
            <input type="checkbox"
                class="shrink-0 ms-auto mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                :id="key" :value="option.id" @input="$emit('update:modelValue', $event.target.value)">
        </div>
    </div>
</template>
    
<script setup>
defineProps({
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: Array,
        required: true,
        default: []
    }
})

defineEmits([
    'update:modelValue'
])
</script>

<style lang="scss" scoped></style>