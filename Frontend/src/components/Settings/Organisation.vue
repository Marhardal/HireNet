<template>
    <div class="grid grid-cols-2 max-w-md mx-auto justify-center">
        <div class="col-span-2">
            <FormKit type="form" submit-label="Update" @submit="updateOrganization" v-if="authStore.authUser.role">
                <FormKit type="text" placeholder="Enter Organisation Name." v-model="values.name" label="Organisation Name"
                    validation="required" />
                <FormKit type="text" label="Location" placeholder="Enter Organisation Location." v-model="values.location"
                    validation="required"/>
                <FormKit type="textarea" label="About" validation="required" v-model="values.about"
                    placeholder="Enter Organisation About."/>
            </FormKit>
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/Stores/Auth';
import axios from 'axios';
import { shallowReactive } from 'vue';
import { onMounted, shallowRef } from 'vue';
import { useToast } from 'vue-toastification';

const authStore = useAuthStore();

const authToken = localStorage.getItem('authToken');

const toast = useToast();

const values = shallowReactive({
    'id' : authStore.authUser.organisation.id,
    'name' :  authStore.authUser.organisation.name, 
    'location' : authStore.authUser.organisation.location,
    'about' :  authStore.authUser.organisation.about
});

onMounted(async => {
    authStore.getUser()
})

const updateOrganization = async () => {
    await axios.put(`http://127.0.0.1:8000/api/organisation/${values.id}`, values, {
        headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${authToken}`
            }
    }).then((response) => {
        toast.success("You have applied to a vacancy successfully.");
    }).catch((error) => {
        toast.error("Encountered an error while applying.");
    });;
        // console.log(values.id);
}

</script>

<style lang="scss" scoped></style>