<script setup>
import companyIcon from "../icons/Company.vue";
import locationIcon from "../icons/Location.vue";
import contractIcon from "../icons/Contract.vue";
import dateIcon from "../icons/CreationDate.vue";
import jobIcon from "../icons/Briefcase.vue";
import moment from "moment";
import Button from "../Forms/Button.vue";
import { useAuthStore } from "@/Stores/Auth";
import { onMounted } from "vue";
import { BriefcaseIcon, BuildingOffice2Icon, CalendarDaysIcon, CheckCircleIcon, ExclamationCircleIcon, MapIcon, MapPinIcon, XCircleIcon } from "@heroicons/vue/24/solid";

const authStore = useAuthStore();

onMounted(async () => {
    authStore.getUser()
    // console.log(authStore.authRole.name);
})

const props = defineProps({
    job: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <!-- component -->
    <div class="relative mx-auto my-6 w-full max-w-sm rounded-md px-4 py-2 bg-slate-100" v-if="job">
        <div class="w-full transform transition-transform duration-300 ease-in-out" v-if="authStore.authRole">
            <router-link :to="{ path: 'vacancies/' + job.id }">
                <div class="">
                    <div class="grid grid-cols-2">
                        <div class="flex items-center text-gray-800 xl:flex-row xl:items-center">
                            <!-- <jobIcon /> -->
                            <BriefcaseIcon class="fill-black w-7 h-7" />
                        </div>
                        <div class="flex items-center text-gray-800 xl:flex-row xl:items-center">
                            <h2 class="line-clamp-1 text-base font-medium text-gray-800 md:text-lg" title="New York"
                                v-if="job.job">
                                {{ job.job.name }}</h2>
                        </div>
                    </div>
                    <div class="mt-2 grid grid-cols-2 grid-rows-2 gap-4 pb-3 pt-3 border-y border-gray-700"
                        v-if="job.organisation">
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <!-- <companyIcon /> -->
                            <BuildingOffice2Icon class="fill-black w-5 h-5" />
                            <span class="xl:mt-0"> {{ job.organisation.name }} </span>
                        </p>
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <!-- <locationIcon /> -->
                            <MapPinIcon class="fill-black w-5 h-5" />
                            <span class="mt-0"> {{ job.organisation.location }} </span>
                        </p>
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <contractIcon />
                            <span class="mt-0">{{ job.arrangement.name }}</span>
                        </p>
                        <p class="flex items-center text-gray-800 xl:flex-row xl:items-center gap-x-2">
                            <CalendarDaysIcon class="fill-black w-5 h-5" />
                            <span class="mt-0">Closes {{ moment(job.due_date).fromNow() }} </span>
                        </p>
                    </div>
                </div>
            </router-link>
            <div class="flex gap-2 mt-2" v-if="authStore.authRole.name == 'Seeker'">
                <div class="flex-auto">
                    <Button value="BookMark" />
                </div>
            </div>
            <div class="flex gap-2 mt-2 my-auto" v-else>
                <div class="flex-row flex mx-auto" v-if="job.status == true">
                    <span class="text-black text-base font-semibold pr-2 leading-tight">Approved</span>
                    <CheckCircleIcon class="fill-blue-500 h-5 w-5" />
                </div>
                <div class="flex-row flex mx-auto" v-else-if="job.status == false">
                    <span class="text-black text-base font-semibold pr-2 leading-tight">Declined</span>
                    <XCircleIcon class="fill-rose-700 h-5 w-5" />
                </div>
                <div class="flex-row flex mx-auto" v-else>
                    <span class="text-black text-base font-semibold pr-2 leading-tight">Waiting Approval</span>
                    <ExclamationCircleIcon class="fill-rose-700 h-5 w-5" />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>