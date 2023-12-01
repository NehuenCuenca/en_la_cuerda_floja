<template>
    <div class="h-full px-20 flex justify-evenly items-center">
        <img class="rounded-3xl" src="../assets/entry-guitar.webp" alt="Entry guitar picture">

        <form @submit.prevent="handleFormLogin" id="login-form" class="flex flex-col justify-center items-center gap-y-3">
            <FieldForm :name="'Email'" :typeInput="'email'" :isRequired="true"/>
            <FieldForm :name="'Password'" :typeInput="'password'"/>
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
    const handleFormLogin = () => { 
        console.log('The form is submitted');
    }
</script>

<style scoped></style>