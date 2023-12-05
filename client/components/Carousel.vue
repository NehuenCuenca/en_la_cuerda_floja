<template>
    <div class="relative slide">
        <div class="carousel-indicators absolute bottom-0 flex bg-yellow-100 h-24 w-full justify-center items-center">
            <ol class="z-50 flex w-4/12 justify-center">
                <li v-for="(img, i) in images" :key="i" @click="chooseActive(i)" class="md:w-4 md:h-4 bg-gray-300 rounded-full cursor-pointer mx-2">
                </li>
            </ol>
        </div>
        <div class="carousel-inner relative overflow-hidden w-full ">
            <div v-for="(img, i) in images" :id="`slide-${i}`" :key="i" :class="`${active === i ? 'active' : 'left-full'}`"
                class="carousel-item inset-0 relative w-full transform transition-all duration-500 ease-in-out">
                <img class="block w-full" :src="img" alt="First slide" />
            </div>
        </div>
    </div>
</template>

<script setup>
// STATE 
const images = ref([
    "https://picsum.photos/id/237/1024/350",
    "https://picsum.photos/id/238/1024/350",
    "https://picsum.photos/id/239/1024/350"
])
const active = ref(0)
const actualInterval = ref('')

// METHODS
const chooseActive = (indexPicture) => {  
    createInterval(indexPicture)
    active.value = indexPicture
}

const createInterval = (indexPicture) => {
    clearInterval(actualInterval.value) 
    let i = indexPicture;

    const newInterval = setInterval(() => {
        if (i > images.value.length - 1) {
            i = 0;
        }
        active.value = i;
        i++;
    }, 2500)

    actualInterval.value = newInterval
}

// LIFECYCLE HOOKS
onMounted(() => {
    createInterval(0)    
});
</script>

<style scoped>
.left-full {
    left: -100%;
}

.carousel-item {
    float: left;
    position: relative;
    display: block;
    width: 100%;
    margin-right: -100%;
    backface-visibility: hidden;
}

.carousel-item.active {
    left: 0;
}
</style>