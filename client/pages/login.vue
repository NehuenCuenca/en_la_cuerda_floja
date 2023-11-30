<template>
    <div class="bg-yellow-300 h-screen">
        <AppHeader class="h-1/6"/>
        <div class="h-4/5 px-20 flex justify-evenly items-center">
            <img class="rounded-3xl" src="../assets/entry-guitar.webp" alt="Entry guitar picture">
            
            <form id="login-form" class="flex flex-col justify-center gap-y-3">
                <FieldForm :name="'Email'" :typeInput="'email'"/>
                <FieldForm :name="'Password'" :typeInput="'password'"/>
                <button type="submit" class="px-8 py-1 bg-orange-600 text-lg text-white font-semibold">Enviar</button>
                <hr>
                <NuxtLink to="/register" class="font-semibold text-xl">¿Ya tenés una cuenta? Incia sesión</NuxtLink>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginPage',
}
</script>

<script setup>

</script>

<style scoped></style>