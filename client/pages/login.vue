<template>
    <div class="h-full px-20 flex justify-evenly items-center">
        <img class="rounded-3xl" src="../assets/entry-guitar.webp" alt="Entry guitar picture">

        <form @submit.prevent="handleFormLogin" id="login-form" class="flex flex-col justify-center items-center gap-y-3">
            <FieldForm :name="'email'" :typeInput="'email'" :isRequired="true" @captureInput="handleNewInput" />
            <FieldForm :name="'password'" :typeInput="'password'" @captureInput="handleNewInput" />
            <button type="submit" class="px-12 py-1 bg-orange-600 text-lg text-white font-semibold">Enviar</button>
            <div v-if="haveErrorsFromBackend" class="w-full p-2 border rounded-md border-red-700 text-red-700 bg-red-200">
                <h3 class="underline">{{ messageFromBackend }}</h3>
                <p v-for="error in errorsFromBackend">{{ error }}</p>
            </div>
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

const handleFormLogin = async () => {
    // Basic validation if some fields are empty
    const emptyFields = searchEmptyFields()
    if (emptyFields.length > 0) {
        alert(`Los siguientes campos estan vacios, rellenalos por favor: \n ${emptyFields}`)
        return
    }

    logginUser(fields.value)
}

// COMPOSABLES
const { fields, handleNewInput, searchEmptyFields } = useFieldForm()
const { logginUser, haveErrorsFromBackend, messageFromBackend, errorsFromBackend, } = useAuthUser()


</script>

<style scoped></style>