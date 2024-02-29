<script setup>
defineProps({
    shortlist: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <RouterLink :to="{ path: 'shortlist/' + shortlist.id }"
        class="grid grid-cols-5 text-base bg-white max-w-md rounded-md mx-auto my-2 p-2">
        <div class="col-span-2">
            <p v-text="shortlist.name"></p>
        </div>
        <div class="col-span-1 py-auto">
            <p v-text="shortlist.count"></p>
        </div>
        <div class="col-span-1">
            <div class="rounded-full w-5 h-5 bg-blue-600"></div>
        </div>
        <div class="col-span-1">
            Not Set
        </div>
    </RouterLink>
</template>

<style lang="scss" scoped></style>