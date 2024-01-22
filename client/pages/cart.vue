<template>
    <div class="p-10 flex flex-col w-full justify-center items-center gap-5">
        <div v-if="store.allProducts.length > 0" class="w-full flex flex-col justify-center items-center gap-5">
            <div class="table_cart" role="region" tabindex="0">
                <table>
                    <caption class="font-semibold text-3xl underline mb-5 ">Mi carrito</caption>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <CartTableRow v-for="(product, indexProduct) in store.allProducts" :product-item="product"
                            :key="indexProduct" />
                    </tbody>
                </table>
            </div>
            <form @submit.prevent="handleSubmit" class="flex flex-col w-1/4">
                <button type="submit" class="px-5 py-2 text-2xl text-center bg-emerald-700 text-white border-none ">Realizar
                    compra</button>
                <NuxtLink to="/"
                    class="px-5 py-2 text-2xl text-center bg-white text-gray-600 border-2 border-text-gray-600 ">
                    Buscar mas articulos</NuxtLink>
            </form>
        </div>
        <div class="flex flex-col items-center gap-4" v-else>
            <i class="text-6xl not-italic">😶</i>
            <h1 class="text-2xl font-semibold">¡No tienes productos en tu carrito!</h1>
            <p>Buscalo por nombre con la <span class="font-medium text-gray-50">caja de arriba</span> o <NuxtLink to="/"
                    class="font-medium underline">chusmea la pagina principal</NuxtLink>
            </p>
        </div>
    </div>
</template>

<script setup>
useHead({
    title: 'Mi carrito | En la cuerda floja',
})

// STORE
import { useCartStore } from '@/stores/CartStore'
const store = useCartStore()

// METHODS
const handleSubmit = async () => {
    await store.generateOrder()
}
</script>

<style >
.table_cart {
    overflow: auto;
    width: 100%;
}

.table_cart table {
    height: 100%;
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    border-spacing: 1px;
    text-align: left;
}

.table_cart caption {
    caption-side: top;
    text-align: left;
}

.table_cart tr {
    border-top: 1px solid #E1E1E1;
    border-bottom: 1px solid #E1E1E1;
}

.table_cart th {
    background-color: #eceff1;
}

.table_cart td {
    background-color: #ffffff;
}

.table_cart :is(th, td) {
    color: #000000;
    padding: 5px 15px;
}

.table_cart tr :is(th, td):nth-child(n+3) {
    text-align: center;
}

.table_cart tr :is(th, td):nth-child(5) {
    width: 10%;
}
</style>