<template>
    <div class="p-9 flex flex-col gap-y-8 justify-start items-center">
        <h3 class="text-4xl font-semibold">Marcas</h3>
        <h1 v-if="loadingBrands" class="text-xl font-normal">Cargando... ⌛</h1>
        <ul v-else class="flex justify-around items-start gap-8 flex-wrap">
            <li v-for="({name}, i) in brands" :key="i" class="p-2.5 border-none rounded-tr-lg rounded-bl-lg text-brown-200 text-lg font-semibold bg-brown-900 hover:bg-brown-400 hover:text-brown-900 cursor-pointer transition-colors">{{ name }}</li>
        </ul>
    </div>
</template>

<script setup>
useHead({
  title: 'Marcas | En la cuerda floja',
})

// STATE
const brands = ref([])
const loadingBrands = ref(true)


// LIFECYCLE HOOKS
onMounted( async() => {
    brands.value = await getBrands()
})

// METHODS
 const getBrands = async() => { 
    const urlAPIBrands = `http://127.0.0.1:8000/api/brands`
    const { data, pending, error } = await useFetch(urlAPIBrands)
    loadingBrands.value = pending.value

    if( error.value ){
        console.log('Error al traer las marcas: ', error.value.message);
        return []
    }

    if( !data.value ){
        return getBrands(); 
    }
    
    return data.value.data
}

</script>

<style scoped>

</style>