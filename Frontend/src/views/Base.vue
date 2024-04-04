<template>
    <div class="grid grid-cols-12">
        <div class="col-start-1 col-end-13">
            <slot name="header"></slot>
        </div>
        <div class="col-span-1">
            <slot name="navigation"></slot>
        </div>
        <div class="col-span-11 bg-blue-200 rounded-md my-4 mx-4 max-h-full">
            <slot name="main"></slot>
        </div>
        <div class="col-span-12 rounded-md my-4 mx-4 mt-0 ">
            <slot name="other"></slot>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped></style>