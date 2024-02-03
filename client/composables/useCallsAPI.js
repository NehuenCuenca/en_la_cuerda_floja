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
                    console.error(`${error.message} | Retry on ${retryDelay/1_000} seconds`);
                },
                retryStatusCodes: [ 500, 502, 503, 504 ], 
                retry,
                retryDelay
            })
            
            isLoading.value = false;
            return response
        } catch (error) {
            isLoading.value = false;
            const messageFromBackend = (error.data) 
                                    ? error.data.message 
                                    : `Error when trying to request data from endpoint ${endpoint} after several attempts... Server not available`

            return new Error(`${error.name} | ${error.message} | ${messageFromBackend}`)
        }
    }

    const gotError = (responses) => responses.some( response => response instanceof Error )

    return { isLoading, getDataFromAPI, gotError }
}

