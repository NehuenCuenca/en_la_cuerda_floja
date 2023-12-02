<template>
    <div>
        <h1>This is the home</h1>
    </div>
</template>

<script setup>
const token = ref('')

onMounted(async() => {
    token.value = localStorage.getItem('en_la_cuerda_floja_token')
    console.log(token.value);
    await getUserInfo()
})

const getUserInfo = async() => { 
    const { data, pending, error, status } = await useFetch(`http://127.0.0.1:8000/api/verify-token`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token.value}`,
            'Accept': 'application/json',
            'withCredentials': 'true',
        },
    })
    // store the user info
    console.log(data.value);
 }
</script>

<style scoped>

</style>