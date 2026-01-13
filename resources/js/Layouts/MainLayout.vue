<script setup>
</script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-50">

       <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">
                    Malu Store
                </h1>

                <nav class="space-x-6 text-gray-600">
                    <a href="/" class="hover:text-black">Home</a>
                    <a href="/produtos" class="hover:text-black">Produtos</a>
                    <a href="#" class="hover:text-black">Contato</a>
                </nav>
            </div>
        </header>

        <!-- Contéudo dinâmico -->
        <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-300">
            <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm">
                © {{ new Date().getFullYear() }} Malu Store — Todos os direitos reservados
            </div>
        </footer>

    </div>
</template>
