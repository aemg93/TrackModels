<template>
  <div class="grid grid-cols-4 gap-4 text-center">
    <div class="bg-green-100 p-4 rounded shadow">
      <p class="font-semibold">Ganancias Brutas</p>
      <p class="text-xl">${{ earningsTotals.usd }}</p>
    </div>
    <div class="bg-blue-100 p-4 rounded shadow">
      <p class="font-semibold">Bonificaciones</p>
      <p class="text-xl">+ ${{ bonusesTotal }}</p>
    </div>
    <div class="bg-red-100 p-4 rounded shadow">
      <p class="font-semibold">Descuentos</p>
      <p class="text-xl">- ${{ discountsTotal }}</p>
    </div>
    <div class="bg-yellow-100 p-4 rounded shadow">
      <p class="font-semibold">Ganancia Neta</p>
      <p class="text-xl">${{ netIncome }}</p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  earningsTotals: Object,
  bonusesTotal: Number,
  discountsTotal: Number,
  netIncome: Number,
})
</script>
