<template>
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <Header title="Settings" />
        </div>
        <div class="col-span-1">
            <Navigation />
        </div>
        <div class="col-span-11">
            <div>
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                        <TabButton v-for="(tab, index) in tabs" :name="tab.label" @click="changeTab(index)"/>
                    </nav>
                </div>

                <div class="mt-3">
                    <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                        <component :is="tabs[currentTab].component"></component>
                    </div>
                </div>
            </div>
            <!-- <component v-bind:is="pages[num]"></component> -->
        </div>

    </div>
</template>

<script setup>
import Header from "@/components/Sections/Header.vue";
import Navigation from "@/components/Sections/Navigation.vue";
import TabButton from "@/components/Sections/TabButton.vue";
import Account from "@/components/Settings/Account.vue";
import Applied from "@/components/Settings/Applied.vue";
import Bookmark from "@/components/Settings/Bookmark.vue";
import Shortlist from "@/components/Settings/Shortlist.vue";
import { ref } from "vue";

const tabs = ref([
    {label: 'Bookmark', component: Bookmark},
    {label: 'Applied', component: Applied},
    {label: 'Shortlist', component: Shortlist},
    {label: 'Account', component: Account},
]);

const currentTab = ref(0);

const changeTab = (index) => {
    currentTab.value = index;
}

</script>

<style lang="scss" scoped></style>