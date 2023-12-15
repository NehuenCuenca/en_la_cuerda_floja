<template>
    <div class="py-10 px-16 grid grid-cols-2 grid-rows-[repeat(4,minmax(0,_auto)] gap-4">
        <img class="row-span-3 col-span-1 h-80 rounded-sm object-cover shadow-xl" src="https://picsum.photos/id/133/1024/350" alt="picsum photo">
        <h1 class="col-start-2 font-semibold text-3xl">Nombre de producto</h1>
        <h3 class="col-start-2 font-semibold text-3xl">$99.99</h3>
        <div class="col-start-2 w-2/6 rounded-xl shadow-md h-fit p-3 flex justify-around items-center bg-beigeStrong">
            <button class="rounded-sm bg-gray-300 px-2 text-lg font-medium">-</button>
            <span class="text-xl font-bold">0</span>
            <button class="rounded-sm bg-gray-300 px-2 text-lg font-medium">+</button>
        </div>
        <div>
            <h3 class="mb-3 underline font-medium text-gray-600 text-xl">Description</h3>
            <p class="font-medium">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat saepe sint recusandae. Optio blanditiis ullam ea cum, et dignissimos aperiam sapiente autem obcaecati voluptatum eligendi, aliquam unde velit repellendus eveniet!</p>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>

</style>