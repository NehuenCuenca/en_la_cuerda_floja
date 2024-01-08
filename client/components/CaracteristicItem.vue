<template>
    <li class="flex flex-col justify-center items-center gap-y-2">
        <i class="text-5xl not-italic">{{ props.caracteristicInfo.icon }}</i>
        <h3 class="text-xl font-bold">{{ props.caracteristicInfo.title }}</h3>
        <p class="font-semibold text-gray-700">{{ props.caracteristicInfo.shortText }}</p>
    </li>
</template>

<script setup>
// PROPS
const props = defineProps({
    caracteristicInfo: Object
})
</script>

<style scoped>

</style>