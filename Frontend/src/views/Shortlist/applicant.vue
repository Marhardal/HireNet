<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import Base from '../Base.vue';
import { useRoute } from 'vue-router';
import Header from '@/components/Sections/Header.vue';
import PDFViewer from "pdf-viewer-vue";
import Button from '@/components/Forms/Button.vue';
import { useToast } from "vue-toastification";
import { button } from "@formkit/icons";
import Shortlisted from "@/components/Shortlist/Shortlist.vue";
import Declined from "@/components/Shortlist/Declined.vue";
import All from "@/components/Shortlist/All.vue";

const Tabs = ref([
    {label: 'All', component: All},
    {label: 'Shortlist', component: Shortlisted},
    {label: 'Declined', component: Declined},
])

const router =  useRoute();

const toast = useToast();

const applicant = ref([]);

const url = ref(null);

const post = ref([]);

const authToken = localStorage.getItem("authToken");

const postId = router.params.postId;

const userId = router.params.userId;


onMounted(async () => {
    getApplicant([postId, userId]);
});

const getApplicant = async ([postId, userId]) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/vacancy/${postId}/applicant/${userId}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    applicant.value = response.data.applicant;
    post.value = response.data.post;
    url.value = response.data.url;
    // console.log(url.value);
}



// const pdf = `http://127.0.0.1:8000/api/vacancy/${postId}/applicant/${userId}/resume`;

const errors = ref([]);

const Shortlist = () => {
    axios.put(`http://127.0.0.1:8000/api/vacancy/${postId}/applicant/${userId}`, {'shortlisted': 1}, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success("Applicant Shortlisted Successfully.");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error("Failed to Approve Vacancy!");
    });
}

