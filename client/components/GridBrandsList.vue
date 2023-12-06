<template>
    <h1 class="font-semibold text-3xl">Nuestras marcas</h1>
    <ul class="grid items-center justify-center grid-cols-10 gap-5">
        <GridBrandItem v-for="(brand, i) in 10" :key="i" :indexItem="i+1"/>
    </ul>
</template>

<script setup>

</script>

<style scoped></style>