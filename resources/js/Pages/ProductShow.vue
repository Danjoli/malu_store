<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

defineProps({
  product: Object
})
</script>

<template>
  <MainLayout>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

      <!-- Imagem -->
      <img
        :src="product.image"
        alt=""
        class="w-full h-[500px] object-cover rounded-lg shadow"
      />

      <!-- Info -->
      <div>
        <h2 class="text-3xl font-bold text-gray-800">
          {{ product.name }}
        </h2>

        <p class="text-pink-600 text-2xl font-bold mt-4">
          R$ {{ product.price }}
        </p>

        <p class="text-gray-600 mt-6">
          Produto de alta qualidade, perfeito para compor seu estilo.
        </p>

        <button
          class="mt-8 bg-pink-600 text-white px-6 py-3 rounded hover:bg-pink-700 transition"
        >
          Adicionar ao carrinho
        </button>
      </div>

    </div>
  </MainLayout>
</template>

import cartService from '../services/cartService'

methods: {
  addToCart() {
    cartService.add(this.product.id)
      .then(() => {
        alert('Produto adicionado ao carrinho')
      })
  }
}
