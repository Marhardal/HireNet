<template>
    <Base>
    <template v-slot:header>
        <Header title="Settings" />
    </template>

    <template v-slot:navigation>
        <Navigation />
    </template>

    <template v-slot:main>
        <div class="" v-if="authStore.authUser">
            <div class="" v-if="authStore.authRole.name == 'Recruiter'">
                <div class="border-b border-white dark:border-gray-700 mx-4">
                    <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                        <TabButton v-for="(tab, index) in RecruiterTabs" :name="tab.label"
                            @click="RecruiterChange(index)" />
                    </nav>
                </div>

                <div class="mt-3 mx-4">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <component :is="RecruiterTabs[RecruiterCurrentTab].component"></component>
                    </div>
                </div>
            </div>
            <div class="" v-if="authStore.authRole.name == 'Seeker'">
                <div class="border-b border-white dark:border-gray-700 mx-4">
                    <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                        <TabButton v-for="(tab, index) in SeekerTabs" :name="tab.label"
                            @click="SeekerChange(index)" />
                    </nav>
                </div>

                <div class="mt-3 mx-4">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <component :is="SeekerTabs[SeekerCurrentTab].component"></component>
                    </div>
                </div>
            </div>
            <div class="" v-if="authStore.authRole.name == 'Admin'">
                <div class="border-b border-white dark:border-gray-700 mx-4">
                    <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                        <TabButton v-for="(tab, index) in AdminTabs" :name="tab.label"
                            @click="AdminChange(index)" />
                    </nav>
                </div>

                <div class="mt-3 mx-4">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <component :is="AdminTabs[AdminCurrentTab].component"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>
    </Base>
</template>

<script setup>
import Header from "@/components/Sections/Header.vue";
import Navigation from "@/components/Sections/Navigation.vue";
import TabButton from "@/components/Sections/TabButton.vue";
import Account from "@/components/Settings/Account.vue";
import Applied from "@/components/Settings/Applied.vue";
import Bookmark from "@/components/Settings/Bookmark.vue";
import Shortlist from "@/components/Settings/Shortlist.vue";
import { shallowRef } from "vue";
import Base from "./Base.vue";
import Organisation from "@/components/Settings/Organisation.vue";
import Subscription from "@/components/Settings/Subscription.vue";
import { onMounted } from "vue";
import { useAuthStore } from "@/Stores/Auth";


const authStore = useAuthStore();

onMounted(async => {
    authStore.getUser()
});

const pages = shallowRef([]);

const RecruiterTabs = shallowRef([
    { label: 'Account', component: Account },
    { label: 'Organization', component: Organisation },
    { label: 'subscription', component: Subscription },
]);

const SeekerTabs = shallowRef([
    { label: 'Account', component: Account },
    { label: 'subscription', component: Subscription },
    { label: 'Bookmark', component: Bookmark },
    // { label: 'Applied', component: Applied },
    { label: 'Shortlist', component: Shortlist },
]);

const AdminTabs = shallowRef([
    { label: 'Account', component: Account },
    { label: 'subscription', component: Subscription },
]);

const RecruiterCurrentTab = shallowRef(0);

const SeekerCurrentTab = shallowRef(0);

const AdminCurrentTab = shallowRef(0);

const RecruiterChange = (index) => {
    RecruiterCurrentTab.value = index;
}

const SeekerChange = (index) => {
    SeekerCurrentTab.value = index;
}

const AdminChange = (index) => {
    AdminCurrentTab.value = index;
}

</script>

<style lang="scss" scoped></style>