<template>
    <div class="w-full text-black my-6 mx-4 h-full bg-slate-50" v-if="authStore.authUser">
        <div class="flex flex-col w-full items-center">
            <span class="text-xl font-semibold">{{ authStore.authUser.first_name + " " + authStore.authUser.surname
                }}</span>
            <span class="text-base">{{ authStore.authUser.email + " | (+265) " + authStore.authUser.phone }}</span>
        </div>
        <div class="flex flex-col w-full py-4 gap-y-2" v-if="resume">
            <div class="">
                <h3 class="text-base font-semibold">Professional Summary</h3>
                <p>{{ resume.summary }}</p>
            </div>
            <div class="" v-if="resume.jobs">
                <h3 class="text-base font-semibold">Work Experience</h3>
                <div class="" v-for="job in resume.jobs">
                    <h3>{{ job.name }}</h3>
                    <p>{{ job.pivot.organisation }}</p>
                    <p>{{ job.pivot.start }}</p>
                    <p v-if="job.pivot.finish == null">Current</p>
                    <p v-else>{{ job.pivot.finish }}</p>
                    <p v-if="job.duties" v-for="duty in job.duties">
                        {{ duty.name }}
                    </p>
                </div>
            </div>
            <div class="" v-if="resume.skills">
                <h3 class="text-base font-semibold">Skills</h3>
                <p v-for="skill in resume.skills">{{ skill.name }}</p>
            </div>
            <div class="" v-if="resume.certificates">
                <h3 class="text-base font-semibold">Education</h3>
                <div v-for="certificate in resume.certificates">
                    <p>{{ certificate.name }}</p>
                    <div class="" v-if="certificate.pivot">
                        <p>{{ certificate.pivot.school }}</p>
                        <p>{{ certificate.pivot.started }}</p>
                        <p v-if="certificate.pivot.finished == null">Current</p>
                        <p v-else>{{ certificate.pivot.finished }}</p>
                    </div>
                </div>
            </div>
            <div class="" v-if="resume.referrals">
                <h3 class="text-base font-semibold">Referrals</h3>
                <div class="" v-for="referral in resume.referrals">
                    <p>{{ referral.full_name }}</p>
                    <p>{{ referral.organisation }}</p>
                    <p>{{ referral.phone }}</p>
                    <p>{{ referral.email }}</p>
                </div>
            </div>
        </div>
        <div class="flex h-full justify-center items-center" v-else>
            <div class="px-4 py-2 bg-slate-50 rounded-md">
                <RouterLink :to="{ path: 'resume/create' }" class="">Create Resume</RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/Stores/Auth';
import { onMounted } from 'vue';

const authStore = useAuthStore();

onMounted( async () => {
     await authStore.getUser()
});

defineProps({
    resume: {
        type: Object,
        required: true
    }
});
</script>

<style lang="scss" scoped></style>