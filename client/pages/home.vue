<template>
    <div>
        <Carousel />
        <hr>
        <GridProductsList :quantityItems="8" />
        <hr>
        <div class="bg-beige text-black min-h-[50vh] py-10 flex flex-col items-center justify-center gap-6">
            <GridBrandsList />
        </div>
        <hr>
        <Carousel />
        <hr>
        <ul class="min-h-[30vh] px-36 py-10 flex justify-between items-center">
            <CaracteristicItem v-for="(caracteristic, indexCaracteristic) in caracteristics" :key="indexCaracteristic"
                :caracteristicInfo="caracteristic" />
        </ul>
        <hr>
        <GridProductsList :title-list="'Otros productos interesantisimos!'" :quantityItems="8" />
        <hr>
    </div>
</template>

<script setup>
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