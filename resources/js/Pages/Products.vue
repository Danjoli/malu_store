<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

defineProps({
  products: Array
})
</script>

<template>
  <MainLayout>
    <h2 class="text-3xl font-bold text-gray-800 mb-8">
      Produtos
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <div
        v-for="product in products"
        :key="product.id"
        class="bg-white rounded-lg shadow hover:shadow-lg transition"
      >
        <img
          :src="product.image"
          alt=""
          class="w-full h-80 object-cover rounded-t-lg"
        />

        <div class="p-4">
          <h3 class="text-lg font-semibold text-gray-800">
            {{ product.name }}
          </h3>

          <p class="text-pink-600 font-bold mt-2">
            R$ {{ product.price }}
          </p>

          <a
            :href="`/produtos/${product.id}`"
            class="mt-4 block text-center bg-pink-600 text-white py-2 rounded hover:bg-pink-700 transition"
            >
            Ver produto
          </a>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
