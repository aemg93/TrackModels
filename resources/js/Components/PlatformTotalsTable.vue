<template>
  <div>
    <h2 class="text-xl font-bold mt-6">Totales por Plataforma</h2>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-4 py-2">Plataforma</th>
          <th class="border px-4 py-2">Tokens</th>
          <th class="border px-4 py-2">USD</th>
          <th class="border px-4 py-2">COP</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="t in totales" :key="t.platform_id">
          <td class="border px-4 py-2">{{ t.platform.name }}</td>
          <td class="border px-4 py-2">{{ t.total_tokens }}</td>
          <td class="border px-4 py-2">${{ t.total_usd }}</td>
          <td class="border px-4 py-2">${{ t.total_cop }}</td>
        </tr>
        <tr class="bg-gray-200 font-bold">
          <td class="border px-4 py-2">TOTAL GENERAL</td>
          <td class="border px-4 py-2">{{ totalGeneral.tokens }}</td>
          <td class="border px-4 py-2">${{ totalGeneral.usd }}</td>
          <td class="border px-4 py-2">${{ totalGeneral.cop }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps({
  totales: Array,
  totalGeneral: Object,
})
</script>
