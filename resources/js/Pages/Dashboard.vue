<script>
import AppLayout from '@/Layouts/AppLayout.vue'

export default {
  layout: AppLayout,
}
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Panel de Control</h1>

    <!-- Tarjetas de métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold">Usuarios</h2>
        <p class="text-2xl font-bold text-blue-600">120</p>
      </div>
      <div class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold">Modelos</h2>
        <p class="text-2xl font-bold text-green-600">45</p>
      </div>
      <div class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold">Admins</h2>
        <p class="text-2xl font-bold text-purple-600">8</p>
      </div>
    </div>

    <!-- Sección de gráficas -->
    <div class="bg-white shadow rounded p-6">
      <h2 class="text-lg font-semibold mb-4">Actividad reciente</h2>
      <p class="text-gray-600">Aquí puedes integrar Chart.js o cualquier librería de gráficas.</p>
    </div>
  </div>
</template>
