<template>
    <li class="text-gray-700">
        <button @click="handleFilter" :class="filterIsOnUrlQuery">
            {{ props.filterItem.name }}
        </button>
    </li>
</template>

<script setup>
// PROPS
const props = defineProps({
    filterItem: Object,
    filterTag: String,
})

// EMITS
const emits = defineEmits(['toggleFilter'])

// METHODS
const handleFilter = (e) => {
    const filterName = e.target.textContent
    emits('toggleFilter', filterName)
}

// COMPOSABLES
const router = useRouter()

// COMPUTED
const filterIsOnUrlQuery = computed(() => {
    const urlHasStateFilter = router.currentRoute.value.query.hasOwnProperty(props.filterTag)
    const urlHasActualFilterName = props.filterItem.name === router.currentRoute.value.query[props.filterTag]
    return urlHasStateFilter && urlHasActualFilterName
        ? 'font-semibold'
        : ''
})
</script>

<style lang="scss" scoped></style>