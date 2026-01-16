<template>
  <header class="fixed top-0 left-0 w-full bg-gray-800 text-white shadow z-50">
    <div class="flex justify-between items-center px-6 py-4">
      <!-- Logo + usuario -->
      <div class="logo">
        <a href="/" class="font-bold text-xl">TrackModel</a>
        <p class="text-sm text-gray-300">{{ auth.user?.name }}</p>
      </div>

      <!-- Links principales (desktop) -->
      <nav class="hidden md:flex gap-6">
        <Link :href="route('dashboard')">Dashboard</Link>
        <Link v-if="hasRole('Super Admin') || hasRole('Admin') || hasRole('Modelo')" :href="route('models.index')">
          Modelos
        </Link>

        <Link :href="route('profile.edit')">Perfil</Link>
        <button @click="logout" class="hover:text-red-400">Salir</button>
      </nav>

      <!-- Botón hamburguesa (mobile) -->
      <div class="hamburger md:hidden relative">
        <button @click="toggleMenu" class="p-2 rounded-md hover:bg-gray-700 z-50 relative">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

        <!-- Overlay -->
        <div v-if="open" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="closeMenu"></div>

        <!-- Menú desplegable -->
        <transition name="fade">
          <div v-if="open" class="absolute right-0 top-12 bg-gray-800 bg-opacity-90 rounded-lg shadow-lg p-2 w-48 z-50">
            <ul class="text-white space-y-2">
              <li><Link :href="route('dashboard')" @click="closeMenu">Dashboard</Link></li>
              <li v-if="hasRole('Super Admin')">
                <Link :href="route('superadmin.index')" @click="closeMenu">Super Admin</Link>
              </li>
              <li v-if="hasRole('Super Admin') || hasRole('Admin') || hasRole('Modelo')">
                <Link :href="route('models.index')" @click="closeMenu">Modelos</Link>
              </li>
              <li><Link :href="route('profile.edit')" @click="closeMenu">Perfil</Link></li>
              <li><button @click="logout">Cerrar sesión</button></li>
              <li><button @click="goBack">← Regresar</button></li>
            </ul>
          </div>
        </transition>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'
import { router, Link, usePage } from '@inertiajs/vue3'

const open = ref(false)
const { props } = usePage()
const auth = props.auth

function toggleMenu() {
  open.value = !open.value
}
function closeMenu() {
  open.value = false
}
function goBack() {
  window.history.back()
}
function logout() {
  router.post(route('logout'))
}

// Helper para verificar roles
function hasRole(role) {
  return auth?.user?.roles?.some(r => r.name === role)
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
