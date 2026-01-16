<template>
  <SuperAdminLayout>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label>Nombre</label>
          <input v-model="form.name" type="text" class="border rounded w-full p-2" />
        </div>

        <div>
          <label>Apellido</label>
          <input v-model="form.last_name" type="text" class="border rounded w-full p-2" />
        </div>

        <div>
          <label>Email</label>
          <input v-model="form.email" type="email" class="border rounded w-full p-2" />
        </div>

        <div>
          <label>Contraseña</label>
          <input v-model="form.password" type="password" class="border rounded w-full p-2" />
        </div>

        <div>
          <label>Rol</label>
          <select v-model="form.role" class="border rounded w-full p-2">
            <option value="Super Admin">Super Admin</option>
            <option value="Admin">Admin</option>
            <option value="Modelo">Modelo</option>
          </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
          Guardar
        </button>
      </form>
    </div>
  </SuperAdminLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue'

const form = useForm({
  name: '',
  last_name: '',
  email: '',
  password: '',
  role: 'Modelo',
})

function submit() {
  form.post(route('superadmin.store'))
}
</script>
