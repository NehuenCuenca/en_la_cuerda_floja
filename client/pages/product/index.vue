<template>
    <div v-if="loadingProduct" class="h-full py-10 px-16 flex justify-center">
        <h1 class="text-xl">Tratando de obtener los datos del producto '{{ nameProductFromUrl }}'...</h1>
    </div>
    <div v-else class="py-10 px-16 grid grid-cols-2 text-brown-900 grid-rows-[repeat(4,minmax(0,_auto)] gap-4">
        <img class="row-span-3 col-span-1 h-80 rounded-sm object-cover shadow-gray-800 shadow-xl"
            src="https://picsum.photos/id/133/1024/350" alt="picsum photo">
        <h1 class="col-start-2 font-semibold text-3xl">{{product.name}}</h1>
        <h3 class="col-start-2 font-semibold text-3xl">${{product.price_cost}}</h3>
        <form @submit.prevent="handleSubmit" class="col-start-2 w-2/6 flex flex-col gap-y-4">
            <div class="rounded-xl shadow-md h-fit p-3 flex justify-around items-center bg-beigeStrong">
                <button type="button" @click="handleQuantity('remove')" class="rounded-sm bg-gray-300 px-2 text-lg font-medium">-</button>
                <input type="number" readonly name="quantity" v-model.number="quantityOrdered" class="w-7 text-center text-xl font-bold bg-transparent [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                <button type="button" @click="handleQuantity('add')" class="rounded-sm bg-gray-300 px-2 text-lg font-medium">+</button>
            </div>
            <button :disabled="quantityNoSpecified" type="submit"
                class="transition-colors p-2 rounded-md disabled:bg-gray-400 border-brown-900 bg-beigeStrong text-lg font-semibold shadow-md">Agregar
                al carrito</button>
        </form>

        <div>
            <h3 class="mb-3 underline font-medium text-gray-600 text-xl">Description</h3>
            <p class="font-medium">{{product.description}}</p>
        </div>
    </div>
</template>

<script setup>
// STORE
import { useCartStore } from '@/stores/CartStore'
const store = useCartStore()

// STATE
const quantityOrdered = ref(0)
const product = ref({})
const loadingProduct = ref(true)

// COMPUTED
const quantityNoSpecified = computed(() => quantityOrdered.value === 0)
const nameProductFromUrl = computed(() => route.query.name)

// COMPOSABLES
const route = useRoute()

// LIFECYCLE HOOKS
onMounted( async() => {
    const {id, name} = route.query
    product.value = await getProduct(id)
    // console.log(product.value);
})

// METHODS
const getProduct = async (id) => {
    const urlAPI = `http://127.0.0.1:8000/api/product/${id}`
    const { data, pending, error } = await useFetch(urlAPI)
    loadingProduct.value = pending.value

    if( error.value ){
        console.log('Error al traer el producto: ', error.value.message);
        return {}
    }

    if( !data.value ){
        return getProduct(id) ; 
    }
    
    return data.value.product
}

const handleSubmit = (e) => {
    if(quantityNoSpecified.value) {
        return
    }
    
    store.addToCart({
        ...product.value,
        quantity: quantityOrdered.value,
    })
}

const handleQuantity = (action) => {
    switch (action) {
        case 'add':
            quantityOrdered.value++;
            break;
        case 'remove':
            if (quantityOrdered.value > 0)
                quantityOrdered.value--;
            break;
    }
}

</script>

<style scoped></style>