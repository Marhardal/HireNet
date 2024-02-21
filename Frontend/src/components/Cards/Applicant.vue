<template>
    <div class="" v-if="applicant">
        <RouterLink :to='{ path: "/vacancy/" + postId + "/applicant/" + applicant.id }'>
            <div class="grid grid-cols-3 w-1/2 my-4 text-base text-black">
                <div class="col-span-1 mx-auto">
                    <img class="w-12 h-12 rounded-full object-cover" src="https://randomuser.me/api/portraits/men/1.jpg"
                        alt="Event image">
                </div>
                <div class="col-span-1 mx-auto my-auto">
                    <p>{{ applicant.first_name + ' ' + applicant.first_name }}</p>
                </div>
                <div class="col-span-1 mx-auto my-auto">
                    <ResumeIcon />
                </div>
            </div>
        </RouterLink>
    </div>
</template>

<script setup>
import ResumeIcon from '../icons/ResumeIcon.vue';

defineProps({
    applicant: {
        type: Object,
        required: true,
    },
    postId: {
        type: String,
        required: true,
    }
})
</script>

<style lang="scss" scoped></style>