<template>
    <div class="flex flex-col">
        <h3 class="underline font-semibold">{{ props.filterTitle }}</h3>
        <ul>
            <ProductsFiltersItem 
            v-for="(filter, indexFilter) in filters" 
            :filterItem="filter"
            :filterTag="props.filterTag" 
            :key="indexFilter"
            @toggleFilter="handleToggleFilter"
            />
        </ul>
    </div>
</template>

<script setup>
// PROPS
const props = defineProps({
    filterTag: String,
    filterTitle: String,
    filters: Array,
})

// EMITS
const emits = defineEmits(['updateFilters'])

// METHODS
const handleToggleFilter = (filterName) => { 
    emits('updateFilters', { [props.filterTag]: filterName })
}
</script>

<style scoped></style>