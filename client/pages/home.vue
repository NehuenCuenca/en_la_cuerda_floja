<template>
    <div>
        <h1>This is the home</h1>
        <Carousel />
    </div>
</template>

<script setup>
// STATE
const token = ref('')

// LIFECYCLE HOOKS
onMounted(async() => {
    token.value = localStorage.getItem('en_la_cuerda_floja_token')
    await getUserInfo(token.value)
})

// COMPOSABLES
const { getUserInfo } = useAuthUser()
</script>

<style scoped>

</style>