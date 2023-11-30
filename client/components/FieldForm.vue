<template>
    <div class="flex flex-col py-3">
        <label :for="NameLabelAtribb" class="text-lg font-semibold cursor-pointer underline">{{name}}: </label>
        <input :type="typeInput" :id="NameLabelAtribb" :name="name" class="py-1 rounded-md" />
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