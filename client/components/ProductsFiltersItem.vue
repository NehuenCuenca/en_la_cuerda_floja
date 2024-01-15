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
    const { query } = router.currentRoute.value
    const urlHasTagFilter = query.hasOwnProperty(props.filterTag)
    const urlHasFilterName = props.filterItem.name === query[props.filterTag]

    return urlHasTagFilter && urlHasFilterName
        ? 'font-semibold'
        : ''
})
</script>

<style lang="scss" scoped></style>