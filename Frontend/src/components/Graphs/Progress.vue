<template>
    <div class="flex items-center py-3 ml-2">
        <span class="w-8 h-8 shrink-0 mr-4 rounded-full bg-blue-50 flex items-center justify-center">
            <Icon icon="uis:graph-bar" />
        </span>
        <div class="space-y-3 flex-1">
            <div class="flex items-center">
                <h4 class="font-medium text-sm mr-auto text-gray-700 flex items-center">
                    Progress
                    <InformationCircleIcon class="w-5 h-5 fill-blue-300"/>
                </h4>
                <span class="px-2 py-1 rounded-lg bg-red-50 text-red-500 text-xs">
                    {{ value }} / {{ total }}
                </span>
            </div>
            <div class="overflow-hidden bg-blue-50 h-1.5 rounded-full w-full">
                <span class="h-full bg-blue-500 w-full block rounded-full" style="width: 62%"></span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { InformationCircleIcon } from "@heroicons/vue/24/solid";
import { Icon } from '@iconify/vue';

defineProps({
    value: {
        type: String,
        required: true,
    },
    total: {
        type: String,
        required: true,
    }
})
</script>

<style lang="scss" scoped></style>