<template>
    <!-- component -->

    <div class="max-w-screen flex items-center justify-center px-5 pt-5">
        <div class="w-full max-w-full">
            <div class="px-7 bg-blue-500 rounded-md text-white">
                <div class="flex">
                    <div class="flex-1 group">
                        <div
                            class="flex items-start justify-start text-left my-3 w-full text-Black">
                            <h3 class="text-xl font-bold ">HN</h3>
                        </div>
                    </div>
                    <div class="flex-1 group">
                        <a href="#"
                            class="flex items-center justify-center text-center my-3 w-full">
                            <h3 class="text-md font-semibold">{{ title }}</h3>
                        </a>
                    </div>
                    <!-- group-hover:text-indigo-500
group-hover:text-indigo-500 -->
                    <div class="flex-1 group">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
    defineProps({
        title: {
            type: String,
            required: true,
        }
    })
</script>

<style lang="scss" scoped></style>