<template>
  <AppLayout>
    <div class="flex">
      <Sidebar />
      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>
