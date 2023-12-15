<template>
    <div class=" bg-beigeLight flex flex-col">
        <AppHeader />

        <!-- output of the page -->
        <div class="min-h-screen basis-full">
            <slot />
        </div>

        <AppFooter />
    </div>
</template>