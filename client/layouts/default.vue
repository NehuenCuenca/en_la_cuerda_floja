<template>
    <div class="min-h-screen bg-beigeLight flex flex-col">
        <AppHeader />

        <!-- output of the page -->
        <div class="basis-full grow">
            <slot />
        </div>

        <AppFooter />
    </div>
</template>