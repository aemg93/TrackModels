<template>
  <ModelLayout>
    <h1 class="text-2xl font-bold mb-4">Create Model</h1>
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
        <label class="block">Password</label>
        <input v-model="form.password" type="password" class="border rounded w-full p-2" />
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Save
      </button>
    </form>
  </ModelLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import ModelLayout from '@/Layouts/ModelLayout.vue'

const form = useForm({
  name: '',
  email: '',
  password: '',
})

function submit() {
  form.post(route('models.store'))
}
</script>
