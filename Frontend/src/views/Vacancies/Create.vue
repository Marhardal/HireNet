<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'
import { reactive, ref, onMounted } from 'vue';
import { useAuthStore } from '@/Stores/Auth';
import axios from "axios";
import { useToast } from 'vue-toastification';
import Editor from '@tinymce/tinymce-vue';

const toast = useToast();

const editor = useEditor({
    content: '<p>I’m running Tiptap with Vue.js. 🎉</p>',
    extensions: [
        StarterKit,
    ],
});
// const router = useToast();

const authStore = useAuthStore();

const jobs = ref([]);

const arrangements = ref([]);

const duties = ref([]);

const skills = ref([]);

const certificates = ref([]);

const org_id = ref();

const errors = ref([]);

onMounted(async () => {
    await authStore.getUser(),
        getArrangements(),
        getJobs(),
        getSkills(),
        // getDuties(),
        getCertificates()
});

const authToken = localStorage.getItem('authToken');

const getArrangements = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/arrangements', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    arrangements.value = response.data.map((arrangement) => ({ value: arrangement.id, label: arrangement.name }));
}

const getJobs = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/jobs', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    jobs.value = response.data.jobs.map((job) => ({ value: job.id, label: job.name }));
}

// const getDuties = async () => {
//     const response = await axios.get('http://127.0.0.1:8000/api/duties', {
//         headers: {
//             Accept: 'application/json',
//             Authorization: `Bearer ${authToken}`
//         }
//     });
//     duties.value = response.data.duties.map((duty) => ({ value: duty.id, label: duty.name }));
// }

const getCertificates = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/certificates', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    certificates.value = response.data.certificates.map((certificate) => ({ value: certificate.id, label: certificate.name }));
}

const getSkills = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/skills', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    skills.value = response.data.skills.map((skill) => ({ value: skill.id, label: skill.name }));
}

const values = reactive({});


const createVacancy = async () => {
    // console.log(values.duties);
    axios.post('http://127.0.0.1:8000/api/vacancies', values, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success(response.data);
        $router.push('/vacancies');
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        toast.error('Please make sure you have filled in all fields.')
    });
}


</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Create Job" />
    </template>
    <template v-slot:other>
        <div class="max-w-2xl items-center align-middle mx-auto bg-white">
            <FormKit type="form" :actions="false">
                <FormKit type="multi-step" tab-style="tab">
                    <FormKit type="step" name="post">
                        <FormKit type="select" v-model="values.job_id" placeholder="Select Job Title." :options="jobs"
                            label="Select Job Name." validation="required" />
                        <FormKit type="number" v-model="values.num" label="Number of Employees"
                            placeholder="Enter Number of Employees Wanted." validation="required" />
                        <FormKit type="select" v-model="values.arrangement_id"
                            placeholder="Select an Arrangement for the job." :options="arrangements"
                            label="Select Job Arrangement Type" validation="required" />
                        <FormKit type="date" v-model="values.due_date" label="Job Application Closes on"
                            placeholder="Enter a Job Location." validation="required" />
                        <FormKit type="textarea" v-model="values.about" label="Job Summary"
                            placeholder="Enter a Job Summary." validation="required" />
                    </FormKit>
                    <FormKit type="step" name="duties">
                        <!-- <FormKit type="select" v-model="values.duty_id" placeholder="Select Job Duties." multiple
                            :options="duties" label="Job Duties." validation="required" /> -->
                        <!-- <editor-content :editor="editor" /> -->
                        <!-- <textarea name="" id="" cols="30" rows="3" v-model="values.duties"></textarea> -->
                        <!-- <QuillEditor theme="snow" v-model:content="values.duties"/> -->
                        <!-- <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor> -->
                        <Editor v-model="values.duties" api-key="p7bxswmc16azpbpvuyzyez274pm0zs0wfkms12gvbk7u2dze" :init="{
                plugins: 'lists link image table code help wordcount', 
                selector: 'textarea',  // change this value according to your HTML
                plugins: 'lists',
                toolbar: 'numlist bullist'
            }" />
                    </FormKit>
                    <FormKit type="step" name="skills">
                        <FormKit type="select" v-model="values.skill_id" placeholder="Select Job Skills." multiple
                            :options="skills" label="Select Job Skills." validation="required" />
                    </FormKit>
                    <FormKit type="step" name="requirements">
                        <FormKit type="select" v-model="values.certificate_id" placeholder="Select Job Requirements."
                            multiple :options="certificates" label="Select Job Requirements" validation="required" />
                        <template #stepNext>
                            <FormKit type="submit" @click.prevent="createVacancy" />
                        </template>
                    </FormKit>
                </FormKit>
            </FormKit>
        </div>
    </template>
    </Base>
</template>