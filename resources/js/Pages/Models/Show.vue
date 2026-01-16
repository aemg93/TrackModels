<template>
  <ModelLayout>
    <h1 class="text-2xl font-bold mb-4">Model Details</h1>
    <div class="space-y-2">
      <p><strong>Name:</strong> {{ model.name }}</p>
      <p><strong>Email:</strong> {{ model.email }}</p>
      <p><strong>Created At:</strong> {{ model.created_at }}</p>
      <p><strong>Updated At:</strong> {{ model.updated_at }}</p>
    </div>
  </ModelLayout>
</template>

<script setup>
import ModelLayout from '@/Layouts/ModelLayout.vue'
defineProps({ model: Object })
</script>
