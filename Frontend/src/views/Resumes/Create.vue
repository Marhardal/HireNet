<script setup>
import { useAuthStore } from '@/Stores/Auth';
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import { onMounted, ref, reactive } from 'vue';
import axios from "axios";

const authStore = useAuthStore();

const duties = ref([]);

const skills = ref([]);

const certificates = ref([]);

const jobs = ref([]);

onMounted(async () => {
    await authStore.getUser(),
        getJobs(),
        getSkills(),
        getDuties(),
        getCertificates(),
        getDuties()
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

const getDuties = async () => {
    const response = await axios.get('http://127.0.0.1:8000/api/duties', {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    duties.value = response.data.duties.map((duty) => ({ value: duty.id, label: duty.name }));
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

const values = reactive({});

const createResume = async () => {
    axios.post('http://127.0.0.1:8000/api/resume', values, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    }).then((response) => {
        toast.success(response.data);
        router.push('/vacancies');
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
            <div class="max-w-2xl mx-auto">
                <FormKit type="form" :actions="false">
                    <FormKit type="multi-step" tab-style="tab" v-if="authStore.authUser">
                        <FormKit type="step" name="resume">
                            <FormKit type="text" disabled label="First Name" :value="authStore.authUser.first_name" />
                            <FormKit type="text" disabled label="Surname" :value="authStore.authUser.surname" />
                            <FormKit type="textarea" label="Summary" placeholder="Enter your Professional Summary."
                            validation="required" />
                        </FormKit>
                        <FormKit type="step" name="skills">
                            <FormKit type="select" multiple label="Skills" :options="skills"
                            placeholder="Select the skills which you have." validation="required" />
                        </FormKit>
                        <FormKit type="step" name="Experience">
                            <FormKit type="select" label="Jobs" :options="jobs" placeholder="Select Job Title."
                            validation="required" />
                            <FormKit type="text" label="Organisation Name" placeholder="Enter an Organisation Name" validation="required"/>
                            <FormKit type="month" label="Start Date" placeholder="Enter the school name you attended."
                                validation="required" />
                            <FormKit type="month" label="Finish Date" placeholder="Enter the school name you attended."
                                validation="required" />
                            <FormKit type="select" multiple label="Duties" :options="duties"
                                placeholder="Select the duties you performed on the job." validation="required" />
                        </FormKit>
                        <FormKit type="step" name="education">
                            <FormKit type="select" label="Education" :options="certificates" validation="required" />
                            <FormKit type="text" label="School Name" placeholder="Enter the school name you attended."
                                validation="required" />
                            <FormKit type="month" label="Start Date" placeholder="Enter the school name you attended."
                                validation="required" />
                            <FormKit type="month" label="Finish Date" placeholder="Enter the school name you attended."
                                validation="required" />
                        </FormKit>
                        <FormKit type="step" name="referrals">
                            <FormKit type="text" label="First Name" placeholder="Enter Referral First Name."
                                validation="required" />
                            <FormKit type="text" label="Surname" placeholder="Enter Referral Surname."
                                validation="required" />
                            <FormKit type="text" label="Organization Name" placeholder="Enter Referral Organization Name."
                                validation="required" />
                            <FormKit type="tel" label="Phone Number" placeholder="Enter Referral Phone Number."
                                validation="required" />
                            <FormKit type="email" label="Email" placeholder="Enter Referral Email Address."
                                validation="required" />
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