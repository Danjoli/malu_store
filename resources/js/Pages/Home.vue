<script setup>
defineProps({
    message: String
})
</script>

<template>
    <div class="p-8">
        <h1 class="text-3xl font-bold text-red-800">
            {{ message }}
        </h1>

        <p class="mt-4 text-gray-600">
            Laravel + Inertia + Vue funcionando corretamente 🚀
        </p>
    </div>
</template>
