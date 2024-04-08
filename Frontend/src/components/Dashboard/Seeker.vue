<template>
    <div class="col-span-2 mt-2 mx-5">
        <div class="grid grid-cols-3 gap-2">
          <div class="col-span-1 w-full h-30 bg-white rounded-md">
            <div class=" py-4 px-2 ">
              <div class="flex flex-auto mb-4">
                <div class="border-r-black border-r-2">
                  <div class="py-2 px-2 w-10 h-10 overflow-hidden rounded-full bg-blue-300 mr-2">
                    <Icon icon="fluent:briefcase-person-24-filled" width="25" class="fill-white" />
                    <!-- <Icon icon="mdi:briefcase-check"  /> -->
                  </div>
                </div>
                <div class="flex-auto justify-center items-center">
                  <h3 class="font-semibold text- py-2 pl-2">Applied Vacancies</h3>
                </div>
              </div>
              <h3 class="font-bold text-base pb-2 pl-2">{{ dashboard.vacancies + " Applied | " + dashboard.shortlisted +
                " Shortlisting." }}</h3>
              <div class="flex items-center py-3">
                <span class="w-8 h-8 shrink-0 mr-4 rounded-full bg-blue-50 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                    <path d="M7 21l3 -4"></path>
                    <path d="M16 21l-2 -4l-3 -3l1 -6"></path>
                    <path d="M6 12l2 -3l4 -1l3 3l3 1"></path>
                  </svg>
                </span>
                <div class="space-y-3 flex-1">
                  <div class="flex items-center">
                    <h4 class="font-medium text-sm mr-auto text-gray-700 flex items-center">
                      Walkability
                      <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 shrink-0 w-5 h-5 text-gray-500" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                      </svg>
                    </h4>
                    <span class="px-2 py-1 rounded-lg bg-red-50 text-red-500 text-xs">
                      6.2 / 10
                    </span>
                  </div>
                  <div class="overflow-hidden bg-blue-50 h-1.5 rounded-full w-full">
                    <span class="h-full bg-blue-500 w-full block rounded-full" style="width: 62%"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-1 w-full h-30 bg-white rounded-md">
            <div class=" py-4 px-2 ">

              <h3 class="font-semibold text-base pb-2 pl-2">{{ dashboard.vacancies }}</h3>
            </div>
          </div>
          <div class="col-span-1 w-full h-30 bg-white rounded-md">
            <div class="col-span-1 w-full h-30 bg-white rounded-md">
              <div class=" py-4 px-2 ">
                <div class="flex flex-auto mb-4">
                  <div class="border-r-black border-r-2">
                    <div class="py-2 px-2 w-10 h-10 overflow-hidden rounded-full bg-blue-300 mr-2">
                      <!-- <Icon icon="fluent:briefcase-person-24-filled" width="25" class="fill-white" /> -->
                      <Icon icon="mingcute:bookmark-fill"  width="25" class="fill-white"/>
                      <!-- <Icon icon="mdi:briefcase-check"  /> -->
                    </div>
                  </div>
                  <div class="flex-auto justify-center items-center">
                    <h3 class="font-semibold text- py-2 pl-2">Bookmarked Vacancies</h3>
                  </div>
                </div>
                <h3 class="font-bold text-base pb-2 pl-2">{{ dashboard.bookmarks + " Vacancies Bookmarked." }}</h3>
                <div class="flex items-center py-3">
                  <span class="w-8 h-8 shrink-0 mr-4 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" width="24" height="24"
                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                      stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M13 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                      <path d="M7 21l3 -4"></path>
                      <path d="M16 21l-2 -4l-3 -3l1 -6"></path>
                      <path d="M6 12l2 -3l4 -1l3 3l3 1"></path>
                    </svg>
                  </span>
                  <div class="space-y-3 flex-1">
                    <div class="flex items-center">
                      <h4 class="font-medium text-sm mr-auto text-gray-700 flex items-center">
                        Walkability
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 shrink-0 w-5 h-5 text-gray-500" width="24"
                          height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                          <path d="M12 9h.01"></path>
                          <path d="M11 12h1v4h1"></path>
                        </svg>
                      </h4>
                      <span class="px-2 py-1 rounded-lg bg-red-50 text-red-500 text-xs">
                        6.2 / 10
                      </span>
                    </div>
                    <div class="overflow-hidden bg-blue-50 h-1.5 rounded-full w-full">
                      <span class="h-full bg-blue-500 w-full block rounded-full" style="width: 62%"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-1 ml-5 my-2 w-md max-h-30 bg-white rounded-md">
        <div class=" py-4 px-2 ">
          <h3 class="font-semibold text-base pb-2 pl-2">Vacancy Chart</h3>
          <div class="flex justify-center">
            <Pie :first="dashboard.shortlisted" :second="dashboard.pending" :third="dashboard.declined" />
          </div>
        </div>
      </div>
      <div class="col-span-1 my-2 mr-5 rounded-md bg-white">
        <div class="w-full py-4 px-2 ">
          <h3 class="font-semibold text-base pb-2 pl-2">Vacancy Notifications</h3>
          <Notification v-for="(notification, index) in notifications" :key="index" :value="notification" :class="bg-blue-200"/>
        </div>
      </div><div>

    </div>
</template>

<script setup>
import Pie from '@/components/Dashboard/pie.vue';
import { Icon } from '@iconify/vue';
import Notification from '../Cards/Notification.vue';

defineProps({
    dashboard: {
        type: Object,
        required: true,
        default: {}
    },
    notifications: {
      type: Object,
      required: true,
      default: {}
    }
})

</script>

<style lang="scss" scoped>

</style>