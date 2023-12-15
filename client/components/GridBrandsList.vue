<template>
    <h1 class="font-semibold text-3xl">Nuestras marcas</h1>
    <!-- <ul class="grid items-center justify-center grid-cols-10 gap-5">
        <GridBrandItem v-for="(brand, i) in 10" :key="i" :indexItem="i+1"/>
    </ul> 
    <-- I dont know why this doestn work as below 😐-->
    <ul class="grid items-center justify-center grid-cols-10 gap-5">
        <li class="row-start-1 col-start-1 bg-greyCard py-10 px-4 rounded">Brand 1</li>
        <li class="row-start-2 col-start-2 bg-greyCard py-10 px-4 rounded">Brand 2</li>
        <li class="row-start-1 col-start-3 bg-greyCard py-10 px-4 rounded">Brand 3</li>
        <li class="row-start-2 col-start-4 bg-greyCard py-10 px-4 rounded">Brand 4</li>
        <li class="row-start-1 col-start-5 bg-greyCard py-10 px-4 rounded">Brand 5</li>
        <li class="row-start-2 col-start-6 bg-greyCard py-10 px-4 rounded">Brand 6</li>
        <li class="row-start-1 col-start-7 bg-greyCard py-10 px-4 rounded">Brand 7</li>
        <li class="row-start-2 col-start-8 bg-greyCard py-10 px-4 rounded">Brand 8</li>
        <li class="row-start-1 col-start-9 bg-greyCard py-10 px-4 rounded">Brand 9</li>
        <li class="row-start-2 col-start-10 bg-greyCard py-10 px-4 rounded">Brand 10</li>
    </ul>
</template>

<script setup>

</script>

<style scoped></style>