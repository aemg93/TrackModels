<template>
  <ModelLayout>
    <h1 class="text-2xl font-bold mb-4">List of Models</h1>
    <ul>
      <li v-for="model in models" :key="model.id">
        {{ model.name }} - {{ model.email }}
      </li>
    </ul>
  </ModelLayout>
</template>

<script setup>
import ModelLayout from '@/Layouts/ModelLayout.vue'

defineProps({ models: Array })
</script>
