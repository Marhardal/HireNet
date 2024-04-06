<script setup>
import { useAuthStore } from '@/Stores/Auth';
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import { onMounted, ref, reactive } from 'vue';
import axios from "axios";
import { useToast } from 'vue-toastification';
import Editor from '@tinymce/tinymce-vue';

const authStore = useAuthStore();

const toast = useToast();

const duties = ref([]);

const skills = ref([]);

const certificates = ref([]);

const jobs = ref([]);

onMounted(async () => {
    await authStore.getUser(),
        getJobs(),
        getSkills(),
        getCertificates()
    // getDuties()
});

const authToken = localStorage.getItem('authToken');


const getJobs = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/jobs', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    jobs.value = response.data.jobs.map((job) => ({ value: job.id, label: job.name }));
}

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

const value = reactive({});

const errors = reactive({});

const createResume = async () => {
    // console.log(value);
    axios.post('http://127.0.0.1:8000/api/resume', value, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        // console.log(response.data);
        toast.success(response.data);
        router.push('/vacancies');
    }).catch((error) => {
        errors.value = error?.response?.data?.errors;
        if (error.response.status == 409) {
            toast.error('Seems like you already have a CV.')
        }
    });
}
</script>

<template>
    <Base>
    <template v-slot:header>
        <Header title="Create Job" />
    </template>
    <template v-slot:other>
        <div class="w-full flex h-screen justify-center items-center">
            <FormKit type="form" :actions="false">
                <FormKit type="multi-step" tab-style="tab" v-if="authStore.authUser">
                    <FormKit type="step" name="resume">
                        <FormKit type="text" disabled label="First Name" :value="authStore.authUser.first_name" />
                        <FormKit type="text" disabled label="Surname" :value="authStore.authUser.surname" />
                        <FormKit type="textarea" v-model="value.summary" label="Summary"
                            placeholder="Enter your Professional Summary." validation="required" />
                    </FormKit>
                    <FormKit type="step" name="skills">
                        <FormKit type="select" multiple label="Skills" :options="skills"
                            placeholder="Select the skills which you have." v-model="value.skill_id"
                            validation="required" />
                    </FormKit>
                    <FormKit type="step" name="Experience">
                        <FormKit type="select" label="Jobs" :options="jobs" v-model="value.job_id"
                            placeholder="Select Job Title." validation="required" />
                        <FormKit type="text" label="Organisation Name" v-model="value.organisation"
                            placeholder="Enter an Organisation Name" validation="required" />
                        <FormKit type="month" label="Start Date" v-model="value.start"
                            placeholder="Enter the school name you attended." validation="required" />
                        <FormKit type="month" label="Finish Date" v-model="value.end"
                            placeholder="Enter the school name you attended." />
                        <!-- <FormKit type="select" multiple label="Duties" v-model="value.duty_id" :options="duties"
                                placeholder="Select the duties you performed on the job." validation="required" /> -->
                        <Editor v-model="value.duties" api-key="p7bxswmc16azpbpvuyzyez274pm0zs0wfkms12gvbk7u2dze"
                            :init="{
                                plugins: 'lists link image table code help wordcount',
                                selector: 'textarea',  // change this value according to your HTML
                                plugins: 'lists',
                                toolbar: 'numlist bullist'
                            }" />
                    </FormKit>
                    <FormKit type="step" name="education">
                        <FormKit type="select" label="Education" :options="certificates" v-model="value.certificate_id"
                            validation="required" />
                        <FormKit type="text" label="School Name" placeholder="Enter the school name you attended."
                            v-model="value.school" validation="required" />
                        <FormKit type="month" label="Start Date" v-model="value.started"
                            placeholder="Enter the school name you attended." validation="required" />
                        <FormKit type="month" label="Finish Date" v-model="value.finished"
                            placeholder="Enter the school name you attended." />
                    </FormKit>
                    <FormKit type="step" name="referrals">
                        <FormKit type="text" label="Full Name" v-model="value.full_name"
                            placeholder="Enter Referral Full Name." validation="required" />
                        <FormKit type="text" label="Organization Name" v-model="value.company"
                            placeholder="Enter Referral Organization Name." validation="required" />
                        <FormKit type="tel" label="Phone Number" v-model="value.phone"
                            placeholder="Enter Referral Phone Number." validation="required" />
                        <FormKit type="email" label="Email" v-model="value.email"
                            placeholder="Enter Referral Email Address." validation="required" />
                        <!-- <FormKit type="textarea" label="Summary" placeholder="Enter your Professional Summary."
                        validation="required" /> -->
                        <template #stepNext>
                            <FormKit type="submit" @click.prevent="createResume" />
                        </template>
                    </FormKit>
                </FormKit>
            </FormKit>
        </div>
    </template>
    </Base>
</template>

<style lang="scss" scoped></style>