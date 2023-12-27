<template>
    <div class="p-5 w-full">
        <h1 class="text-3xl font-bold">¡Hola usuario!</h1>
        <h3 class="text-xl font-semibold text-gray-700">Aqui se encuentran tus datos personales: </h3>
        <ul class="w-2/5 mt-4 bg-gray-400 flex flex-col gap-4 p-4 rounded-lg">
            <li class="bg-yellow-200 p-1.5 rounded-md cursor-pointer">
                <NuxtLink :to="{ name: 'maintenance'}">
                    <h2 class="font-semibold text-lg">Informacion personal 👤</h2>
                    <h4 class="font-medium text-gray-700">Info de tu documento y actividad fiscal</h4>
                </NuxtLink>
            </li>
            <li class="bg-yellow-200 p-1.5 rounded-md cursor-pointer">
                <NuxtLink :to="{ name: 'maintenance'}">
                    <h2 class="font-semibold text-lg">Datos de la cuenta 📜</h2>
                    <h4 class="font-medium text-gray-700">Datos registrados en ‘En la cuerda floja’</h4>
                </NuxtLink>
            </li>
            <li class="bg-yellow-200 p-1.5 rounded-md cursor-pointer">
                <NuxtLink :to="{ name: 'maintenance'}">
                    <h2 class="font-semibold text-lg">Mis compras 🗄</h2>
                    <h4 class="font-medium text-gray-700">Historial de todas tus compras</h4>
                </NuxtLink>
            </li>
        </ul>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped></style>