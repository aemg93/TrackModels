<template>
  <DashboardLayout>

    <h1 class="text-2xl font-bold mb-4">Gestión de Modelos</h1>

    <table class="min-w-full border border-gray-300 rounded">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left">Nombre</th>
          <th class="px-4 py-2 text-left">Email</th>
          <th class="px-4 py-2 text-left">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="model in models" :key="model.id" class="border-t">
          <td class="px-4 py-2">{{ model.name }}</td>
          <td class="px-4 py-2">{{ model.email }}</td>
          <td class="px-4 py-2 space-x-2">
            <Link :href="route('models.show', model.id)" class="text-blue-600 hover:underline">Ver</Link>
            <Link :href="route('models.edit', model.id)" class="text-green-600 hover:underline">Editar</Link>
            <!-- Eliminar no se muestra porque Admin no puede -->
          </td>
        </tr>
      </tbody>
    </table>

    <div class="mt-4">
      <Link :href="route('models.create')" class="bg-blue-600 text-white px-4 py-2 rounded">
        Crear Modelo
      </Link>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ models: Array })
</script>
