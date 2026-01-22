<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Crear Usuario / Modelo
      </h1>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- Datos personales -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
              Nombre
            </label>
            <input
              id="name"
              name="name"
              v-model="form.name"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">
              Apellido
            </label>
            <input
              id="last_name"
              name="last_name"
              v-model="form.last_name"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>

        <div>
          <label for="stage_name" class="block text-sm font-medium text-gray-700">
            Nombre artístico
          </label>
          <input
            id="stage_name"
            name="stage_name"
            v-model="form.stage_name"
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <!-- Contacto -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email
            </label>
            <input
              id="email"
              name="email"
              v-model="form.email"
              type="email"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">
              Teléfono
            </label>
            <input
              id="phone"
              name="phone"
              v-model="form.phone"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>

        <div>
          <label for="address" class="block text-sm font-medium text-gray-700">
            Dirección
          </label>
          <input
            id="address"
            name="address"
            v-model="form.address"
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <div class="grid grid-cols-2 gap-6">
          <div>
            <label for="country" class="block text-sm font-medium text-gray-700">
              País
            </label>
            <input
              id="country"
              name="country"
              v-model="form.country"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="city" class="block text-sm font-medium text-gray-700">
              Ciudad
            </label>
            <input
              id="city"
              name="city"
              v-model="form.city"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>

        <!-- Perfil -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700">
              Fecha de nacimiento
            </label>
            <input
              id="birth_date"
              name="birth_date"
              v-model="form.birth_date"
              type="date"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="gender" class="block text-sm font-medium text-gray-700">
              Género
            </label>
            <select
              id="gender"
              name="gender"
              v-model="form.gender"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="">Seleccionar</option>
              <option value="male">Masculino</option>
              <option value="female">Femenino</option>
              <option value="other">Otro</option>
            </select>
          </div>
        </div>

        <div>
          <label for="bio" class="block text-sm font-medium text-gray-700">
            Biografía
          </label>
          <textarea
            id="bio"
            name="bio"
            v-model="form.bio"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-blue-500 focus:border-blue-500"
          ></textarea>
        </div>

        <!-- Documentos y redes -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label for="document_path" class="block text-sm font-medium text-gray-700">
              Documento de identidad
            </label>
            <input
              id="document_path"
              name="document_path"
              v-model="form.document_path"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
          <div>
            <label for="avatar" class="block text-sm font-medium text-gray-700">
              Avatar (URL)
            </label>
            <input
              id="avatar"
              name="avatar"
              v-model="form.avatar"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>

        <div>
          <label for="social_links" class="block text-sm font-medium text-gray-700">
            Redes sociales
          </label>
          <input
            id="social_links"
            name="social_links"
            v-model="form.social_links"
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <!-- Estado y métricas -->
        <div class="grid grid-cols-2 gap-6">
          <div class="flex items-center space-x-2">
            <input
              id="active"
              name="active"
              type="checkbox"
              v-model="form.active"
              class="h-4 w-4 text-blue-600 border-gray-300 rounded
                     focus:ring-blue-500"
            />
            <label for="active" class="text-sm font-medium text-gray-700">
              Activo
            </label>
          </div>
          <div>
            <label for="earnings" class="block text-sm font-medium text-gray-700">
              Ganancias iniciales
            </label>
            <input
              id="earnings"
              name="earnings"
              v-model="form.earnings"
              type="number"
              step="0.01"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">
            Contraseña
          </label>
          <input
            id="password"
            name="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                   focus:ring-blue-500 focus:border-blue-500"
          />
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold
                   px-6 py-2 rounded-md shadow"
          >
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
