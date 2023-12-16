<template>
    <header class="relative w-full h-1/6 bg-beigeDark py-7 px-5 flex justify-between items-center">
        <div id="logo" class="text-beige text-xl font-bold w-40 text-center">
            <NuxtLink to="/">
                En la cuerda floja <i>🎸</i>
            </NuxtLink>
        </div>
        <form id="search-products" class="w-2/4" @submit.prevent="searchProduct">
            <input type="text" placeholder="🔎   Buscar producto..." v-model="productToSearch"
                class="w-full border-none rounded-lg py-2 px-3 outline-none">
        </form>
        <nav class="w-1/6 px-4 border-b-black">
            <ul class="h-full flex justify-between items-center">
                <HeaderNavItem v-for="(navItem, i) in navItems" :key="i" :navItem="navItem" />
            </ul>
        </nav>
        <nav ref="hamburguerMenu"
            class="opacity-0 pointer-events-none fixed top-0 right-0 w-1/3 px-2 h-screen z-50 bg-beigeStrong bg-opacity-95 transition-all">
            <div class="flex flex-col gap-10 py-4">
                <button @click="toggleHamburgerMenu" class="text-white font-semibold text-3xl">X</button>

                <div class="flex flex-col gap-5 justify-center items-center">
                    <h3 class="text-center font-semibold text-xl">Enlaces</h3>
                    <ul class="flex flex-col gap-3 justify-center items-center">
                        <HamburgerMenuLinkItem v-for="(linkItem, j) in hamburguerMenuLinks" :key="j" :linkItem="linkItem" />
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'AppHeader',
}
</script>
<script setup>

// METHODS
const toggleHamburgerMenu = () => {
    hamburguerMenu.value.classList.toggle('opacity-0')
    hamburguerMenu.value.classList.toggle('pointer-events-none')
}

const searchProduct = () => {
    const sanitizedString = productToSearch.value.trim()
    if (sanitizedString.length <= 0) {
        alert('Error: el campo de busqueda de producto esta vacio.')
        return
    }

    router.push({ path: `searching-products`, query: { productToSearch: sanitizedString } })
}

// STATE
const productToSearch = ref('')
const hamburguerMenu = ref(null)

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
        fn: toggleHamburgerMenu
    }
])

const hamburguerMenuLinks = ref([
    {
        title: 'Marcas',
        fn: toggleHamburgerMenu,
        route: '/brands'
    },
    {
        title: 'Categorias',
        fn: toggleHamburgerMenu,
        route: '/categories'
    },
    {
        title: 'Reparaciones',
        fn: toggleHamburgerMenu,
        route: '/'
    },
    {
        title: 'FAQ / Ayuda',
        fn: toggleHamburgerMenu,
        route: '/'
    },
])

// COMPOSABLES
const router = useRouter()

</script>

<style scoped></style>