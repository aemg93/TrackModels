<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navbar global -->
    <NavBar />

    <!-- Contenedor principal -->
    <div class="flex">
      <!-- Si en el futuro quieres Sidebar, aquí -->
      <!-- <Sidebar /> -->

      <!-- Contenido dinámico -->
      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import NavBar from '@/Components/NavBar.vue';
// import Sidebar from '@/Components/Sidebar.vue'; // opcional
</script>
