<template>
  <AppLayout>
    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden">
      <!-- Header vibrante -->
      <div class="relative p-8 flex items-center gap-6 overflow-hidden header-gradient">
        <img
          v-if="model.avatar"
          :src="model.avatar"
          alt="Avatar"
          class="relative z-10 w-24 h-24 rounded-full border-4 border-white shadow-lg"
        />
        <div class="relative z-10">
          <h1 class="text-3xl font-extrabold text-white tracking-tight drop-shadow">
            Editar Perfil de {{ model.name }}
          </h1>
          <p class="text-indigo-100">Actualiza la información del modelo</p>
        </div>
      </div>

      <!-- Formulario -->
      <form @submit.prevent="submit" class="p-8 space-y-8">
        <!-- Datos personales -->
        <div>
          <h2 class="section-title">Datos personales</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="label">Nombre</label>
              <input v-model="form.name" type="text" class="input" />
            </div>
            <div>
              <label class="label">Apellido</label>
              <input v-model="form.last_name" type="text" class="input" />
            </div>
            <div>
              <label class="label">Nombre artístico</label>
              <input v-model="form.stage_name" type="text" class="input" />
            </div>
            <div>
              <label class="label">Email</label>
              <input v-model="form.email" type="email" class="input" />
            </div>
            <div>
              <label class="label">Teléfono</label>
              <input v-model="form.phone" type="text" class="input" />
            </div>
            <div>
              <label class="label">Contacto</label>
              <input v-model="form.contact" type="text" class="input" />
            </div>
          </div>
        </div>

        <!-- Ubicación -->
        <div>
          <h2 class="section-title">Ubicación</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label class="label">Dirección</label>
              <input v-model="form.address" type="text" class="input" />
            </div>
            <div>
              <label class="label">Ciudad</label>
              <input v-model="form.city" type="text" class="input" />
            </div>
            <div>
              <label class="label">País</label>
              <input v-model="form.country" type="text" class="input" />
            </div>
          </div>
        </div>

        <!-- Perfil -->
        <div>
          <h2 class="section-title">Perfil</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="label">Fecha de nacimiento</label>
              <input v-model="form.birth_date" type="date" class="input" />
            </div>
            <div>
              <label class="label">Género</label>
              <select v-model="form.gender" class="input">
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
              </select>
            </div>
          </div>
          <div class="mt-4">
            <label class="label">Biografía</label>
            <textarea v-model="form.bio" rows="4" class="input"></textarea>
          </div>
        </div>

        <!-- Redes sociales -->
        <div>
          <h2 class="section-title">Redes sociales</h2>
          <input
            v-model="form.social_links"
            type="text"
            placeholder="https://instagram.com/usuario"
            class="input"
          />
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
          <div>
            <label class="label">Ganancias</label>
            <input v-model="form.earnings" type="number" step="0.01" class="input" />
          </div>
        </div>

        <!-- Seguridad -->
        <div>
          <h2 class="section-title">Seguridad</h2>
          <label class="label">Contraseña (opcional)</label>
          <input v-model="form.password" type="password" class="input" />
        </div>

        <!-- Plataformas (preview + modal trigger) -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <h2 class="section-title">Plataformas</h2>
            <button type="button" @click="showPlatformsModal = true" class="btn-primary">
              Seleccionar plataformas
            </button>
          </div>

          <!-- Preview badges -->
          <div class="flex flex-wrap gap-2 mb-3">
            <span v-if="selectedPlatforms.length === 0" class="text-sm text-gray-500">
              Sin plataformas seleccionadas
            </span>
            <span v-for="p in selectedPlatforms" :key="p.id" class="badge">
              {{ p.name }}
            </span>
          </div>
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button type="submit" class="btn-submit">Guardar cambios</button>
        </div>
      </form>

      <!-- Modal juvenil vibrante -->
      <div v-if="showPlatformsModal" class="fixed inset-0 z-50 flex items-center justify-center">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm"></div>

        <!-- Card -->
        <div class="relative w-[420px] rounded-2xl overflow-hidden shadow-2xl modal-bg">
          <div class="relative p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="modal-title">Selecciona plataformas</h3>
              <button type="button" @click="showPlatformsModal = false" class="modal-close">✕</button>
            </div>

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
                    v-model="form.platform_ids"
                    class="accent-blue-600 w-4 h-4"
                  />
                  <span class="text-blue-800 font-medium">{{ platform.name }}</span>
                </div>
                <span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                  ID: {{ platform.id }}
                </span>
              </label>
            </div>

            <div class="mt-5 flex justify-end gap-3">
              <button type="button" @click="showPlatformsModal = false" class="btn-secondary">
                Cancelar
              </button>
              <button type="button" @click="showPlatformsModal = false" class="btn-primary">
                Aceptar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /Modal -->
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
  model: { type: Object, required: true },
  platforms: { type: Array, required: true },
})