const Decline = () => {
    axios.put(`http://127.0.0.1:8000/api/vacancy/${postId}/applicant/${userId}`, {'shortlisted': 1}, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success("Applicant Shortlisted Successfully.");
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error("Failed to Approve Vacancy!");
    });
}
</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Shortlist Applicant" />
    </template>
    <template v-slot:other>
        <!-- <iframe src="http://127.0.0.1:8000/download/resume" frameborder="0" width="100%" height="80%">vacancy/{postId}/applicant/{userId}/resume</iframe> -->
        <div class="max-w-4xl mx-auto" v-if="applicant">
            <div class="w-full">
                <div class="grid grid-cols-2 my-4 gap-2 w-full mx-auto mt-2">
                    <div class="col-span-1">
                        <div class="w-1/2">
                            <Button value="Shortlist" @clicked="Shortlist"/>
                        </div>
                    </div>
                    <div class="col-span-1 w-full flex justify-end ">
                        <div class="w-1/2">
                            <Button value="Declined" @clicked="Decline"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full my-4 rounded-md overflow-hidden">
                <details class="bg-white py-2 px-4 rounded group">
                    <summary class="list-none flex flex-wrap items-start w-full cursor-pointer">
                        <div class="flex flex-auto pt-2 font-semibold w-full">
                            <div class="flex-auto">
                                <h3>Vacancy Details.</h3>
                            </div>
                            <div class="flex w-10 items-center justify-center">
                                <div class="border-8 border-transparent border-l-gray-600 group-open:rotate-90 transition-transform origin-left">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-auto w-full py-2">
                            <p>{{ post.about }}</p>
                        </div>
                    </summary>
                    <div class="p-4">
                        <div class="w-full my-4 text-base" v-if="post.duty != 0">
                            <h3 class="font-semibold text-xl mb-2">Responsibilities</h3>
                            <ol>
                                <li v-for="duty in post.duty">{{ duty.name }}</li>
                            </ol>
                        </div>
                        <div class="w-full my-4 text-base" v-if="post.skills != 0">
                            <h3 class="font-semibold text-xl mb-2">Skills</h3>
                            <ol>
                                <li v-for="skill in post.skills">{{ skill.name }}</li>
                            </ol>
                        </div>
                        <div class="w-full my-4 text-base" v-if="post.certificate != 0">
                            <h3 class="font-semibold text-xl mb-2">Qualification</h3>
                            <ol>
                                <li v-for="cert in post.certificate">{{ cert.name }}</li>
                            </ol>
                        </div>
                    </div>
                </details>
                <!-- <section class="grid place-items-center bg-emerald-800 p-16 h-full">
                    
                </section> -->
                <!-- <label>
                    <input class="peer/showLabel absolute scale-0" type="checkbox" />
                    <div
                        class="block max-h-52 my-6 w-full overflow-hidden rounded-lg bg-white px-4 py-0 transition-all duration-300 peer-checked/showLabel:max-h-full">
                        <h3 class="flex h-10 cursor-pointer items-center font-bold">Vacancy Details.</h3>
                        <div class="w-full my-4 text-base">
                            <h3 class="font-semibold text-xl mb-2">Position Summary</h3>
                            <p>{{ post.about }}</p>
                        </div>
                        <div class="w-full my-4 text-base" v-if="post.duty != 0">
                            <h3 class="font-semibold text-xl mb-2">Responsibilities</h3>
                            <ol>
                                <li v-for="duty in post.duty">{{ duty.name }}</li>
                            </ol>
                        </div>
                        <div class="w-full my-4 text-base" v-if="post.skills != 0">
                            <h3 class="font-semibold text-xl mb-2">Skills</h3>
                            <ol>
                                <li v-for="skill in post.skills">{{ skill.name }}</li>
                            </ol>
                        </div>
                        <div class="w-full my-4 text-base" v-if="post.certificate != 0">
                            <h3 class="font-semibold text-xl mb-2">Qualification</h3>
                            <ol>
                                <li v-for="cert in post.certificate">{{ cert.name }}</li>
                            </ol>
                        </div>
                    </div>
                </label> -->
            </div>
            <div class="w-full bg-white my-4 py-2 px-4 rounded-md">
                <h3 class="my-4 text-base font-bold">Applicants Attachments.</h3>
                <details class="bg-blue-200 rounded-md py-2 my-2 px-4 group">
                    <summary class="list-none flex flex-wrap items-start w-full cursor-pointer">
                        <div class="flex flex-auto pt-2 font-semibold w-full">
                            <div class="flex-auto">
                                <h3 class="text-base font-semibold">Cover Letter</h3>
                            </div>
                            <div class="flex w-10 items-center justify-center">
                                <div class="border-8 border-transparent border-l-gray-600 group-open:rotate-90 transition-transform origin-left">
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full py-2" v-if="applicant">
                            <div class="flex-1 w-full">
                                <p v-if="applicant.pivot" class="line-clamp-3 group-open:line-clamp-none">{{ applicant.pivot.message }}</p>
                            </div>
                        </div>
                    </summary>
                    <!-- <div class="p-4">
                        <div class="w-full my-4 text-base" v-if="url">
                            <iframe :src="url" frameborder="40" width="100%" height="500px"></iframe>
                        </div>
                    </div> -->
                </details>
                <details class="bg-blue-200 rounded-md py-2 px-4 group">
                    <summary class="list-none flex flex-wrap items-start w-full cursor-pointer">
                        <div class="flex flex-auto py-2 font-semibold w-full">
                            <div class="flex-auto">
                                <h3 class="text-base font-semibold">Curriculum Vitae</h3>
                            </div>
                            <div class="flex w-10 items-center justify-center">
                                <div class="border-8 border-transparent border-l-gray-600 group-open:rotate-90 transition-transform origin-left">
                                </div>
                            </div>
                        </div>
                    </summary>
                    <div class="p-4">
                        <div class="w-full h-70 py-2 text-base" v-if="url">
                            <iframe :src="url" frameborder="40" class="w-full rounded-md left-0" height="700px"></iframe>
                        </div>
                    </div>
                </details>
            </div>
            <div class="w-full">
                <!-- <p class="text-black text-base font-sm" v-if="applicant.pivot">{{ applicant.pivot.message }}</p> -->
            </div>
        </div>
        <!-- <PDFViewer :source="url" /> -->
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>