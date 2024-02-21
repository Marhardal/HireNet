<script setup>
import Button from "@/components/Forms/Button.vue";
import due from "@/components/icons/WarningDate.vue";
import creation from "@/components/icons/CreationDate.vue";
import moment from 'moment';
import { shallowRef, shallowReactive } from "vue";
import { useToast } from 'vue-toastification';
import axios from "axios";
import { onMounted } from "vue";
import { useAuthStore } from "@/Stores/Auth";

const authStore = useAuthStore();

let errors = shallowRef([]);

const toast = useToast();

const props = defineProps({
    show: {
        type: Object,
        required: true,
        default: {}
    }
});

const id = props.show.id;

onMounted(async () => {
    authStore.getUser();
    // console.log(authStore.authRole.name);
})

const input = shallowReactive({
    'user_id': 5,
    'post_id': props.show.id
})

const bookMark = () => {
    axios.post('http://127.0.0.1:8000/api/bookmark/', input).then((response) => {
        toast.success("This job has been added to your favorites!");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error("Failed to Add the Job to your Favorites!");
    });
}

const vacacyDelete = async () => {
    axios.delete(`http://127.0.0.1:8000/api/vacancies/${props.show.id}`).then((response) => {
        toast.success("Vacancy has been deleted successfully");
    }).catch(error => {
        toast.error("Failed to delete a vacancy.");
    });
}
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
    <div class="w-full my-4 text-base" v-if="show.duty != 0">
        <h3 class="font-semibold text-xl mb-2">Responsibilities</h3>
        <ol>
            <li v-for="duty in show.duty">{{ duty.name }}</li>
        </ol>
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
            <li v-for="cert in show.certificate">{{ cert.name }}</li>
        </ol>
    </div>
    <!-- <main class="flex flex-wrap gap-2 w-full rounded-md" v-if="vacancies.length > 0">
            <Job v-for="(vacancy, index) in vacancies" :key="index" :job="vacancy" />
        </main> -->
</template>

<style lang="scss" scoped></style>