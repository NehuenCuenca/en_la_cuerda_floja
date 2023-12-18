<template>
    <div class="min-h-full px-5 py-10 grid grid-cols-4 grid-rows-[auto_repeat(3,minmax(0,_1fr)] gap-3 ">
        <h1 class="col-span-full row-span-1 self-start px-4 py-2 bg-beigeStrong text-2xl font-semibold">Resultados de la
            busqueda de
            ‘{{ productName }}’:</h1>

        <form @submit.prevent class="p-4 col-span-1 row-span-4 bg-beigeStrong flex flex-col gap-3">
            <h1 class="text-2xl font-semibold place-self-center">Filtros</h1>
            <div class="flex flex-col">
                <h3 class="underline font-semibold">Categorias</h3>
                <ul>
                    <li class="text-gray-700">
                        <button @click="(e) => setFilter(e, 'category')">Categoria 1</button>
                    </li>
                    <li class="text-gray-700">
                        <button @click="(e) => setFilter(e, 'category')">Categoria 2</button>
                    </li>
                    <li class="text-gray-700">
                        <button @click="(e) => setFilter(e, 'category')">Categoria 3</button>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col">
                <h3 class="underline font-semibold">Estado</h3>
                <ul>
                    <li class="text-gray-700">
                        <button @click="(e) => setFilter(e, 'state')">Nuevo</button>
                    </li>
                    <li class="text-gray-700">
                        <button @click="(e) => setFilter(e, 'state')">Usado</button>
                    </li>
                </ul>
            </div>
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
// COMPOSABLES
const route = useRoute()
const router = useRouter()

// STATE
const filters = ref({
    ...route.query,
})

// COMPUTED
const productName = computed(() => route.query.productToSearch)

// WATCHERS
watch(router.currentRoute, (newRoute, oldRoute) => {
    filters.value = {
        ...newRoute.query,
        page: 1,
    }
    
    const haveExtraFilters = [
        filters.value.hasOwnProperty('category'),
        filters.value.hasOwnProperty('state')
    ].some( filter => filter )
    
    if( !haveExtraFilters ) { unpaintFilters() }
})

// METHODS
const unpaintFilters = () => { 
    const allFiltersLists = document.querySelectorAll('form ul')
    for (let i = 0; i < allFiltersLists.length; i++) {
        const filterList = allFiltersLists[i];
        const filtersButtons = filterList.querySelectorAll('li button.font-semibold')
        if (filtersButtons.length === 0) { break; }
        filtersButtons.forEach( filter => {
            filter.classList.remove('font-semibold') 
        });
    }
 }

const setFilter = (e, nameFilter) => {
    // Removing style classes from previous filter
    const filterList = e.target.parentElement.parentElement
    const previousFilter = filterList.querySelector('li button.font-semibold')
    if (previousFilter) { previousFilter.classList.remove('font-semibold') }
    e.target.classList.add('font-semibold')

    // Updating filters
    const valueFilter = e.target.textContent
    filters.value = {
        ...filters.value,
        [nameFilter]: valueFilter
    }

    // Updating the url
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