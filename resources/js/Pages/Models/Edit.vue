<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  model: {
    type: Object,
    required: true,
  },
})

const form = useForm({
  name: props.model.name,
  last_name: props.model.last_name,
  stage_name: props.model.stage_name,
  email: props.model.email,
  phone: props.model.phone,
  contact: props.model.contact,
  address: props.model.address,
  city: props.model.city,
  country: props.model.country,
  birth_date: props.model.birth_date,
  gender: props.model.gender,
  bio: props.model.bio,
  social_links: props.model.social_links,
  active: props.model.active,
  earnings: props.model.earnings,
  password: '',
})
</script>

<template>
  <AppLayout>
    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden">
      <!-- Header con avatar -->
      <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-8 flex items-center gap-6">
        <img v-if="props.model.avatar" :src="props.model.avatar" alt="Avatar"
             class="w-24 h-24 rounded-full border-4 border-white shadow-lg" />
        <div>
          <h1 class="text-3xl font-bold text-white">
            Editar Perfil de {{ props.model.name }}
          </h1>
          <p class="text-indigo-200">Actualiza la información del modelo</p>
        </div>
      </div>

      <!-- Formulario -->
      <form @submit.prevent="form.put(route('models.update', props.model.id))" class="p-8 space-y-8">
        <!-- Datos personales -->
        <div>
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Datos personales</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium">Nombre</label>
              <input v-model="form.name" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Apellido</label>
              <input v-model="form.last_name" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Nombre artístico</label>
              <input v-model="form.stage_name" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Email</label>
              <input v-model="form.email" type="email" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Teléfono</label>
              <input v-model="form.phone" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Contacto</label>
              <input v-model="form.contact" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
          </div>
        </div>

        <!-- Ubicación -->
        <div>
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Ubicación</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label class="block text-sm font-medium">Dirección</label>
              <input v-model="form.address" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Ciudad</label>
              <input v-model="form.city" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">País</label>
              <input v-model="form.country" type="text" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
          </div>
        </div>

        <!-- Perfil -->
        <div>
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Perfil</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium">Fecha de nacimiento</label>
              <input v-model="form.birth_date" type="date" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
              <label class="block text-sm font-medium">Género</label>
              <select v-model="form.gender" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
              </select>
            </div>
          </div>
          <div class="mt-4">
            <label class="block text-sm font-medium">Biografía</label>
            <textarea v-model="form.bio" rows="4" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
          </div>
        </div>

        <!-- Redes sociales -->
        <div>
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Redes sociales</h2>
          <input v-model="form.social_links" type="text" placeholder="https://instagram.com/usuario"
                 class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <!-- Estado y ganancias -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium">Activo</label>
            <select v-model="form.active" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
              <option :value="true">Activo</option>
              <option :value="false">Inactivo</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium">Ganancias</label>
            <input v-model="form.earnings" type="number" step="0.01"
                   class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
          </div>
        </div>

        <!-- Contraseña -->
        <div>
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Seguridad</h2>
          <label class="block text-sm font-medium">Contraseña (opcional)</label>
          <input v-model="form.password" type="password" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button type="submit"
                  class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow hover:from-indigo-700 hover:to-purple-700 transition">
            Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
