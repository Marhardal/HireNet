<template>
    <div>
        <div class="grid grid-cols-3 w-full h-20 text-base text-black" v-if="applicant.user">
            <div class="col-span-1">
                <img class="w-16 h-16 rounded-full object-cover" src="https://randomuser.me/api/portraits/men/1.jpg"
                    alt="Event image">
            </div>
            <div class="col-span-1">
                <p>{{ applicant.user.first_name }}</p>
            </div>
            <div class="col-span-1">

            </div>
        </div>
        <!-- <div class="h-20 md:flex">
            <div class="md:flex-shrink-0">
                <img class="w-full rounded-full object-cover md:w-48" src="https://randomuser.me/api/portraits/men/1.jpg"
                    alt="Event image">
            </div>
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Event Name</div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black">Event Description</p>
                <p class="mt-2 text-gray-500">Event Details...</p>
            </div>
        </div> -->
    </div>
</template>

<script setup>
    defineProps({
        applicant: {
            type: Object,
            required: true,
        }
    })
</script>

<style lang="scss" scoped></style>