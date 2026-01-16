<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Navbar global fijo -->
    <Navbar />

    <!-- Contenido principal con espacio debajo del nav -->
    <main class="flex-1 pt-28 p-6"> <!-- antes estaba pt-24 -->
      <slot />
    </main>
  </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
</script>
