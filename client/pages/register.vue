<template>
    <div class="h-full px-20 flex justify-evenly items-center">
        <img class="rounded-3xl" src="../assets/entry-guitar.webp" alt="Entry guitar picture">

        <form id="register-form" class="flex flex-col justify-center gap-y-3">
            <FieldForm :name="'Full Name'" :typeInput="'text'" :isRequired="true"/>
            <FieldForm :name="'Email'" :typeInput="'email'" :isRequired="true"/>
            <FieldForm :name="'Password'" :typeInput="'password'" :isRequired="true"/>
            <button type="submit" class="px-8 py-1 bg-orange-600 text-lg text-white font-semibold">Enviar</button>
            <hr>
            <NuxtLink to="/login" class="font-semibold text-xl">¿Ya tenés una cuenta? Incia sesión</NuxtLink>
        </form>
    </div>
</template>

<script>
export default {
    name: 'RegisterPage',
}
</script>

<script setup>

</script>

<style scoped></style>