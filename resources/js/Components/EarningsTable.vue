<template>
  <div>
    <h2 class="text-xl font-bold mt-6 text-green-400">Ganancias</h2>

    <!-- Contenedor con scroll -->
    <div class="max-h-96 overflow-y-auto border border-white rounded-lg shadow-lg">
      <table class="table-auto w-full border-collapse bg-gradient-to-r from-blue-900 to-black">
        <thead class="bg-black text-white sticky top-0">
          <tr>
            <th class="border border-white px-4 py-2">Plataforma</th>
            <th class="border border-white px-4 py-2">Tokens</th>
            <th class="border border-white px-4 py-2">USD</th>
            <th class="border border-white px-4 py-2">COP</th>
            <th class="border border-white px-4 py-2">Periodo</th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="(e, index) in earnings" 
            :key="index"
            class="hover:bg-blue-800 transition-colors"
          >
            <!-- Ahora earnings trae el objeto platform completo -->
            <td class="border border-white px-4 py-2 text-white">
              {{ e.platform.name }}
            </td>
            <td class="border border-white px-4 py-2 text-green-400 font-bold">
              {{ e.tokens }}
            </td>
            <td class="border border-white px-4 py-2 text-green-400 font-bold">
              ${{ e.usd }}
            </td>
            <td class="border border-white px-4 py-2 text-green-400 font-bold">
              ${{ e.cop }}
            </td>
            <td class="border border-white px-4 py-2 text-white">
              {{ e.period }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  earnings: Array,
})
</script>
