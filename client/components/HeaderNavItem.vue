<template>
    <li >
        <button class="text-2xl" @click="navItem.fn">{{navItem.emoji}}</button>
    </li>
</template>

<script setup>
const props = defineProps({
    navItem: Object
})
</script>

<style scoped>

</style>