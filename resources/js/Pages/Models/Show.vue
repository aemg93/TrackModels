<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  model: {
    type: Object,
    required: true,
  },
})
</script>

<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
      <!-- Header con avatar -->
      <div class="bg-gray-800 p-6 flex items-center gap-4">
        <img v-if="props.model.avatar" :src="props.model.avatar" alt="Avatar"
             class="w-20 h-20 rounded-full border-4 border-white shadow" />
        <div>
          <h1 class="text-2xl font-bold text-white">
            {{ props.model.name }} {{ props.model.last_name }}
          </h1>
          <p class="text-gray-300">
            {{ props.model.stage_name ?? 'Sin nombre artístico' }}
          </p>
        </div>
      </div>

      <!-- Datos principales -->
      <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-500">Email</p>
          <p class="font-semibold">{{ props.model.email }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Teléfono</p>
          <p class="font-semibold">{{ props.model.phone ?? 'No registrado' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Ciudad</p>
          <p class="font-semibold">{{ props.model.city ?? 'No registrada' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">País</p>
          <p class="font-semibold">{{ props.model.country ?? 'No registrado' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Activo</p>
          <span :class="props.model.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                class="px-3 py-1 rounded-full text-xs font-semibold">
            {{ props.model.active ? 'Sí' : 'No' }}
          </span>
        </div>
        <div>
          <p class="text-sm text-gray-500">Ganancias</p>
          <p class="font-semibold">$ {{ props.model.earnings }}</p>
        </div>
      </div>

      <!-- Bio -->
      <div class="p-6 border-t">
        <p class="text-sm text-gray-500">Biografía</p>
        <p class="mt-2 text-gray-700">{{ props.model.bio ?? 'Sin biografía registrada' }}</p>
      </div>

      <!-- Plataformas -->
      <div class="p-6 border-t">
        <p class="text-sm text-gray-500">Plataformas</p>
        <ul v-if="props.model.platforms?.length" class="mt-2 flex flex-wrap gap-2">
          <li v-for="platform in props.model.platforms" :key="platform.id"
              class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
            {{ platform.name }}
          </li>
        </ul>
        <p v-else class="mt-2 text-gray-400">Sin plataformas</p>
      </div>

      <!-- Acciones -->
      <div class="p-6 border-t flex gap-4">
        <Link :href="route('models.edit', props.model.id)" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
          Editar
        </Link>
        <Link :href="route('models.index')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
          Volver al listado
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
