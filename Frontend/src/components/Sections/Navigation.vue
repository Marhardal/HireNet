<script setup>
import { useAuthStore } from '@/Stores/Auth';
import DashboardIcon from '../icons/DashboardIcon.vue';
import ResumeIcon from '../icons/ResumeIcon.vue';
import { onMounted } from 'vue';
import { Icon } from '@iconify/vue';
import { ClipboardDocumentListIcon, BellAlertIcon, Cog6ToothIcon, BriefcaseIcon, UserGroupIcon } from "@heroicons/vue/24/solid";

const authStore = useAuthStore();

onMounted(async => {
    authStore.getUser()
    // console.log(authStore.authRole);
});

</script>

<template>
    <!-- component -->
    <div class="h-screen flex justify-start align-baseline items-center fixed left-2">
        <div class="ml-6 flex w-16 flex-col items-center space-y-10 py-6">
            <div class="space-y-48 rounded-md bg-blue-500">
                <ul>
                    <li class="p-5">
                        <RouterLink to="/">
                            <Icon icon="heroicons:home-20-solid" width="30" style="color: white" class="fill-white"/>
                        </RouterLink>
                    </li>
                    <li class="p-5">
                        <RouterLink to="/vacancies">
                            <BriefcaseIcon class="h-7 w-7 fill-white hover:fill-black active:fill-black"/>
                        </RouterLink>
                    </li>
                    <li class="p-5" v-if="authStore.authRole && authStore.authRole.name == 'Seeker'">
                            <RouterLink :to="{path: 'resume'}">
                                <ResumeIcon />
                            </RouterLink>
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 cursor-pointer text-gray-500 transition-all hover:text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg> -->
                    </li>
                    <li class="p-5" v-if="authStore.authRole && authStore.authRole.name == 'Recruiter'">
                        <RouterLink :to="{path: 'shortlist'}">
                            <ClipboardDocumentListIcon class="h-7 w-7 fill-white hover:fill-black"/>
                        </RouterLink>
                    </li>
                    <li class="p-5" v-if="authStore.authRole && authStore.authRole.name == 'Admin'">
                        <RouterLink :to="{path: 'shortlist'}">
                            <UserGroupIcon class="h-7 w-7 fill-white hover:fill-black"/>
                        </RouterLink>
                    </li>
                    <li class="p-5">
                        <RouterLink :to="{path: 'notification'}">
                            <BellAlertIcon class="h-7 w-7 fill-white hover:fill-black"/>
                        </RouterLink>
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 cursor-pointer text-gray-500 transition-all hover:text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg> -->
                    </li>
                    <li class="p-5">
                        <RouterLink to="/settings">
                            <Cog6ToothIcon class="h-7 w-7 fill-white hover:fill-black"/>
                        </RouterLink>
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 cursor-pointer text-gray-500 transition-all hover:text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg> -->
                    </li>
                    <!-- <li class="p-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 cursor-pointer text-gray-500 transition-all hover:text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</template>

<style lang="css" scoped>
    ul{
        list-style-type: none;
    }
</style>