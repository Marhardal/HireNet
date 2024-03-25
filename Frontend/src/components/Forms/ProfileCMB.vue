<template>
    <div class="w-56 text-right relative">
      <Menu as="div" class="relative inline-block text-left">
        <div>
          <MenuButton
            class="inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-medium text-black hover:bg-blue-200 hover:text-black focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
          >
            {{ name }}
            <ChevronDownIcon
              class="-mr-1 ml-2 h-5 w-5 text-blue-500 hover:text-violet-100"
              aria-hidden="true"
            />
          </MenuButton>
        </div>
  
        <transition
          enter-active-class="transition duration-100 ease-out"
          enter-from-class="transform scale-95 opacity-0"
          enter-to-class="transform scale-100 opacity-100"
          leave-active-class="transition duration-75 ease-in"
          leave-from-class="transform scale-100 opacity-100"
          leave-to-class="transform scale-95 opacity-0"
        >
          <MenuItems
            class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-blue-200 shadow-lg ring-1 ring-black/5 focus:outline-none" >
            <div class="px-1 py-1">
              <MenuItem v-slot="{ active }">
                <RouterLink to="/settings"
                  :class="[
                    active ? 'bg-blue-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-base',
                  ]"
                >
                  <UserCircleIcon
                    :active="active"
                    class="mr-2 h-5 w-5"
                    aria-hidden="true"
                  />
                  Profile
                </RouterLink>
              </MenuItem>
              <MenuItem v-slot="{ active }">
                <button type="submit" @click="authStore.Logout"
                  :class="[
                    active ? 'bg-blue-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-base',
                  ]"
                >
                  <ArrowLeftStartOnRectangleIcon
                    :active="active"
                    class="mr-2 h-5 w-5"
                    aria-hidden="true"
                  />
                  Logout
                </button>
              </MenuItem>
            </div>
            <!-- <div class="px-1 py-1">
               <MenuItem v-slot="{ active }">
                <button
                  :class="[
                    active ? 'bg-violet-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                  ]"
                >
                  <ArchiveIcon
                    :active="active"
                    class="mr-2 h-5 w-5 text-violet-400"
                    aria-hidden="true"
                  />
                  Archive
                </button>
              </MenuItem> -->
              <!-- <MenuItem v-slot="{ active }">
                <button
                  :class="[
                    active ? 'bg-violet-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                  ]"
                >
                  <MoveIcon
                    :active="active"
                    class="mr-2 h-5 w-5 text-violet-400"
                    aria-hidden="true"
                  />
                  Move
                </button>
              </MenuItem> 
            </div> -->
  
            <!-- <div class="px-1 py-1">
              <MenuItem v-slot="{ active }">
                <button
                  :class="[
                    active ? 'bg-violet-500 text-white' : 'text-gray-900',
                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                  ]"
                >
                  <DeleteIcon
                    :active="active"
                    class="mr-2 h-5 w-5 text-violet-400"
                    aria-hidden="true"
                  />
                  Delete
                </button>
              </MenuItem>
            </div> -->
          </MenuItems>
        </transition>
      </Menu>
    </div>
  </template>
  
  <script setup>
  import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
  import { ChevronDownIcon, UserCircleIcon, ArrowLeftStartOnRectangleIcon } from '@heroicons/vue/20/solid'
  import { useAuthStore } from "../../Stores/Auth";
//   import ArchiveIcon from './archive-icon.vue'
//   import DuplicateIcon from './duplicate-icon.vue'
//   import MoveIcon from './move-icon.vue'
//   import EditIcon from './edit-icon.vue'
//   import DeleteIcon from './delete-icon.vue'

const authStore = useAuthStore();

defineProps({
    name:{
        type: String,
        required: true,
        default: ""
    }
})
  </script>
  