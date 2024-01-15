export function useCallsApi() {
    
    // METHODS
    const getCollection = async (collectionName) => {
        const collectionAPIEndpoint = `http://127.0.0.1:8000/api/${collectionName}`
        const { data, error } = await useFetch(collectionAPIEndpoint)
    
        if (error.value) {
            console.log(`Error al traer la coleccion ${collectionName}: `, error.value.message);
            return []
        }
    
        if (!data.value) {
            return getCollection(collectionName);
        }
        
        return data.value.data
    }

    return { getCollection }
}

