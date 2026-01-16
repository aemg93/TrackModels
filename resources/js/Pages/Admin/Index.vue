<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'

defineProps({
  users: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <AppLayout>
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Usuarios</h1>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Activo</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ganancias</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users?.data" :key="user.id">
              <td class="px-6 py-4 text-sm text-gray-700">{{ user.id }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ user.name }} {{ user.last_name }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">{{ user.email }}</td>
              <td class="px-6 py-4 text-sm text-gray-700">
                <span v-for="role in user.roles" :key="role.id" class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                  {{ role.name }}
                </span>
              </td>
              <td class="px-6 py-4 text-sm">
                <span
                  :class="user.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                >
                  {{ user.active ? 'Activo' : 'Inactivo' }}
                </span>
              </td>
              <td class="px-6 py-4 text-sm text-gray-700">${{ user.earnings }}</td>
              <td class="px-6 py-4 text-sm font-medium space-x-2">
                <Link :href="route('users.show', user.id)" class="text-blue-600 hover:text-blue-900">Ver</Link>
                <Link :href="route('users.edit', user.id)" class="text-yellow-600 hover:text-yellow-900">Editar</Link>
                <Link :href="route('users.destroy', user.id)" method="delete" as="button" class="text-red-600 hover:text-red-900">Eliminar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-6 flex justify-center">
        <Pagination :links="users?.links" />
      </div>
    </div>
  </AppLayout>
</template>
