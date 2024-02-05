<template>
    <div>
        <Carousel />
        <hr>
        <div class="bg-beigeStrong p-10">
            <h2 v-if="isLoadingProducts" class="text-center font-semibold text-lg underline underline-offset-4">Estamos cargando los productos...</h2>
            <template v-else>
                <h2 v-if="productsList1.length === 0" class="text-center font-semibold text-lg underline underline-offset-4">No ha sido posible solicitar los productos ☹</h2>
                <GridProductsList v-else :products="productsList1" :containerClassStyles="['justify-start', 'items-center']" />
            </template>
        </div>
        <hr>
        <div class="bg-beige text-black py-10 px-5 flex flex-col items-center justify-center gap-6">
            <h2 v-if="isLoadingBrands" class="text-center font-semibold text-lg underline underline-offset-4">Estamos cargando las marcas...</h2>
            <template v-else>
                <h2 v-if="brands.length === 0" class="text-center font-semibold text-lg underline underline-offset-4">No ha sido posible solicitar las marcas ☹</h2>
                <GridBrandsList v-else :brands="brands"/>
            </template>
        </div>
        <hr>
        <Carousel />
        <hr>
        <ul class="px-36 py-10 flex justify-between items-center">
            <CaracteristicItem v-for="(caracteristic, indexCaracteristic) in caracteristics" :key="indexCaracteristic"
                :caracteristicInfo="caracteristic" />
        </ul>
        <hr>
        <div class="bg-beigeStrong p-10">
            <h2 v-if="isLoadingProducts" class="text-center font-semibold text-lg underline underline-offset-4">Estamos cargando los productos...</h2>
            <template v-else>
                <h2 v-if="productsList2.length === 0" class="text-center font-semibold text-lg underline underline-offset-4">No ha sido posible solicitar los productos ☹</h2>
                <GridProductsList v-else :products="productsList2" :containerClassStyles="['justify-start', 'items-center']" />
            </template>
        </div>
        <hr>
    </div>
</template>

<script setup>
useHead({
  title: 'Principal | En la cuerda floja',
})

const token = ref('')
const productsList1 = ref([])
const productsList2 = ref([])
const brands = ref([])


const caracteristics = ref([
    { icon: '🏠', title: 'Checkeá la guitarra', shortText: 'Pasá por el local para probarla' },
    { icon: '🆙', title: 'Hacemos que suene mejor', shortText: 'Calibracion y afinacion antes de la compra' },
    { icon: '👷‍♂️', title: 'Tambien arreglamos', shortText: 'bajos, charangos, y muchos mas' }
])

onMounted(async () => {
    token.value = localStorage.getItem('en_la_cuerda_floja_token')
    await getUserInfo(token.value)

    await tryGetProducts()
    await tryGetBrands()
})

const tryGetProducts = async() => { 
    const responses = await Promise.all([
        await getProducts({ endpoint: 'products', querySearchParams: {paginateBy: 8, page: 1} }),
        await getProducts({ endpoint: 'products', querySearchParams: {paginateBy: 8, page: 2} })
    ])
    
    if( gotErrorFetchingProducts(responses) ){
        const errors = responses;
        errors.forEach(error => {
            console.error(error.message);
        });

        productsList1.value = []
        productsList2.value = []
    } else {
        const [productsList1Response, productsList2Response] = responses
        productsList1.value = productsList1Response.data
        productsList2.value = productsList2Response.data
    }
}

const tryGetBrands = async() => { 
    const response = await getBrands({ endpoint: 'brands' })

    if( gotErrorFetchingBrands([response]) ){
        const error = response;
        console.error(error.message);
        brands.value = []
    } else { 
        const { data: someBrands } = response
        brands.value = someBrands
    }
}

// COMPOSABLES
const { getUserInfo } = useAuthUser()
const { getDataFromAPI: getProducts, isLoading: isLoadingProducts, gotError:gotErrorFetchingProducts } = useCallsApi()
const { getDataFromAPI: getBrands, isLoading: isLoadingBrands, gotError:gotErrorFetchingBrands } = useCallsApi()

</script>

<style scoped></style>