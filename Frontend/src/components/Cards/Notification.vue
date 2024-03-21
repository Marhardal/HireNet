<template>
    <div class="" v-if="value">
        <RouterLink :to="{ path: '/'}">
            <div class="flex justify-between py-6 px-4 bg-white/30 rounded-md">
                <div class="flex items-center space-x-4 bg-white rounded-full p-2">
                    <BuildingOfficeIcon class="h-12 w-12" />
                </div>
                <div class="flex flex-col text-center space-y-1" v-if="value.data">
                    <span class="font-bold">{{ value.data.title }}</span>
                    <span class="text-sm">{{ value.data.message }}</span>
                </div>
                <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm ">
                    {{ moment(value.created_at).fromNow() }}
                </div>
            </div>
        </RouterLink>
    </div>
</template>

<script setup>
import moment from "moment";
import { BuildingOfficeIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
    value: {
        type: Object,
        required: true
    }
})

console.log(props.value);
</script>

<style lang="scss" scoped></style>