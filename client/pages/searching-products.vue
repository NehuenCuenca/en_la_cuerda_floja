<template>
    <div class="min-h-full px-5 py-10 grid grid-cols-4 grid-rows-[auto_repeat(3,minmax(0,_1fr)] gap-3 ">
        <h1 class="col-span-full row-span-1 self-start px-4 py-2 bg-beigeStrong text-2xl font-semibold">Resultados de la busqueda de ‘{{ productName }}’: </h1>

        <form @submit.prevent class="p-4 col-span-1 row-span-4 bg-beigeStrong flex flex-col gap-3">
            <h3 v-if="isLoadingFilters" class="text-lg font-semibold">Cargando filtros...</h3>
            <template v-else>
                <h1 class="text-2xl font-semibold place-self-center">Filtros</h1>
                <ProductsFiltersList :filterTag="'category'" :filterTitle="'Categoria'" :filters="staticFilters.category"
                @updateFilters="handleUpdateFilters" />
                
                <ProductsFiltersList :filterTag="'brand'" :filterTitle="'Marca'" :filters="staticFilters.brand"
                @updateFilters="handleUpdateFilters" />
            </template>
        </form>

        <h1 v-if="isLoadingProducts" class="col-span-3 row-span-3 text-xl font-semibold">Filtrando productos...</h1>
        <template v-else>
            <h1 v-if="!isApplyingFilters || !haveProductsFiltered" class="col-span-3 row-span-3 text-xl font-semibold">No hay productos de acuerdo a esos filtros 😵</h1>
            <GridProductsList v-else :products="filteredProducts" :containerClassStyles="['justify-start', 'items-start']" class="col-span-3 row-span-3" />
        </template>

        <ul v-if="lastPage > 0 && haveProductsFiltered" class="px-3 col-span-1 row-span-1 bg-gray-600 h-10 w-min flex gap-4 items-center self-end">
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
const { getDataFromAPI: getProducts, isLoading: isLoadingProducts, gotError:gotErrorFetchingProducts } = useCallsApi()
const { getDataFromAPI: getFilters, isLoading: isLoadingFilters, gotError:gotErrorFetchingFilters }  = useCallsApi()


// STATE
const filters = ref({
    ...router.currentRoute.value.query,
})

const staticFilters = ref({
    category: [],
    state: []
})

const filteredProducts = ref([])
const paginateBy  = ref(9)
const currentPage = ref(Number(route.query.page) || 1)
const lastPage = ref(0)

// LIFECYCLE HOOKS
onMounted( async() => {
    await tryGetProducts()
    await tryGetFilters()
})


// COMPUTED
const productName = computed(() => route.query.productToSearch || '')
const isApplyingFilters = computed(() => Object.keys(router.currentRoute.value.query).length > 0 )
const haveProductsFiltered = computed(() => filteredProducts.value.length > 0 )


// WATCHERS
watch(router.currentRoute, async(newRoute, oldRoute) => {
    filters.value = {
        ...newRoute.query,
    }
    
    await tryGetProducts()
})

// METHODS
const tryGetProducts = async() => { 
    const response = await getProducts({ endpoint: 'products/filter', querySearchParams: { ...filters.value, paginateBy: paginateBy.value } })

    if( gotErrorFetchingProducts([response]) ){
        const error = response;
        console.error(error.message);
        filteredProducts.value = []
        currentPage.value = 0
        lastPage.value = 0
    } else { 
        const { data: products, current_page, last_page } = response
        filteredProducts.value = products
        currentPage.value = current_page
        lastPage.value = last_page
    }
}

const tryGetFilters = async() => { 
    const responses = await Promise.all([
        await getFilters({ endpoint: 'categories' }),
        await getFilters({ endpoint: 'brands' })
    ])

    if( gotErrorFetchingFilters(responses) ){
        const errors = responses;
        errors.forEach(error => {
            console.error(error.message);
        });

        staticFilters.value.category = []
        staticFilters.value.brand = []
    } else { 
        const [categoriesResponse, brandsResponse] = responses
        staticFilters.value.category = categoriesResponse.data
        staticFilters.value.brand = brandsResponse.data
    }
 }

const handleUpdateFilters = (newFilter) => {
    // console.info('handleUpdateFilters: added a new filter')
    // update filters
    filters.value = {
        ...filters.value,
        ...newFilter,
        page: 1,
    }

    // update the url
    navigateTo({
        path: `/searching-products`,
        query: {
            ...route.query,
            ...filters.value
        }
    })
}

const handleProductsListPage = (e) => {
    // console.info('handleProductsListPage: changed to another page from the pagination')
    let pageValue = Number(e.target.textContent)

    if (isNaN(pageValue)) {
        pageValue = lastPage.value
    }

    currentPage.value = pageValue

    navigateTo({
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