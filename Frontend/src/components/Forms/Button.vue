<template>
    <div class="max-w-sm mx-auto">
        <button class="bg-blue-500 py-2 text-base text-white font-semibold rounded-md items-center w-full"
            @click="buttonClicked()">{{ value }}</button>
    </div>
</template>

<script setup>

const props = defineProps({
    value: {
        type: String,
        required: true,
        default: 'Submit'
    },

    inputValue: {
        type: Object,
    }
});

const emit = defineEmits(['clicked']);

const buttonClicked = () => {
    emit("clicked", props.inputValue)
}
</script>

<style lang="scss" scoped></style>