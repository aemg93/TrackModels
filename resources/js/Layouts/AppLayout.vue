<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navbar global -->
    <Navbar />

    <!-- Contenido principal -->
    <main class="p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
</script>
