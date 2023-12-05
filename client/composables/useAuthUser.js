
export function useAuthUser() {
    // STATE
    const haveErrorsFromBackend = ref(false);
    const messageFromBackend = ref("");
    const errorsFromBackend = ref([]);

    // METHODS
    const logginUser = async (credentials) => {
        cleanErrorState()

        // Get the csrf cookie
        await useFetch(`http://127.0.0.1:8000/sanctum/csrf-cookie`);

        // Get the token
        const { data, pending, error, status } = await useFetch(
            `http://127.0.0.1:8000/api/login`,
            {
                method: "POST",
                body: credentials,
                headers: {
                    Accept: "application/json",
                    withCredentials: "true",
                },
            }
        );

        // If got error, then, show error sign, and map all the errors
        if (error.value) {
            handleErrorsFromBackend({ error, status })
            return
        }

        // If got no error, then, set the token and navigate to home page
        const { message, token } = data.value;
        alert(message);
        localStorage.setItem("en_la_cuerda_floja_token", token);

        router.push({ name: 'home' })
    };

    const registerUser = async (credentials) => {
        cleanErrorState();

        // Get the csrf cookie
        await useFetch(`http://127.0.0.1:8000/sanctum/csrf-cookie`);

        // Send the user info for register
        const { data, pending, error, status } = await useFetch(
            `http://127.0.0.1:8000/api/register`,
            {
                method: "POST",
                body: credentials,
                headers: {
                    Accept: "application/json",
                    withCredentials: "true",
                },
            }
        );

        // If got error, then, show error sign, and map all the errors
        if (error.value) {
            handleErrorsFromBackend({ error, status });
            return
        }

        // If got no error, then, navigate to login page
        const { message } = data.value;
        alert(message);

        router.push({ name: 'login' })
    };

    const getUserInfo = async(token) => { 
        const { data, pending, error, status } = await useFetch(`http://127.0.0.1:8000/api/verify-token`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token.value}`,
                'Accept': 'application/json',
                'withCredentials': 'true',
            },
        })
        
        // store the user info in pinia or vuex
        console.log(data.value);
    }

    const cleanErrorState = () => { 
        haveErrorsFromBackend.value = false;
        messageFromBackend.value = "";
        errorsFromBackend.value = [];
    }

    const handleErrorsFromBackend = ({ error, status }) => {
        status.value === "error"
            ? (haveErrorsFromBackend.value = true)
            : (haveErrorsFromBackend.value = false);

        const { data: { message, errors }, } = error.value;
        const formatedErrors = Object.entries(errors).map(
            ([field, acumulatedErrors]) => `✖ ${field}: ${acumulatedErrors}`
        );

        messageFromBackend.value = `${message}`;
        errorsFromBackend.value  = formatedErrors;
    }

    // OTHER COMPOSABLES
    const router = useRouter()

    return {
        logginUser,
        registerUser,
        getUserInfo,
        haveErrorsFromBackend,
        messageFromBackend,
        errorsFromBackend,
    };
}
