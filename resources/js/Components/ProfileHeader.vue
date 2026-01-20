<template>
  <div class="relative p-8 flex items-center gap-6 overflow-hidden header-gradient">
    <img
      v-if="avatar"
      :src="avatar"
      alt="Avatar"
      class="relative z-10 w-24 h-24 rounded-full border-4 border-white shadow-lg"
    />
    <div class="relative z-10">
      <h1 class="text-3xl font-extrabold text-white tracking-tight drop-shadow">
        {{ title }}
      </h1>
      <p class="text-indigo-100">{{ subtitle }}</p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  avatar: String,
  title: String,
  subtitle: String,
})
</script>
