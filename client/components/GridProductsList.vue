<template>
    <div class="flex flex-col justify-center items-center gap-y-3"  v-if="thereArePoducts">
        <h1 v-if="props.titleList" class="text-3xl underline underline-offset-4 text-center">{{ titleList }}</h1>
        <ul class="w-full flex py-4 flex-wrap justify-around gap-5">
            <GridProductItem v-for="(product, i) in props.products" :key="i" :product_info="product"/>
        </ul>
    </div>

    <div class="flex flex-col justify-center items-center" v-else>
        <h1 v-if="props.titleList" class="text-3xl underline underline-offset-4 text-center"> Por alguna razon no pudimos cargar estos productos... 🔧👩‍💻</h1>
    </div>
</template>

<script setup>
// PROPS
const props = defineProps({
    titleList: String,
    products: Array
})
// COMPUTEDS
const thereArePoducts = computed(() => {
    return props.products.length > 0
})
</script>

<style scoped></style>