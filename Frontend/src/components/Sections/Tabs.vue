<template>
    <div>
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                
            </nav>
        </div>

        <div class="mt-3">
            <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1">
                <p class="text-gray-500 dark:text-gray-400">
                    This is the <em class="font-semibold text-gray-800 dark:text-gray-200">first</em> item's tab body.
                </p>
            </div>
            <div id="tabs-with-underline-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-underline-item-2">
                <p class="text-gray-500 dark:text-gray-400">
                    This is the <em class="font-semibold text-gray-800 dark:text-gray-200">second</em> item's tab body.
                </p>
            </div>
            <div id="tabs-with-underline-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-underline-item-3">
                <p class="text-gray-500 dark:text-gray-400">
                    This is the <em class="font-semibold text-gray-800 dark:text-gray-200">third</em> item's tab body.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped></style>