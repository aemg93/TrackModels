<template>
  <form @submit.prevent="submit" class="p-8 space-y-8">
    <!-- Alert de validación -->
    <div v-if="!isFormValid" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
      <strong class="font-bold">Atención:</strong>
      <span class="block">Los campos Nombre y Email son obligatorios.</span>
      <span v-if="isCreate && !isPasswordValid(form.password)" class="block">
        La contraseña debe tener mínimo 8 caracteres y cumplir al menos 2 condiciones.
      </span>
    </div>

    <!-- Datos personales -->
    <div>
      <h2 class="section-title">Datos personales</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="label">Nombre *</label>
          <input v-model="form.name" type="text" class="input" />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>
        <div><label class="label">Apellido</label><input v-model="form.last_name" type="text" class="input" /></div>
        <div><label class="label">Nombre artístico</label><input v-model="form.stage_name" type="text" class="input" /></div>
        <div>
          <label class="label">Email *</label>
          <input v-model="form.email" type="email" class="input" />
          <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
        </div>
        <div><label class="label">Teléfono</label><input v-model="form.phone" type="text" class="input" /></div>
        <div><label class="label">Contacto</label><input v-model="form.contact" type="text" class="input" /></div>
      </div>
    </div>

    <!-- Seguridad -->
    <div>
      <h2 class="section-title">Seguridad</h2>
      <label class="label">
        Contraseña <span v-if="isCreate">(obligatoria)</span><span v-else>(opcional)</span>
      </label>
      <input v-model="form.password" type="password" class="input" />
      <div v-if="form.password && !isPasswordValid(form.password)" class="text-red-500 text-sm mt-1">
        La contraseña debe tener mínimo 8 caracteres y cumplir al menos 2 condiciones:
        mayúscula, minúscula, número o carácter especial.
      </div>
      <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
    </div>

    <!-- Plataformas -->
    <div>
      <div class="flex items-center justify-between mb-2">
        <h2 class="section-title">Plataformas</h2>
        <button type="button" @click="showPlatformsModal = true" class="btn-primary">Seleccionar plataformas</button>
      </div>
      <div class="flex flex-wrap gap-2 mb-3">
        <span v-if="selectedPlatforms.length === 0" class="text-sm text-gray-500">Sin plataformas seleccionadas</span>
        <span v-for="p in selectedPlatforms" :key="p.id" class="badge">{{ p.name }}</span>
      </div>
    </div>

    <!-- Botón -->
    <div class="flex justify-end">
      <button type="submit" class="btn-submit" :disabled="!isFormValid || form.processing">
        Guardar cambios
      </button>
    </div>

    <!-- Modal -->
    <PlatformsModal v-if="showPlatformsModal" :platforms="platforms" v-model:selected="form.platform_ids" @close="showPlatformsModal = false" />
  </form>
</template>

<script setup>
import { ref, computed } from 'vue'
import PlatformsModal from './PlatformsModal.vue'

const props = defineProps({
  form: Object,
  platforms: Array,
  submit: Function,
  isCreate: { type: Boolean, default: false }
})

const showPlatformsModal = ref(false)
const selectedPlatforms = computed(() =>
  props.platforms.filter(p => props.form.platform_ids.includes(p.id))
)

// Validación de contraseña
function isPasswordValid(password) {
  if (!password) return !props.isCreate // en edición, vacío es válido
  const conditions = [
    /[A-Z]/.test(password),
    /[a-z]/.test(password),
    /[0-9]/.test(password),
    /[^A-Za-z0-9]/.test(password)
  ].filter(Boolean).length
  return password.length >= 8 && conditions >= 2
}

// Validación general del formulario
const isFormValid = computed(() => {
  const baseValid = props.form.name && props.form.email
  return baseValid && isPasswordValid(props.form.password)
})

// 👇 Fijamos el rol siempre como "modelo"
props.form.role = 'modelo'
</script>
