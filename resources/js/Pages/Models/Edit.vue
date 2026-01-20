<template>
  <AppLayout>
    <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-xl overflow-hidden">
      <ProfileHeader
        :avatar="model.avatar"
        :title="`Editar Perfil de ${model.name}`"
        subtitle="Actualiza la información del modelo"
      />
      <ModelForm :form="form" :platforms="platforms" :submit="submit" />
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import ProfileHeader from '@/Components/ProfileHeader.vue'
import ModelForm from '@/Components/ModelForm.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  model: Object,
  platforms: Array,
})

const form = useForm({
  name: props.model.name,
  last_name: props.model.last_name,
  stage_name: props.model.stage_name,
  email: props.model.email,
  phone: props.model.phone,
  contact: props.model.contact,
  address: props.model.address,
  city: props.model.city,
  country: props.model.country,
  birth_date: props.model.birth_date,
  gender: props.model.gender,
  bio: props.model.bio,
  social_links: props.model.social_links,
  active: props.model.active,
  earnings: props.model.earnings,
  password: '',
  platform_ids: props.model.platforms.map(p => p.id),
})

function submit() {
  form.put(route('models.update', props.model.id))
}
</script>
