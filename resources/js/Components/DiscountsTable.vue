<template>
  <div>
    <h2 class="text-xl font-bold mt-6">Descuentos</h2>
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-4 py-2">Motivo</th>
          <th class="border px-4 py-2">USD</th>
          <th class="border px-4 py-2">Periodo</th>
          <th class="border px-4 py-2">Cuota</th>
          <th class="border px-4 py-2">Saldo Pendiente</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="d in discounts" :key="d.id">
          <td class="border px-4 py-2">{{ d.reason }}</td>
          <td class="border px-4 py-2">- ${{ d.amount_usd }}</td>
          <td class="border px-4 py-2">{{ d.period }}</td>
          <td class="border px-4 py-2">{{ d.current_installment }}/{{ d.installments }}</td>
          <td class="border px-4 py-2">${{ d.remaining_amount }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps({
  discounts: Array,
})
</script>
