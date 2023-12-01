export function useFieldForm() {
    // STATE
    const fields = ref({})

    // METHODS
    const handleNewInput = (newInput) => {
        fields.value = { ...fields.value, ...newInput}
    }

    const searchEmptyFields = () => { 
        let emptys = []

        for (let [key, value] of Object.entries(fields.value)) {
            if(value.trim().length === 0){
                emptys = [...emptys, key]
            }
        }
        
        return emptys
    }

    return { fields, handleNewInput, searchEmptyFields }
}

