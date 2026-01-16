<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Crear Usuario / Modelo</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- Datos personales -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input v-model="form.name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Apellido</label>
            <input v-model="form.last_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Nombre artístico</label>
          <input v-model="form.stage_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Contacto -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input v-model="form.email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input v-model="form.phone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Dirección</label>
          <input v-model="form.address" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">País</label>
            <input v-model="form.country" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Ciudad</label>
            <input v-model="form.city" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
        </div>

        <!-- Perfil -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
            <input v-model="form.birth_date" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Género</label>
            <select v-model="form.gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
              <option value="">Seleccionar</option>
              <option value="male">Masculino</option>
              <option value="female">Femenino</option>
              <option value="other">Otro</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Biografía</label>
          <textarea v-model="form.bio" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <!-- Documentos y redes -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700">Documento de identidad</label>
            <input v-model="form.document_path" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Avatar (URL)</label>
            <input v-model="form.avatar" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Redes sociales</label>
          <input v-model="form.social_links" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Estado y métricas -->
        <div class="grid grid-cols-2 gap-6">
          <div class="flex items-center space-x-2">
            <input type="checkbox" v-model="form.active" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
            <label class="text-sm font-medium text-gray-700">Activo</label>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Ganancias iniciales</label>
            <input v-model="form.earnings" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Contraseña</label>
          <input v-model="form.password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
            Guardar
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const form = useForm({
  name: '',
  last_name: '',
  stage_name: '',
  email: '',
  phone: '',
  address: '',
  country: '',
  city: '',
  birth_date: '',
  gender: '',
  bio: '',
  document_path: '',
  avatar: '',
  social_links: '',
  active: true,
  earnings: 0,
  password: '',
})

function submit() {
  form.post(route('users.store'))
}
</script>
