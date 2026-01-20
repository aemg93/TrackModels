<template>
  <div class="bg-white rounded-lg shadow p-6 mt-6">
    <h2 class="text-xl font-bold mb-4">Visualización</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Línea -->
      <div class="h-64">
        <canvas id="earningsLine"></canvas>
      </div>
      <!-- Barras -->
      <div class="h-64">
        <canvas id="platformsBar"></canvas>
      </div>
      <!-- Pie chart -->
      <div class="h-80 md:col-span-2">
        <canvas id="platformsPie"></canvas>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, watch, ref } from 'vue'
import Chart from 'chart.js/auto'

const props = defineProps({
  earnings: Array,
  platforms: Array
})

// refs para guardar instancias de gráficos
const lineChart = ref(null)
const barChart = ref(null)
const pieChart = ref(null)

// paleta de colores consistente
const platformColors = [
  '#60a5fa', 
  '#34d399', 
  '#fbbf24', 
  '#f472b6', 
  '#a78bfa', 
  '#38bdf8',
  '#f87171', 
  '#22d3ee', 
  '#c084fc', 
  '#fb7185'  
]


function renderCharts() {
  // destruir instancias previas si existen
  if (lineChart.value) lineChart.value.destroy()
  if (barChart.value) barChart.value.destroy()
  if (pieChart.value) pieChart.value.destroy()

  // línea
  lineChart.value = new Chart(document.getElementById('earningsLine'), {
    type: 'line',
    data: {
      labels: props.earnings.map(e => e.period),
      datasets: [{
        label: 'Ganancias USD',
        data: props.earnings.map(e => e.amount_usd),
        borderColor: '#4f46e5',
        backgroundColor: 'rgba(79,70,229,0.2)',
        fill: true,
        tension: 0.3
      }]
    },
    options: { responsive: true, maintainAspectRatio: false }
  })

  // barras
  barChart.value = new Chart(document.getElementById('platformsBar'), {
    type: 'bar',
    data: {
      labels: props.platforms.map(p => p.platform.name),
      datasets: [{
        label: 'USD por plataforma',
        data: props.platforms.map(p => p.total_usd),
        backgroundColor: props.platforms.map((_, i) => platformColors[i % platformColors.length])
      }]
    },
    options: { responsive: true, maintainAspectRatio: false }
  })

  // pie
  pieChart.value = new Chart(document.getElementById('platformsPie'), {
    type: 'pie',
    data: {
      labels: props.platforms.map(p => p.platform.name),
      datasets: [{
        label: 'Distribución USD',
        data: props.platforms.map(p => p.total_usd),
        backgroundColor: props.platforms.map((_, i) => platformColors[i % platformColors.length])
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { position: 'bottom' } }
    }
  })
}

// inicializar al montar
onMounted(renderCharts)

// ⚡ redibujar cuando cambien los props
watch(() => [props.earnings, props.platforms], renderCharts, { deep: true })
</script>
