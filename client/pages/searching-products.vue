<template>
    <div class="min-h-full px-5 py-10 grid grid-cols-4 grid-rows-[auto_repeat(3,minmax(0,_1fr)] gap-3 ">
        <h1 class="col-span-full row-span-1 self-start px-4 py-2 bg-beigeStrong text-2xl font-semibold">Resultados de la
            busqueda de
            ‘{{ productName }}’:</h1>

        <form @submit.prevent class="p-4 col-span-1 row-span-4 bg-beigeStrong flex flex-col gap-3">
            <h1 class="text-2xl font-semibold place-self-center">Filtros</h1>
            <ProductsFiltersList :filterTag="'category'" :filterTitle="'Categoria'" :filters="staticFilters.category"
                @updateFilters="handleUpdateFilters" />

            <ProductsFiltersList :filterTag="'state'" :filterTitle="'Estado'" :filters="staticFilters.state"
                @updateFilters="handleUpdateFilters" />
        </form>

        <GridProductsList :quantityItems="9" class="col-span-3 row-span-3" />

        <ul class="px-3 col-span-1 row-span-1 bg-gray-600 h-10 w-min flex gap-4 items-center">
            <li class="h-full text-center text-xl font-semibold hover:bg-gray-400 transition-colors">
                <button class="h-full px-3" @click="handleProductsListPage">1</button>
            </li>
            <li class="h-full text-center text-xl font-semibold hover:bg-gray-400 transition-colors">
                <button class="h-full px-3" @click="handleProductsListPage">2</button>
            </li>
            <li class="h-full text-center text-xl font-semibold hover:bg-gray-400 transition-colors">
                <button class="h-full px-3" @click="handleProductsListPage">3</button>
            </li>
            <li class="h-full text-center text-xl font-semibold hover:bg-gray-400 transition-colors">
                <button class="h-full px-3" @click="handleProductsListPage">...</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
useHead({
  title: 'Buscando productos | En la cuerda floja',
})

// COMPOSABLES
const route = useRoute()
const router = useRouter()

// STATE
const filters = ref({
    ...route.query,
})

const staticFilters = ref({
    category: [
        { name: 'Categoria 1' },
        { name: 'Categoria 2' },
        { name: 'Categoria 3' },
    ],
    state: [
        { name: 'Nuevo' },
        { name: 'Usado' },
    ]
})

// COMPUTED
const productName = computed(() => route.query.productToSearch)

// WATCHERS
watch(router.currentRoute, (newRoute, oldRoute) => {
    filters.value = {
        ...newRoute.query,
        page: 1,
    }
})

// METHODS
const handleUpdateFilters = (newFilter) => {
    // update filters
    filters.value = {
        ...filters.value,
        ...newFilter
    }

    // update the url
    router.push({
        path: `/searching-products`,
        query: {
            ...route.query,
            ...filters.value
        }
    })
}

const handleProductsListPage = (e) => {
    let pageValue = Number(e.target.textContent)
    if (isNaN(pageValue)) {
        console.log('last page');
        pageValue = 100 //When backend has pagination change this harcoded value to last page
    }

    router.push({
        path: `/searching-products`,
        query: {
            ...route.query,
            ...filters.value,
            page: pageValue
        }
    })
}
</script>

<style scoped></style>