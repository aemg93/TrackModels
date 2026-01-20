<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Fondo oscuro -->
    <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm"></div>

    <!-- Card del modal -->
    <div class="relative w-[420px] rounded-2xl overflow-hidden shadow-2xl modal-bg">
      <div class="relative p-6">
        <!-- Header del modal -->
        <div class="flex items-center justify-between mb-4">
          <h3 class="modal-title">Selecciona plataformas</h3>
          <button type="button" @click="$emit('close')" class="modal-close">✕</button>
        </div>

        <!-- Listado de plataformas -->
        <div class="rounded-lg p-4 max-h-64 overflow-auto space-y-2 bg-white/90">
          <label
            v-for="platform in platforms"
            :key="platform.id"
            class="flex items-center justify-between px-3 py-2 rounded-md hover:bg-blue-100 transition"
          >
            <div class="flex items-center gap-3">
              <input
                type="checkbox"
                :value="platform.id"
                :checked="selected.includes(platform.id)"
                @change="toggle(platform.id)"
                class="accent-blue-600 w-4 h-4"
              />
              <span class="text-blue-800 font-medium">{{ platform.name }}</span>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
              ID: {{ platform.id }}
            </span>
          </label>
        </div>

        <!-- Botones -->
        <div class="mt-5 flex justify-end gap-3">
          <button type="button" @click="$emit('close')" class="btn-secondary">Cancelar</button>
          <button type="button" @click="$emit('close')" class="btn-primary">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  platforms: Array,
  selected: { type: Array, default: () => [] },
})
const emits = defineEmits(['update:selected', 'close'])

function toggle(id) {
  let newSelected = [...props.selected]
  if (newSelected.includes(id)) {
    newSelected = newSelected.filter(x => x !== id)
  } else {
    newSelected.push(id)
  }
  emits('update:selected', newSelected)
}
</script>
