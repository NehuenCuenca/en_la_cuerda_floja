<template>
    <li class="flex flex-col justify-center items-center gap-2">
        <i class="text-4xl not-italic">{{props.caracteristicInfo.icon }}</i>
        <h3 class="text-xl font-bold">{{ props.caracteristicInfo.title }}</h3>
        <p>Little text...</p>
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