<template>
  <div class="bg-gray-50 p-4 rounded shadow mt-6">
    <h2 class="text-lg font-bold mb-2">Filtros</h2>
    <form @submit.prevent="$emit('apply')" class="grid grid-cols-4 gap-4">
      <div>
        <label class="block text-sm font-medium">Plataforma</label>
        <select v-model="filters.platform_id" class="w-full border rounded p-2">
          <option value="">Todas</option>
          <option v-for="p in model.platforms" :key="p.id" :value="p.id">
            {{ p.name }}
          </option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium">Desde</label>
        <input type="date" v-model="filters.from" class="w-full border rounded p-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Hasta</label>
        <input type="date" v-model="filters.to" class="w-full border rounded p-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Periodo</label>
        <input type="text" v-model="filters.period" placeholder="ej: semana 01-2026" class="w-full border rounded p-2" />
      </div>
      <div class="col-span-4 text-right">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
          Aplicar filtros
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
const props = defineProps({
  model: Object,
  filters: Object,
})
</script>
