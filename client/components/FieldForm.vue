<template>
    <div class="flex flex-col py-3">
        <label :for="NameLabelAtribb" class="text-lg font-semibold cursor-pointer">{{name}}: </label>
        <input :type="typeInput" :id="NameLabelAtribb" :name="name" />
    </div>
</template>

<script setup>
const props = defineProps({
    name: String,
    typeInput: String,
})

// Computed
const NameLabelAtribb = computed(() => 'label-'+props.name)
</script>

<style scoped></style>