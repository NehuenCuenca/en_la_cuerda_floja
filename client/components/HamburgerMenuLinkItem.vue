<template>
    <li>
        <NuxtLink :to="linkItem.route" class="text-lg underline" @click="linkItem.fn">{{linkItem.title}}</NuxtLink>
    </li>
</template>

<script setup>
const props = defineProps({
    linkItem: Object
})
</script>

<style scoped></style>