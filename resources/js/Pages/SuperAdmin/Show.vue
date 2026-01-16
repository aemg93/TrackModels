<template>
  <SuperAdminLayout>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Detalles del Usuario</h1>
      <p><strong>Nombre:</strong> {{ user.name }}</p>
      <p><strong>Email:</strong> {{ user.email }}</p>
    </div>
  </SuperAdminLayout>
</template>

<script setup>
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue'
defineProps({ user: Object })
</script>
