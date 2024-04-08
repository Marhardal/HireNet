<template>
    <div class="col-span-2 mt-2 mx-5">
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-1 w-full h-30 bg-white rounded-md">
                <div class=" py-4 px-2 ">
                    <div class="flex flex-auto mb-4">
                        <div class="border-r-black border-r-2">
                            <div class="py-2 px-2 w-10 h-10 overflow-hidden rounded-full bg-blue-300 mr-2">
                                <Icon icon="fluent:briefcase-person-24-filled" width="25" class="fill-white" />
                                <!-- <Icon icon="fluent:briefcase-search-20-filled" width="25" class="fill-white" /> -->
                            </div>
                        </div>
                        <div class="flex-auto justify-center items-center">
                            <h3 class="font-semibold text- py-2 pl-2">All Vacancies</h3>
                        </div>
                    </div>
                    <h3 class="font-bold text-base pb-2 pl-2">{{ dashboard.vacancies + " Vacancies | " +
                        dashboard.completed +
                        " Completed Vacancies." }}</h3>
                    <Progress :value="dashboard.completed" :total="dashboard.vacancies" />
                </div>
            </div>
            <div class="col-span-1 w-full h-30 bg-white rounded-md">
                <div class=" py-4 px-2 ">
                    <div class="flex flex-auto mb-4">
                        <div class="border-r-black border-r-2">
                            <div class="py-2 px-2 w-10 h-10 overflow-hidden rounded-full bg-blue-300 mr-2">
                                <!-- <Icon icon="fluent:clipboard-task-list-rtl-24-filled" width="25" class="fill-white" /> -->
                                <Icon icon="fluent:briefcase-search-20-filled" width="25"
                                        class="fill-white"/>
                            </div>
                        </div>
                        <div class="flex-auto justify-center items-center">
                            <h3 class="font-semibold text- py-2 pl-2">Active Vacancies.</h3>
                        </div>
                    </div>
                    <h3 class="font-semibold text-base pb-2 pl-2">{{ dashboard.vacancies + ' Vacancies | ' +
                        dashboard.active + ' Active Vacancies.' }}</h3>
                    <Progress :value="dashboard.active" :total="dashboard.vacancies" />
                </div>
            </div>
            <div class="col-span-1 w-full h-30 bg-white rounded-md">
                <div class="col-span-1 w-full h-30 bg-white rounded-md">
                    <div class=" py-4 px-2 ">
                        <div class="flex flex-auto mb-4">
                            <div class="border-r-black border-r-2">
                                <div class="py-2 px-2 w-10 h-10 overflow-hidden rounded-full bg-blue-300 mr-2">
                                    <!-- <Icon icon="fluent:briefcase-person-24-filled" width="25" class="fill-white" /> -->
                                    <!-- <Icon icon="mingcute:bookmark-fill" width="25" class="fill-white" /> -->
                                    <!-- <Icon icon="fluent:briefcase-search-20-filled" width="25" class="fill-white" /> -->
                                    <Icon icon="fluent:clipboard-task-list-rtl-24-filled" width="25"
                                        class="fill-white" />
                                    <!-- <Icon icon="mdi:briefcase-check"  /> -->
                                </div>
                            </div>
                            <div class="flex-auto justify-center items-center">
                                <h3 class="font-semibold text- py-2 pl-2">Vacancies Shortlisting</h3>
                            </div>
                        </div>
                        <h3 class="font-bold text-base pb-2 pl-2">{{ dashboard.active + " Vacancies | " +
                            dashboard.shortlisted + " shortlisted Applicants." }}
                        </h3>
                        <Progress :value="dashboard.shortlisted" :total="dashboard.applicants" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-1 ml-5 my-2 w-md max-h-30 bg-white rounded-md">
        <div class=" py-4 px-2 ">
            <h3 class="font-semibold text-base pb-2 pl-2">Vacancy Chart</h3>
            <div class="flex justify-center">
                <Pie :values="dashboard" />
            </div>
        </div>
    </div>
    <div class="col-span-1 my-2 mr-5 rounded-md bg-white">
        <div class="w-full py-4 px-2 ">
            <h3 class="font-semibold text-base pb-2 pl-2">Vacancy Notifications</h3>
            <Notification v-for="(notification, index) in notifications" :key="index" :value="notification"
                :class="bg - blue - 200" />
        </div>
    </div>
    <div>

    </div>
</template>

<script setup>
import Pie from '@/components/Dashboard/pie.vue';
import { Icon } from '@iconify/vue';
import Notification from '../Cards/Notification.vue';
import Progress from '../Graphs/Progress.vue';

defineProps({
    dashboard: {
        type: Object,
        required: true,
        default: {}
    },
    notifications: {
        type: Object,
        required: true,
        default: {}
    }
})

</script>

<style lang="scss" scoped></style>