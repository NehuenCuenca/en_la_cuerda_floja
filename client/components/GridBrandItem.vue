<template>
    <li :class="rowStart + ' ' + colStart" class="bg-white py-10 px-4 rounded">Brand {{ props.indexItem }}</li>
</template>

<script setup>
// PROPS
const props = defineProps({
    indexItem: Number,
    brandItem: Object
})

// COMPUTED
const rowStart = computed(() => {
    const isEven = props.indexItem % 2 === 0
    return (isEven)
        ? `row-start-2`
        : `row-start-1`
})
const colStart = computed(() => `col-start-${props.indexItem}`)
</script>

<style scoped></style>