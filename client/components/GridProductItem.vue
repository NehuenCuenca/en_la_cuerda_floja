<template>
    <li class="w-60 bg-gray-300 rounded-lg ">
        <NuxtLink :to="{ name: 'product', query: { name: props.product_info.name, id: props.product_info.id } }"
            class="flex flex-col px-4 py-4 gap-y-2">
            <img src="https://picsum.photos/id/133/240/150" alt="" class="rounded-md shadow-gray-400 shadow-md">
            <span class="font-semibold">${{ props.product_info.price_cost }}</span>
            <span class="font-semibold">{{ nameWithEllipsis }}</span>
        </NuxtLink>
    </li>
</template>

<script setup>
// PROPS
const props = defineProps({
    product_info: Object,
})

const nameWithEllipsis = computed(() => {
    return (props.product_info.name.length > 20)
        ? props.product_info.name.slice(0, 20).trimEnd() + '...'
        : props.product_info.name
})
</script>

<style scoped></style>