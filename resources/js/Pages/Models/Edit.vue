<template>
  <ModelLayout>
    <h1 class="text-2xl font-bold mb-4">Edit Model</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block">Name</label>
        <input v-model="form.name" type="text" class="border rounded w-full p-2" />
      </div>
      <div class="mb-4">
        <label class="block">Email</label>
        <input v-model="form.email" type="email" class="border rounded w-full p-2" />
      </div>
      <div class="mb-4">
        <label class="block">Password (optional)</label>
        <input v-model="form.password" type="password" class="border rounded w-full p-2" />
      </div>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
        Update
      </button>
    </form>
  </ModelLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import ModelLayout from '@/Layouts/ModelLayout.vue'
defineProps({ model: Object })

const form = useForm({
  name: model.name,
  email: model.email,
  password: '',
})

function submit() {
  form.put(route('models.update', model.id))
}
</script>
