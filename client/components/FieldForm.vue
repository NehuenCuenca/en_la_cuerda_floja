<template>
    <div class="flex flex-col py-1">
        <label :for="nameLabelAtribb" class="text-lg font-semibold cursor-pointer underline">{{ name }}: </label>
        <input v-model="inputContent" :type="typeInput" :id="nameLabelAtribb" :required="isRequired" :name="name"
            class="py-1 px-2 rounded-md" @change="handleChange" />
        <span v-if="emptyAlert && isRequired" class="text-red-600">This field is empty!</span>
    </div>
</template>

<script setup>
// PROPS
const props = defineProps({
    name: String,
    typeInput: String,
    isRequired: Boolean,
})

// STATE
const inputContent = ref('')
const emptyAlert = ref(false)

// COMPUTED
const nameLabelAtribb = computed(() => 'label-' + props.name)
const isInputEmpty = computed(() => inputContent.value.length === 0)

// METHODS
const toggleEmptyAlert = () => {
    emptyAlert.value = isInputEmpty.value
}

const emits = defineEmits(['captureInput'])

const handleChange = () => { 
    toggleEmptyAlert()
    emits('captureInput', {[props.name]: inputContent.value })   
}
</script>

<style scoped></style>