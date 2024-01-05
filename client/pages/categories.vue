<template>
    <div class="bg-beigeStrong min-h-[70vh] p-9 flex flex-col gap-y-8 justify-start items-center">
        <h3 class="text-4xl font-semibold">Categorias</h3>
        <h1 v-if="loadingCategories" class="text-xl font-normal">Cargando... ⌛</h1>
        <ul v-else class="flex justify-around items-start gap-8 flex-wrap">
            <li v-for="({ name }, i) in categories" :key="i">
                <NuxtLink :to="{ name: 'searching-products', query: { category: name } }"
                    class="p-2.5 border-none rounded-tr-lg rounded-bl-lg text-brown-200 text-lg font-semibold bg-brown-900 hover:bg-brown-400 hover:text-brown-900 cursor-pointer transition-colors">
                    {{ name }}</NuxtLink>
            </li>
        </ul>
    </div>
</template>

<script setup>
useHead({
    title: 'Categorias | En la cuerda floja',
})

// STATE
const categories = ref([])
const loadingCategories = ref(true)

// LIFECYCLE HOOKS
onMounted(async () => {
    categories.value = await getCategories()
})

// METHODS
const getCategories = async () => {
    const urlAPICategories = `http://127.0.0.1:8000/api/categories`
    const { data, pending, error } = await useFetch(urlAPICategories)
    loadingCategories.value = pending.value

    if (error.value) {
        console.log('Error al traer las categorias: ', error.value.message);
        return []
    }

    if (!data.value) {
        return getCategories();
    }

    return data.value.data
}
</script>

<style scoped></style>