<template>
    <div class="h-full px-20 flex justify-evenly items-center">
        <img class="rounded-3xl" src="../assets/entry-guitar.webp" alt="Entry guitar picture">

        <form @submit.prevent="handleFormLogin" id="login-form" class="flex flex-col justify-center items-center gap-y-3">
            <FieldForm :name="'email'" :typeInput="'email'" :isRequired="true" @captureInput="handleNewInput" />
            <FieldForm :name="'password'" :typeInput="'password'" @captureInput="handleNewInput" />
            <button type="submit" class="px-12 py-1 bg-orange-600 text-lg text-white font-semibold">Enviar</button>
            <span>________________</span>
            <NuxtLink to="/register" class="font-semibold text-xl">Registrate acá</NuxtLink>
        </form>
    </div>
</template>

<script>
export default {
    name: 'LoginPage',
}
</script>

<script setup>

//METHODS
const handleFormLogin = async () => { 
    console.log(fields.value);
    const emptyFields = searchEmptyFields()

    if( emptyFields.length > 0 ){
        alert(`Los siguientes campos estan vacios, rellenalos por favor: \n ${emptyFields}`)
        return
    }

    // const { data, pending, error, refresh } = await useFetch(`http://127.0.0.1:8000/api/login`, { method: 'POST', body: fields.value })
    // console.log(data, error);
}

// COMPOSABLES
const { fields, handleNewInput, searchEmptyFields } = useFieldForm()

</script>

<style scoped></style>