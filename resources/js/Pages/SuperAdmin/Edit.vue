<template>
  <SuperAdminLayout>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Editar Usuario</h1>

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
          <label>Contraseña (opcional)</label>
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

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
          Actualizar
        </button>
      </form>
    </div>
  </SuperAdminLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue'

const props = defineProps({ user: Object })

const form = useForm({
  name: props.user.name,
  last_name: props.user.last_name ?? '',
  email: props.user.email,
  password: '',
  role: props.user.roles?.[0]?.name ?? 'Modelo',
})

function submit() {
  form.put(route('superadmin.update', props.user.id))
}
</script>
