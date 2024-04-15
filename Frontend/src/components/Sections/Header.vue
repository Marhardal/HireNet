<template>
    <!-- component -->

    <div class="max-w-screen flex items-center justify-center px-5 pt-5">
        <div class="w-full max-w-full">
            <div class="px-7 bg-blue-500 rounded-md text-white">
                <div class="flex">
                    <div class="flex-1 group">
                        <div
                            class="flex items-start justify-start text-left my-3 w-full text-Black">
                            <h3 class="text-xl font-bold ">TecHR</h3>
                        </div>
                    </div>
                    <div class="flex-1 group">
                        <a href="#"
                            class="flex items-center justify-center text-center my-3 w-full">
                            <h3 class="text-md font-semibold">{{ title }}</h3>
                        </a>
                    </div>
                    <div class="flex-1 group pt-2" v-if="authStore.authUser">
                        <div class="flex items-right justify-end">
                            <ProfileCMB :name="authStore.authUser.first_name +' '+ authStore.authUser.surname"/>
                        </div>
                    </div>
                    <div class="flex-1 group pt-2" v-else>
                        <div class="flex items-right justify-end">
                            <RouterLink to="sign-in">Sign-in</RouterLink>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
    import { onMounted } from "vue";
import { useAuthStore } from "../../Stores/Auth";
import ProfileCMB from "../Forms/ProfileCMB.vue";
    const authStore = useAuthStore();
    defineProps({
        title: {
            type: String,
            required: true,
        }
    });

    onMounted(async () => {
        authStore.getUser()
    });
</script>

<style lang="scss" scoped></style>