<template>
    <div class="min-h-full px-5 py-10 grid grid-cols-4 grid-rows-[auto_repeat(3,minmax(0,_1fr)] gap-3 ">
        <h1 class="col-span-full row-span-1 self-start px-4 py-2 bg-beigeStrong text-2xl font-semibold">Resultados de la
            busqueda de
            ‘Producto X’:</h1>

        <form class="p-4 col-span-1 row-span-4 bg-beigeStrong flex flex-col gap-3">
            <h1 class="text-2xl font-semibold place-self-center">Filtros</h1>
            <div class="flex flex-col">
                <h3 class="underline font-semibold">Categorias</h3>
                <ul>
                    <li class="text-gray-700">
                        <button>Categoria x</button>
                    </li>
                    <li class="text-gray-700">
                        <button>Categoria x</button>
                    </li>
                    <li class="text-gray-700">
                        <button>Categoria x</button>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col">
                <h3 class="underline font-semibold">Estado</h3>
                <ul>
                    <li class="text-gray-700">
                        <button>Nuevo</button>
                    </li>
                    <li class="text-gray-700">
                        <button>Usado</button>
                    </li>
                </ul>
            </div>
        </form>

        <GridProductsList :quantityItems="9" class="col-span-3 row-span-3" />

        <ul class="px-3 col-span-1 row-span-1 bg-gray-600 h-10 w-2/4 flex gap-4 items-center">
            <li class="text-xl font-semibold">
                <button>1</button>
            </li>
            <li class="text-xl font-semibold">
                <button>2</button>
            </li>
            <li class="text-xl font-semibold">
                <button>3</button>
            </li>
            <li class="text-xl font-semibold">
                <button>...</button>
            </li>
        </ul>
    </div>
</template>

<script setup>

</script>

<style scoped></style>