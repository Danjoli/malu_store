<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';

defineProps({
    message: String
})
</script>

<template>
    <MainLayout>
        <h2 class="text-3xl font-bold text-gray-800">
            {{ message }}
        </h2>

        <p class="mt-4 text-gray-600">
            loja de roupas online começa aqui 👕✨
        </p>
    </MainLayout>
</template>
