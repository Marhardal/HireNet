<template>
    <Base>
    <template v-slot:header>
        <Header title="Settings" />
    </template>
    <template v-slot:navigation>
        <Navigation />
    </template>
    <template v-slot:main>
        <div class="border-b border-white dark:border-gray-700 mx-4">
            <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                <TabButton v-for="(tab, index) in tabs" :name="tab.label" @click="changeTab(index)" />
            </nav>
        </div>

        <div class="mt-3 mx-4">
            <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                <component :is="tabs[currentTab].component"></component>
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

const tabs = shallowRef([
    { label: 'Account', component: Account },
    { label: 'Organization', component: Organisation },
    { label: 'subscription', component: Subscription },
    { label: 'Bookmark', component: Bookmark },
    { label: 'Applied', component: Applied },
    { label: 'Shortlist', component: Shortlist },
]);

// if (authStore.authRole) {
//     if (authStore.authRole.name == 'Recruiter') {
//         tabs = [
//             { label: 'Account', component: Account },
//             { label: 'Organization', component: Organisation },
//             { label: 'subscription', component: Subscription }
//         ]
//     } else if (authStore.authRole.name == 'Admin') {
//         tabs = [
//             { label: 'Account', component: Account },
//         ]
//     } else if (authStore.authRole.name == 'Seeker') {
//         tabs = [
//             { label: 'Bookmark', component: Bookmark },
//             { label: 'Applied', component: Applied },
//             { label: 'Shortlist', component: Shortlist },
//             { label: 'Account', component: Account }
//         ]
//     }
// }

const currentTab = shallowRef(0);

const changeTab = (index) => {
    currentTab.value = index;
}

</script>

<style lang="scss" scoped></style>