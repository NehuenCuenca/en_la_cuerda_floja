<template>
    <li class="w-60 bg-gray-300 rounded-lg ">
        <NuxtLink :to="linkToProduct" class="flex flex-col px-4 py-4 gap-y-2">
            <img src="https://picsum.photos/id/133/240/150" alt="" class="rounded-md shadow-gray-400 shadow-md">
            <span class="font-semibold">${{props.price}}</span>
            <span class="font-semibold">{{nameWithEllipsis}}</span>
        </NuxtLink>
    </li>
</template>

<script setup>
// PROPS
const props = defineProps({
    name: String,
    price: Number
})

// COMPUTED
const linkToProduct = computed(() => {
    const unifiedName = props.name.split(' ').join('-').toLowerCase()
    return `/product/${unifiedName}`
})
const nameWithEllipsis = computed(() => {
    return  (props.name.length > 20)
            ? props.name.slice(0,20).trimEnd()+'...'
            : props.name
})
</script>

<style scoped>

</style>