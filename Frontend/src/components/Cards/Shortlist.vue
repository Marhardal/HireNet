<script setup>
defineProps({
    shortlist: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="rounded-md w-full">
        <RouterLink :to="{ path: 'shortlist/' + shortlist.id }"
            class="grid grid-cols-5 text-base bg-white w-full rounded-md my-2 py-4">
            <div class="col-span-2 mx-auto">
                <p v-text="shortlist.name"></p>
            </div>
            <div class="col-span-1 mx-auto">
                <p v-text="shortlist.count"></p>
            </div>
            <div class="col-span-1 mx-auto">
                <div class="rounded-full w-5 h-5 bg-blue-600"></div>
            </div>
            <div class="col-span-1 mx-auto">
                Not Set
            </div>
        </RouterLink>
    </div>
</template>

<style lang="scss" scoped></style>