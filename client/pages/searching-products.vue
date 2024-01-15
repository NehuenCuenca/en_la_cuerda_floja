<template>
    <div class="min-h-full px-5 py-10 grid grid-cols-4 grid-rows-[auto_repeat(3,minmax(0,_1fr)] gap-3 ">
        <h1 class="col-span-full row-span-1 self-start px-4 py-2 bg-beigeStrong text-2xl font-semibold">Resultados de la
            busqueda de
            ‘{{ productName }}’:</h1>

        <form @submit.prevent class="p-4 col-span-1 row-span-4 bg-beigeStrong flex flex-col gap-3">
            <h1 class="text-2xl font-semibold place-self-center">Filtros</h1>
            <ProductsFiltersList :filterTag="'category'" :filterTitle="'Categoria'" :filters="staticFilters.category"
                @updateFilters="handleUpdateFilters" />

            <ProductsFiltersList :filterTag="'brand'" :filterTitle="'Marca'" :filters="staticFilters.brand"
                @updateFilters="handleUpdateFilters" />
        </form>

        <h1 v-if="loadingProducts" class="col-span-3 row-span-3 text-xl font-semibold">Filtrando productos...</h1>
        <template v-else>
            <h1 v-if="haveNoneFilters || haveNoneProductsFiltered" class="col-span-3 row-span-3 text-xl font-semibold">No hay productos de acuerdo a esos filtros 😵</h1>
            <GridProductsList v-else :products="filteredProducts" class="col-span-3 row-span-3" />
        </template>

        <ul v-if="lastPage > 0 && !haveNoneProductsFiltered" class="px-3 col-span-1 row-span-1 bg-gray-600 h-10 w-min flex gap-4 items-center self-end">
            <li v-for="(page, indexPage) in lastPage" :key="indexPage" :class="(page === currentPage) ? 'bg-gray-400':''" class="h-full text-center text-xl font-semibold hover:bg-gray-400 transition-colors">
                <button class="h-full px-3" @click="handleProductsListPage">{{page}}</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { useCallsApi } from '~/composables/useCallsAPI';

useHead({
  title: 'Buscando productos | En la cuerda floja',
})

// COMPOSABLES
const route = useRoute()
const router = useRouter()
const { getCollection } = useCallsApi()

// STATE
const filters = ref({
    ...router.currentRoute.value.query,
})

const staticFilters = ref({
    category: [],
    state: []
})

const filteredProducts = ref([])
const loadingProducts  = ref(true)
const currentPage = ref(Number(route.query.page) || 1)
const lastPage = ref(0)

// LIFECYCLE HOOKS
onMounted(async() => {
    filteredProducts.value = await getFilteredProducts()
    staticFilters.value.category = await getCollection('categories')
    staticFilters.value.brand = await getCollection('brands')
})


// COMPUTED
const productName = computed(() => route.query.productToSearch || '')
const haveNoneFilters = computed(() => Object.keys(route.query).length === 0 )
const haveNoneProductsFiltered = computed(() => filteredProducts.value.length === 0 )


// WATCHERS
watch(router.currentRoute, async(newRoute, oldRoute) => {
    filters.value = {
        ...newRoute.query,
    }
    
    filteredProducts.value = await getFilteredProducts()
})

// METHODS
const getFilteredProducts = async() => { 
    const urlAPIProducts = `http://127.0.0.1:8000/api/products/filter`
    const { data, pending, error } = await useFetch(urlAPIProducts, {
        query: {
            ...filters.value
        }
    })
    console.log(data.value);
    loadingProducts.value = pending.value
    
    if( error.value ){
        console.log('Error al traer las productos filtrados: ', error.value.message);
        return []
    }

    if( !data.value ){
        return getFilteredProducts(); 
    }
    
    currentPage.value = data.value.products.current_page
    lastPage.value = data.value.products.last_page
    return data.value.products.data
}

const handleUpdateFilters = (newFilter) => {
    // update filters
    filters.value = {
        ...filters.value,
        ...newFilter,
        page: 1,
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
        pageValue = lastPage.value
    }

    currentPage.value = pageValue

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