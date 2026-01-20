<template>
  <form @submit.prevent="submit" class="p-8 space-y-8">
    <!-- Datos personales -->
    <div>
      <h2 class="section-title">Datos personales</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div><label class="label">Nombre</label><input v-model="form.name" type="text" class="input" /></div>
        <div><label class="label">Apellido</label><input v-model="form.last_name" type="text" class="input" /></div>
        <div><label class="label">Nombre artístico</label><input v-model="form.stage_name" type="text" class="input" /></div>
        <div><label class="label">Email</label><input v-model="form.email" type="email" class="input" /></div>
        <div><label class="label">Teléfono</label><input v-model="form.phone" type="text" class="input" /></div>
        <div><label class="label">Contacto</label><input v-model="form.contact" type="text" class="input" /></div>
      </div>
    </div>

    <!-- Ubicación -->
    <div>
      <h2 class="section-title">Ubicación</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div><label class="label">Dirección</label><input v-model="form.address" type="text" class="input" /></div>
        <div><label class="label">Ciudad</label><input v-model="form.city" type="text" class="input" /></div>
        <div><label class="label">País</label><input v-model="form.country" type="text" class="input" /></div>
      </div>
    </div>

    <!-- Perfil -->
    <div>
      <h2 class="section-title">Perfil</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div><label class="label">Fecha de nacimiento</label><input v-model="form.birth_date" type="date" class="input" /></div>
        <div>
          <label class="label">Género</label>
          <select v-model="form.gender" class="input">
            <option value="male">Masculino</option>
            <option value="female">Femenino</option>
            <option value="other">Otro</option>
          </select>
        </div>
      </div>
      <div class="mt-4"><label class="label">Biografía</label><textarea v-model="form.bio" rows="4" class="input"></textarea></div>
    </div>

    <!-- Redes sociales -->
    <div>
      <h2 class="section-title">Redes sociales</h2>
      <input v-model="form.social_links" type="text" class="input" />
    </div>

    <!-- Estado y ganancias -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="label">Activo</label>
        <select v-model="form.active" class="input">
          <option :value="true">Activo</option>
          <option :value="false">Inactivo</option>
        </select>
      </div>
      <div><label class="label">Ganancias</label><input v-model="form.earnings" type="number" step="0.01" class="input" /></div>
    </div>

    <!-- Seguridad -->
    <div>
      <h2 class="section-title">Seguridad</h2>
      <label class="label">Contraseña (opcional)</label>
      <input v-model="form.password" type="password" class="input" />
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
    <div class="flex justify-end"><button type="submit" class="btn-submit">Guardar cambios</button></div>

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
})

const showPlatformsModal = ref(false)
const selectedPlatforms = computed(() =>
  props.platforms.filter(p => props.form.platform_ids.includes(p.id))
)
</script>
