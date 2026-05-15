<script setup>

defineProps({
  titulo: String,
  descricao: String,
})
</script>

<template>
  <div class="card">
    <h3>{{ titulo }}</h3>
    <p>{{ descricao }}</p>
  </div>
</template>