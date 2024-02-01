export function useCallsApi() {
    const isLoading = ref(true);

    const getDataFromAPI = async (fetchSettings) => {
        const { endpoint, querySearchParams } = fetchSettings

        try {
            isLoading.value = true;
            const retry = 3
            const retryDelay = 10_000 // ms

            const response = await $fetch(`/${endpoint}`, {
                method: 'GET',
                baseURL: 'http://127.0.0.1:8000/api',
                query: querySearchParams,
                async onRequestError({ request, options, error }) {
                    console.error(`${error.message} | Reintentando de nuevo en ${retryDelay/1_000} segundos`);
                },
                retryStatusCodes: [ 500, 502, 503, 504 ], 
                retry,
                retryDelay
            })
            
            isLoading.value = false;
            return response
        } catch (error) {
            isLoading.value = false;
            console.error(`${error.message} | Error al tratar de solicitar la data del endpoint ${endpoint} despues de varios intentos...`);
            return { data: [], last_page: 0, current_page: 0 }
        }
    }


    return { isLoading, getDataFromAPI }
}

