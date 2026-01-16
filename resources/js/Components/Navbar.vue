<template>
  <header class="navbar">
    <div class="logo">
      <a href="/">TrackModel</a>
      <!-- Nombre del usuario autenticado -->
      <p class="text-sm text-gray-300">{{ auth.user?.name }}</p>
    </div>

    <!-- Links principales -->
    <nav class="links">
      <ul>
        <li><Link :href="route('superadmin.index')">S-Admin</Link></li>
        <li><Link :href="route('admin.index')">Admin</Link></li>
        <li><Link :href="route('models.index')">Modelos</Link></li>
      </ul>
    </nav>

    <!-- Botón hamburguesa -->
    <div class="hamburger">
      <button @click="open = !open" class="p-2 rounded-md hover:bg-gray-700">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Menú desplegable -->
      <div v-if="open" class="menu">
        <ul>
          <li><Link :href="route('superadmin.index')">Dashboard</Link></li>
          <li><Link :href="route('profile.edit')">Perfil</Link></li>
          <li>
            <button @click="logout">Cerrar sesión</button>
          </li>
          <li>
            <button @click="goBack">← Regresar</button>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'
import { router, Link, usePage } from '@inertiajs/vue3'

const open = ref(false)

// Traemos los props compartidos desde Laravel (auth.user)
const { props } = usePage()
const auth = props.auth

function goBack() {
  window.history.back()
}

function logout() {
  router.post(route('logout'))
}
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #1f2937; /* Tailwind gray-800 */
  color: white;
  padding: 1rem;
}
.logo a {
  font-weight: bold;
  font-size: 1.2rem;
  color: inherit;
  text-decoration: none;
}
.logo p {
  margin-top: 0.25rem;
  font-size: 0.85rem;
  color: #d1d5db; /* Tailwind gray-300 */
}
.links ul {
  display: flex;
  gap: 1rem;
  list-style: none;
  margin: 0;
  padding: 0;
}
.links a {
  color: inherit;
  text-decoration: none;
}
.links a:hover {
  text-decoration: underline;
}
.hamburger {
  position: relative;
}
.menu {
  position: absolute;
  right: 0;
  top: 3rem;
  background-color: #121416; /* Tailwind gray-700 */
  border-radius: 0.5rem;
  padding: 0.5rem;
  box-shadow: 0 2px 6px rgba(44, 5, 5, 0.3);
}
.menu ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.menu li {
  margin: 0.5rem 0;
}
.menu a,
.menu button {
  display: block;
  width: 100%;
  text-align: left;
  color: white;
  text-decoration: none;
  padding: 0.5rem;
  border-radius: 0.25rem;
}
.menu a:hover,
.menu button:hover {
  background-color: #0d4c48; /* Tailwind gray-600 */
}
</style>
