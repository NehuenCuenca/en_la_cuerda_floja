<template>
    <div>
        <Carousel />
        <hr>
        <div class="bg-beigeStrong p-10">
            <GridProductsList :quantityItems="8" />
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
            <GridProductsList :title-list="'Otros productos interesantisimos!'" :quantityItems="8" />
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
})

// COMPOSABLES
const { getUserInfo } = useAuthUser()
</script>

<style scoped></style>