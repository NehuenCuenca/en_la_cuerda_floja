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

// STATE
const haveErrorsFromBackend = ref(false)
const messageFromBackend = ref('')
const errorsFromBackend = ref([])

//METHODS

// todo: refactor this fn handleFormLogin
const handleFormLogin = async () => {
    // Basic validation if some fields are empty
    const emptyFields = searchEmptyFields()
    if (emptyFields.length > 0) {
        alert(`Los siguientes campos estan vacios, rellenalos por favor: \n ${emptyFields}`)
        return
    }

    // Get the csrf cookie
    await useFetch(`http://127.0.0.1:8000/sanctum/csrf-cookie`)

    // Get the token
    const { data, pending, error, status } = await useFetch(`http://127.0.0.1:8000/api/login`, {
        method: 'POST',
        body: fields.value,
        headers: {
            'Accept': 'application/json',
            'withCredentials': 'true',
        },
    })

    // Clean the error state
    haveErrorsFromBackend.value = false
    messageFromBackend.value = ''
    errorsFromBackend.value = []

    // If got error, then, show error sign, and map all the errors
    if (error.value) {
        (status.value === 'error')
            ? haveErrorsFromBackend.value = true
            : haveErrorsFromBackend.value = false

        const { data: { message, errors } } = error.value
        const formatedErrors = Object.entries(errors)
            .map(([field, acumulatedErrors]) => `*${field}: ${acumulatedErrors}`)

        messageFromBackend.value = `${message}`;
        errorsFromBackend.value  = formatedErrors;

        return
    }

    // If got no error, then, set the token and navigate to home page
    const { message, token } = data.value
    alert(message)
    localStorage.setItem('en_la_cuerda_floja_token', token)

    router.push({ name: 'home' })
}

// COMPOSABLES
const { fields, handleNewInput, searchEmptyFields } = useFieldForm()
const router = useRouter()

</script>

<style scoped></style>