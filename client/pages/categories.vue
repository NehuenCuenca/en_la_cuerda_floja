<template>
    <div class="bg-beigeStrong py-40 flex flex-col gap-y-8 justify-start items-center">
        <h3 class="text-4xl font-semibold">Categorias</h3>
        <ul class="flex justify-around items-start gap-8 flex-wrap">
            <li v-for="(category, i) in 4" :key="i" class=" p-2.5 border-none rounded-tr-lg rounded-bl-lg text-brown-200 text-lg font-semibold bg-brown-900 hover:bg-brown-400 hover:text-brown-900 cursor-pointer transition-colors">Categoria {{ i }}</li>
        </ul>
    </div>
</template>

<script setup>

</script>

<style scoped>

</style>