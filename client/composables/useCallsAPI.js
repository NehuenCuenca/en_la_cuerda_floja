export function useCallsApi() {
    const getCollection = async (collectionName) => {
        try {
            const retry = 5
            const retryDelay = 10_000 // ms
            const response = await $fetch(`/api/${collectionName}`, {
                baseURL: 'http://127.0.0.1:8000',
                method: 'GET',
                async onRequestError({ request, options, error }) {
                    console.error(`${error.message} | Reintentando de nuevo en ${retryDelay/1_000} segundos`);
                },
                retryStatusCodes: [ 500, 502, 503, 504 ], 
                retry,
                retryDelay
            })
            
            return response.data
        } catch (error) {
            console.error(`${error.message} | Error al tratar de solicitar la coleccion ${collectionName} despues de varios intentos...`);
            return []
        }
    }


    return { getCollection }
}

