<template>
  <aside class="sidebar">
    <nav>
      <ul>
        <li><a href="/superadmin">Super Admin</a></li>
        <li><a href="/admin">Admin</a></li>
        <li><a href="/models">Modelos</a></li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
// Si necesitas lógica, la agregas aquí
</script>

<style scoped>
.sidebar {
  width: 250px;
  background-color: #f72116; /* Tailwind gray-800 */
  color: white;
  padding: 1rem;
}
.sidebar ul {
  list-style: none;
  padding: 0;
}
.sidebar li {
  margin: 0.5rem 0;
}
.sidebar a {
  color: inherit;
  text-decoration: none;
}
.sidebar a:hover {
  text-decoration: underline;
}
</style>
