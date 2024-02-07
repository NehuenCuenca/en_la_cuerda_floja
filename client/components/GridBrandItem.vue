<template>
    <li class="h-20 bg-greyCard rounded " :class=" rowStart + ' ' + colStart "
    :style="{ backgroundImage: parsedUrlImage }">
        <NuxtLink class="w-full h-full grid place-items-center"
            :to=" { name: 'searching-products', query: { brand: brandItem.name } } ">{{ brandItem.name }}</NuxtLink>
    </li>
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
const parsedUrlImage = computed(() => `url(${props.brandItem.background_image})`)
</script>

<style scoped></style>