const model = props.model
const platforms = props.platforms

const form = useForm({
  name: model.name,
  last_name: model.last_name,
  stage_name: model.stage_name,
  email: model.email,
  phone: model.phone,
  contact: model.contact,
  address: model.address,
  city: model.city,
  country: model.country,
  birth_date: model.birth_date,
  gender: model.gender,
  bio: model.bio,
  social_links: model.social_links,
  active: model.active,
  earnings: model.earnings,
  password: '',
  platform_ids: (model.platforms || []).map(p => p.id),
})

const showPlatformsModal = ref(false)

const selectedPlatforms = computed(() =>
  platforms.filter(p => form.platform_ids.includes(p.id))
)

const submit = () => {
  form.platform_ids = (form.platform_ids || []).map(id => Number(id))
  form.put(route('models.update', model.id))
}
</script>

<style scoped>
/* Header vibrante */
.header-gradient {
  background: linear-gradient(90deg, #4f46e5 0%, #d946ef 50%, #7e22ce 100%);
  position: relative;
}
.header-gradient::after {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(255, 0, 204, 0.35) 0%, transparent 35%),
    radial-gradient(circle at 80% 20%, rgba(0, 229, 255, 0.35) 0%, transparent 40%),
    radial-gradient(circle at 60% 80%, rgba(255, 215, 0, 0.35) 0%, transparent 35%);
  mix-blend: screen;
}

/* Tipografía y inputs */
.section-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 1rem;
}
.label {
  display: block;
  font-size: 0.875rem;
  font-weight: 500;
  color: #374151;
}
.input {
  margin-top: 0.25rem;
  width: 100%;
  border-radius: 0.5rem;
  border: 1px solid #d1d5db;
  box-shadow: 0 1px 2px rgba(0,0,0,0.04);
  padding: 0.5rem 0.75rem;
  outline: none;
}
.input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

/* Botones */
.btn-primary {
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  color: #fff;
  font-weight: 600;
  box-shadow: 0 6px 20px rgba(216, 70, 239, 0.35);
  background: linear-gradient(90deg, #ec4899, #d946ef, #7e22ce);
  transition: filter 0.2s ease, transform 0.2s ease;
}
.btn-primary:hover {
  filter: brightness(1.05);
  transform: translateY(-1px);
}
.btn-secondary {
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  color: #1f2937;
  font-weight: 600;
  background: #ffffff;
  border: 1px solid #e5e7eb;
  transition: background 0.2s ease, transform 0.2s ease;
}
.btn-secondary:hover {
  background: #f9fafb;
  transform: translateY(-1px);
}
.btn-submit {
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  color: #fff;
  font-weight: 600;
  box-shadow: 0 8px 24px rgba(79, 70, 229, 0.35);
  background: linear-gradient(90deg, #4f46e5, #d946ef, #7e22ce);
  transition: filter 0.2s ease, transform 0.2s ease;
}
.btn-submit:hover {
  filter: brightness(1.05);
  transform: translateY(-1px);
}

/* Badges */
.badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  font-size: 0.875rem;
  border-radius: 9999px;
  color: #fff;
  background: linear-gradient(90deg, #6366f1, #d946ef, #7e22ce);
  box-shadow: 0 2px 10px rgba(99, 102, 241, 0.35);
}

/* Modal */
.modal-bg {
  background: linear-gradient(135deg, #4f46e5 0%, #d946ef 50%, #7e22ce 100%);
}
.modal-title {
  color: #0f172a; /* negro azulado */
  font-size: 1.125rem;
  font-weight: 800;
  letter-spacing: 0.02em;
  text-shadow: 0 1px 0 rgba(255,255,255,0.4);
}
.modal-close {
  color: #0ea5e9; /* azul que resalta */
  font-weight: 700;
  transition: color 0.2s ease, transform 0.2s ease;
}
.modal-close:hover {
  color: #0284c7;
  transform: scale(1.05);
}

/* Scroll del listado en modal */
.modal-bg .rounded-lg {
  backdrop-filter: saturate(1.2);
  border: 1px solid rgba(255,255,255,0.35);
  border-radius: 0.75rem;
}
</style>
