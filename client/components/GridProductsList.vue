<template>
    <div class="px-10 py-5 flex flex-col justify-center items-center">
        <h1 v-if="props.titleList" class="text-3xl underline underline-offset-4 text-center">{{ titleList }}</h1>
        <ul class="w-full flex py-10 flex-wrap justify-around gap-4">
            <GridProductItem v-for="(product, i) in props.quantityItems" :key="i"/>
        </ul>
    </div>
</template>

<script setup>
// PROPS
const props = defineProps({
    titleList: String,
    quantityItems: Number
})
</script>

<style scoped></style>