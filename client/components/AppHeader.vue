<template>
    <header class="w-full h-1/6 bg-yellow-600 py-7 px-5 flex justify-between items-center">
        <div id="logo" class="text-yellow-300 text-xl font-bold w-40 text-center">
            En la cuerda floja <i>🎸</i>    
        </div>
        <form id="search-products" class="w-2/4">
            <input type="text" placeholder="🔎   Buscar producto..." class="w-full border-none rounded-lg py-2 px-3 outline-none">
        </form>
        <nav class="w-1/6 px-4 border-b-black">
            <ul class="h-full flex justify-between items-center">
                <HeaderNavItem v-for="navItem in navItems" :navItem="navItem" />
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'AppHeader',
}
</script>
<script setup>
    const navItems = ref([
        {
            emoji: '👤',
            fn: () => console.log('Send user to the route /user')
        },
        {
            emoji: '🛒',
            fn: () => console.log('Open the cart')
        },
        {
            emoji: '🍔',
            fn: () => console.log('Open hamburguer menu')
        }
    ])
</script>

<style scoped></style>