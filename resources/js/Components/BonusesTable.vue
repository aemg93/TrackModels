<template>
  <div>
    <h2 class="text-xl font-bold mt-6">Bonificaciones</h2>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-4 py-2">Motivo</th>
          <th class="border px-4 py-2">USD</th>
          <th class="border px-4 py-2">Periodo</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="b in bonuses" :key="b.id">
          <td class="border px-4 py-2">{{ b.reason }}</td>
          <td class="border px-4 py-2">+ ${{ b.amount_usd }}</td>
          <td class="border px-4 py-2">{{ b.period }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps({
  bonuses: Array,
})
</script>
