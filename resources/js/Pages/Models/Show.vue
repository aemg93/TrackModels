<template>
  <div class="p-6 space-y-6">
    <!-- Título -->
    <h1 class="text-2xl font-bold">Resumen Financiero - {{ model.name }}</h1>

    <!-- Totales generales -->
    <FinancialSummary
      :earnings-totals="earningsTotals"
      :bonuses-total="bonusesTotal"
      :discounts-total="discountsTotal"
      :net-income="netIncome"
    />

    <!-- Filtros -->
    <FiltersPanel :model="model" :filters="filters" @apply="applyFilters" />

    <!-- Tablas -->
    <PlatformTotalsTable :totales="totales" :total-general="totalGeneral" />
    <EarningsTable :earnings="earnings" />
    <BonusesTable :bonuses="bonuses" />
    <DiscountsTable :discounts="discounts" />

    <!-- Gráficas -->
    <ChartsDashboard :earnings="earnings" :platforms="totales" />
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

import FinancialSummary from '@/Components/FinancialSummary.vue'
import FiltersPanel from '@/Components/FiltersPanel.vue'
import PlatformTotalsTable from '@/Components/PlatformTotalsTable.vue'
import EarningsTable from '@/Components/EarningsTable.vue'
import BonusesTable from '@/Components/BonusesTable.vue'
import DiscountsTable from '@/Components/DiscountsTable.vue'
import ChartsDashboard from '@/Components/ChartsDashboard.vue'

const props = defineProps({
  model: Object,
  earnings: Array,
  earningsTotals: Object,
  bonuses: Array,
  bonusesTotal: Number,
  discounts: Array,
  discountsTotal: Number,
  netIncome: Number,
  filters: Object,
  totales: Array,
  totalGeneral: Object,
})

const filters = reactive({ ...props.filters })

function applyFilters() {
  router.get(route('models.show', { model: props.model.id }), filters, { preserveState: true })
}
</script>
