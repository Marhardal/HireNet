<template>
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <slot name="header"></slot>
        </div>
        <div class="col-span-1">
            <slot name="navigation"></slot>
        </div>
        <div class="col-span-11 bg-blue-200 rounded-md my-4 mx-4">
            <slot name="main"></slot>
        </div>
        <div class="col-span-12">
            <slot name="other"></slot>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped></style>