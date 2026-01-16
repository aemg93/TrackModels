<script setup>
import ModelLayout from '@/Layouts/ModelLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  models: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <ModelLayout>
    <h1 class="text-2xl font-bold mb-4">Listado de Modelos</h1>

    <!-- Tabla -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Apellido</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Activo</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="model in models.data" :key="model.id">
            <td class="px-6 py-4 text-sm text-gray-700">{{ model.id }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ model.name }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ model.last_name ?? 'No registrado' }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ model.email }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ model.phone ?? 'No registrado' }}</td>
            <td class="px-6 py-4 text-sm">
              <span
                :class="model.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
              >
                {{ model.active ? 'Activo' : 'Inactivo' }}
              </span>
            </td>
            <td class="px-6 py-4 text-sm font-medium space-x-2">
              <Link :href="route('models.show', model.id)" class="text-blue-600 hover:text-blue-900">Ver</Link>
              <Link :href="route('models.edit', model.id)" class="text-yellow-600 hover:text-yellow-900">Editar</Link>
              <Link :href="route('models.destroy', model.id)" method="delete" as="button" class="text-red-600 hover:text-red-900">Eliminar</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6 flex justify-center space-x-2">
      <template v-for="link in models.links" :key="link.label">
        <!-- Si el link tiene URL -->
        <Link
          v-if="link && link.url"
          :href="link.url"
          v-html="link.label"
          class="px-3 py-1 rounded border text-sm"
          :class="{
            'bg-indigo-600 text-white': link.active,
            'text-gray-600 hover:bg-gray-100': !link.active
          }"
        />
        <!-- Si el link NO tiene URL (ej: separador ...) -->
        <span
          v-else
          v-html="link.label"
          class="px-3 py-1 rounded border text-sm text-gray-400"
        />
      </template>
    </div>
  </ModelLayout>
</template>
