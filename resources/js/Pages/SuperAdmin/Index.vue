<template>
  <SuperAdminLayout>
    <div class="p-6">
      <!-- Encabezado -->
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <svg class="w-8 h-8 mr-2 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
            Lista de Super Admins
          </h1>
          <p class="text-gray-500">Gestión de usuarios con rol Super Admin</p>
        </div>
        <Link :href="route('superadmin.create')" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
          + Crear nuevo
        </Link>
      </div>

      <!-- Mensaje de éxito -->
      <div v-if="$page.props.flash?.success" class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg">
        {{ $page.props.flash.success }}
      </div>

      <!-- Tabla de usuarios -->
      <div class="overflow-hidden rounded-lg shadow">
        <table class="min-w-full bg-white">
          <thead>
            <tr class="bg-gray-100 text-left text-gray-700">
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Nombre</th>
              <th class="py-3 px-4">Email</th>
              <th class="py-3 px-4">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50 border-t">
              <td class="py-3 px-4">{{ user.id }}</td>
              <td class="py-3 px-4 font-medium">{{ user.name }}</td>
              <td class="py-3 px-4 text-gray-600">{{ user.email }}</td>
              <td class="py-3 px-4 flex space-x-2">
                <Link :href="route('superadmin.show', user.id)" class="px-2 py-1 text-sm bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                  Ver
                </Link>
                <Link :href="route('superadmin.edit', user.id)" class="px-2 py-1 text-sm bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition">
                  Editar
                </Link>
                <Link :href="route('superadmin.destroy', user.id)" method="delete" as="button"
                      class="px-2 py-1 text-sm bg-red-100 text-red-700 rounded hover:bg-red-200 transition">
                  Eliminar
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </SuperAdminLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue'

defineProps({ users: Array })
</script>
