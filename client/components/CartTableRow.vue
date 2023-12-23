<template>
    <tr>
        <td>{{ props.productItem.name }}</td>
        <td>${{ props.productItem.price }}</td>
        <td>
            <div class="px-20 flex items-center justify-evenly">
                <button type="button" class="font-semibold text-2xl">-</button>
                <span>{{ props.productItem.quantity }}</span>
                <button type="button" class="font-semibold text-2xl">+</button>
            </div>
        </td>
        <td>${{totalPrice}}</td>
        <td>
            <button class="font-bold">X</button>
        </td>
    </tr>
</template>

<script setup>
const props = defineProps({
    productItem: Object
})

const totalPrice = computed(() => {
    return (props.productItem.price * props.productItem.quantity).toFixed(2)
})
</script>

<style lang="scss" scoped></style>