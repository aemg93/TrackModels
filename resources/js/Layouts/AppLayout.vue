<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">
    <Navbar />
    <main class="flex-1 pt-28 p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'
</script>
