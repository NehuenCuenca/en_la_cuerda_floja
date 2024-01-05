<template>
    <div>
        <Carousel />
        <hr>
        <div class="bg-beigeStrong p-10">
            <h2 v-if="productsList1.length === 0" class="text-center font-semibold text-lg underline underline-offset-4">No ha sido posible solicitar los productos ☹</h2>
            <GridProductsList v-else :products="productsList1" />
        </div>
        <hr>
        <div class="bg-beige text-black py-10 flex flex-col items-center justify-center gap-6">
            <GridBrandsList />
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
            <h2 v-if="productsList2.length === 0" class="text-center font-semibold text-lg underline underline-offset-4">No ha sido posible solicitar los productos ☹</h2>
            <GridProductsList v-else :products="productsList2" :title-list="'Otros productos interesantisimos!'" />
        </div>
        <hr>
    </div>
</template>

<script setup>
useHead({
  title: 'Principal | En la cuerda floja',
})

// STATE
const token = ref('')
const productsList1 = ref([])
const productsList2 = ref([])

// DOM state
const caracteristics = ref([
    { icon: '😎', title: 'Caracteristic title..', },
    { icon: '😋', title: 'Caracteristic title..', },
    { icon: '😍', title: 'Caracteristic title..', },
])

// LIFECYCLE HOOKS
onMounted(async () => {
    token.value = localStorage.getItem('en_la_cuerda_floja_token')
    await getUserInfo(token.value)
    productsList1.value = await getProducts()
    productsList2.value = await getProducts(8, 2)
})

const getProducts = async (paginateBy = 8, page = 1) => {
    const urlAPI = 'http://127.0.0.1:8000/api/products'
    const { data, pending, error, refresh } = await useFetch(urlAPI, {
        query: {
            page,
            paginateBy,
        }
    })

    if( error.value ){
        console.log('Error al traer los productos: ', error.value.message);
        return []
    }
    
    return data.value.data
}

// COMPOSABLES
const { getUserInfo } = useAuthUser()
</script>

<style scoped></style>