<script setup>
import Header from '@/components/Sections/Header.vue';
import Base from '../Base.vue';
import Applicant from '@/components/Cards/Applicant.vue';
import { shallowRef, ref } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
import Shortlisted from "@/components/Shortlist/Shortlist.vue";
import Declined from "@/components/Shortlist/Declined.vue";
import All from "@/components/Shortlist/All.vue";
import TabButton from '@/components/Sections/TabButton.vue';

const Tabs = shallowRef([
    {label: 'All', component: All},
    {label: 'Shortlist', component: Shortlisted},
    {label: 'Declined', component: Declined},
])

const currentTab = shallowRef(0);

const TabChange = (index)=>{
    currentTab.value = index;
}

const Applicants = shallowRef([]);

const id = useRoute().params.id;

onMounted(async => {
    getApplicants(id)
})

const authToken = localStorage.getItem('authToken');

const getApplicants = async (id) => {
    const response = await axios.get(`http://127.0.0.1:8000/api/shortlist/${id}`, {
        headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${authToken}`
        }
    });
    Applicants.value = response.data.applicants;
    console.log(Applicants.value);
}

// 174114
</script>
<template>
    <Base>
        <template v-slot:header>
            <Header title="Shortlisted Applicants"/>
        </template>
        <template v-slot:other>
            <div class="flex justify-center bg-gradient-to-t h-full bg-no-repeat bg-center w-full mx-auto">
                <!-- <div class="w-full md:w-1/2 lg:w-full">
                    <Applicant v-for="Applicant in Applicants" :applicant="Applicant" :postId="Applicant.pivot.post_id"/>
                </div> -->
                <div class="">
                <div class="border-b border-white dark:border-gray-700 mx-4">
                    <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                        <!-- <TabButton -->
                        <TabButton v-for="(tab, index) in Tabs" :name="tab.label"
                            @click="TabChange(index)" />
                    </nav>
                </div>

                <div class="mt-3 mx-4">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <component :is="Tabs[currentTab].component"></component>
                    </div>
                </div>
            </div>
            </div>
        </template>
    </Base>
</template>


<style lang="scss" scoped>

</style>