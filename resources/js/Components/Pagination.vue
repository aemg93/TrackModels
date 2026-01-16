<template>
  <nav class="flex items-center justify-center space-x-2 mt-4">
    <template v-for="link in links" :key="link.label">
      <span
        v-if="!link.url"
        class="px-3 py-1 text-sm text-gray-400"
        v-html="link.label"
      />
      <Link
        v-else
        :href="link.url"
        class="px-3 py-1 text-sm rounded-md"
        :class="{
          'bg-blue-600 text-white': link.active,
          'text-gray-700 hover:bg-gray-100': !link.active
        }"
        v-html="link.label"
      />
    </template>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: {
    type: Array,
    required: true,
  },
})
</script>
