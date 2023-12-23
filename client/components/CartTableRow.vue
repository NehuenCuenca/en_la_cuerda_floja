<template>
    <tr>
        <td>{{ props.productItem.name }}</td>
        <td>${{ props.productItem.price }}</td>
        <td>
            <div class="px-20 flex items-center justify-evenly">
                <button type="button" class="font-semibold text-2xl"
                    @click="store.handleQuantity(props.productItem.id, 'remove')">-</button>
                <span>{{ props.productItem.quantity }}</span>
                <button type="button" class="font-semibold text-2xl"
                    @click="store.handleQuantity(props.productItem.id, 'add')">+</button>
            </div>
        </td>
        <td>${{ totalPrice }}</td>
        <td>
            <button class="font-bold" @click="handleRemove(props.productItem.id)">X</button>
        </td>
    </tr>
</template>

<script setup>
// STORE
import { useCartStore } from '@/stores/CartStore'
const store = useCartStore()

// PROPS
const props = defineProps({
    productItem: Object
})

// COMPUTED
const totalPrice = computed(() => {
    return (props.productItem.price * props.productItem.quantity).toFixed(2)
})

// METHODS
const handleRemove = (id) => {
    store.removeFromCart(id)
}

</script>

<style lang="scss" scoped></style>