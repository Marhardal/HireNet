<script setup>
import companyIcon from "../icons/Company.vue";
import locationIcon from "../icons/Location.vue";
import contractIcon from "../icons/Contract.vue";
import dateIcon from "../icons/CreationDate.vue";
import jobIcon from "../icons/Briefcase.vue";
import moment from "moment";
import Button from "../Forms/Button.vue";
const props = defineProps({
    job: {
        type: Object,
        required: true,
    }
});
</script>
<template>
    <!-- component -->
    <div class="relative mx-auto my-6 w-full max-w-sm border border-gray-700 rounded-md px-4 py-2 bg-slate-200">
        <RouterLink :to="{ path: 'vacancies/' + job.id }"
            class="w-full transform transition-transform duration-300 ease-in-out">
            <div class="rounded-lg">
                <div class="">
                    <div class="grid grid-cols-2">
                        <div class="flex items-center text-gray-800 xl:flex-row xl:items-center">
                            <jobIcon />
                        </div>
                        <div class="flex items-center text-gray-800 xl:flex-row xl:items-center">
                            <h2 class="line-clamp-1 text-base font-medium text-gray-800 md:text-lg" title="New York">
                                {{ job.job.name }}</h2>
                        </div>
                    </div>
                    <div class="mt-2 grid grid-cols-2 grid-rows-2 gap-4 pb-3 pt-3 border-y border-gray-700">
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <companyIcon />
                            <span class="xl:mt-0"> {{ job.organisation.name }} </span>
                        </p>
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <locationIcon />
                            <span class="mt-0"> {{ job.organisation.location }} </span>
                        </p>
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <contractIcon />
                            <span class="mt-0">{{ job.arrangement.name }}</span>
                        </p>
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <dateIcon />
                            <span class="mt-0"> {{ moment(job.due_date).fromNow() }} </span>
                        </p>
                    </div>
                    <div class="flex flex-cols gap-2 mt-2">
                        <div class="flex-auto">
                            <Button value="Apply Now"/>
                        </div>
                        <div class="flex-auto">
                            <Button value="BookMark"/>
                        </div>
                    </div>
                </div>
            </div>
        </RouterLink>
    </div>
</template>

<style lang="scss" scoped></style>