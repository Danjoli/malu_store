<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

const products = [
  {
    id: 1,
    name: 'Vestido Floral',
    price: 'R$ 129,90',
    image: 'https://via.placeholder.com/300x400'
  },
  {
    id: 2,
    name: 'Blusa Feminina',
    price: 'R$ 79,90',
    image: 'https://via.placeholder.com/300x400'
  },
  {
    id: 3,
    name: 'Calça Jeans',
    price: 'R$ 159,90',
    image: 'https://via.placeholder.com/300x400'
  }
]
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
            {{ product.price }}
          </p>

          <button
            class="mt-4 w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700 transition"
          >
            Ver produto
          </button>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
