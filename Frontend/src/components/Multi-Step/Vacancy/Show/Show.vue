<script setup>
import Button from "@/components/Forms/Button.vue";
import due from "@/components/icons/WarningDate.vue";
import creation from "@/components/icons/CreationDate.vue";
import moment from 'moment';
import { shallowRef, shallowReactive } from "vue";
import { useToast } from 'vue-toastification';
import axios from "axios";
import { onMounted } from "vue";
// import {  } from "@heroicons/vue/24/solid";

let errors = shallowRef([]);

const toast = useToast();

const props = defineProps({
    show: {
        type: Object,
        required: true,
        default: {}
    },
    User: {
        type: Object,
        required: true,
        default: {}
    }
});

onMounted(async () => {
    console.log(props.User);
    // console.log(props.markdown.duties);
})

const input = shallowReactive({
    'user_id': props.User.id,
    'post_id': props.show.id
})


// const renderedDuties = md.render(props.markdown.duties);
</script>

<template>
    <div class="flex flex-wrap justify-center gap-4 my-4">
        <div class="flex gap-x-2">
            <creation />
            <span class="text-base text-black font-semibold">Created {{ moment(show.created_at).fromNow() }}</span>
        </div>
        <div class="flex gap-x-2">
            <due />
            <span class="text-base text-black font-semibold">Application Closes {{ moment(show.due_date).fromNow()
                }}</span>
        </div>
    </div>
    <hr>
    <div class="w-full my-4 text-base" v-if="show.organisation">
        <h3 class="font-semibold text-xl mb-2">Company Background</h3>
        <p>{{ show.organisation.about }}</p>
    </div>
    <div class="w-full my-4 text-base">
        <h3 class="font-semibold text-xl mb-2">Position Summary</h3>
        <p>{{ show.about }}</p>
    </div>
    <div class="w-full my-4 text-base">
        <h3 class="font-semibold text-xl mb-2">Responsibilities</h3>
        <div class="ml-4" v-html="show.responsibilities.duties"></div>
    </div>
    <div class="w-full my-4 text-base" v-if="show.skills != 0">
        <h3 class="font-semibold text-xl mb-2">Skills</h3>
        <ol>
            <li v-for="skill in show.skills">{{ skill.name }}</li>
        </ol>
    </div>
    <div class="w-full my-4 text-base" v-if="show.certificate != 0">
        <h3 class="font-semibold text-xl mb-2">Qualification</h3>
        <ol>
            <li v-for="cert in show.certificate">{{ cert.name }}</li>Responsibilities
        </ol>
    </div>
    <!-- <main class="flex flex-wrap gap-2 w-full rounded-md" v-if="vacancies.length > 0">
            <Job v-for="(vacancy, index) in vacancies" :key="index" :job="vacancy" />
        </main> -->
</template>

<style lang="css">
ul {
    list-style-type: disc;
}
</style>