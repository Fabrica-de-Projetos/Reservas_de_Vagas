// aqui pessoal é os componente de logo e menu blz

<script setup>
import { ref } from 'vue'


const menuAberto = ref(false)

function toggleMenu() {
  menuAberto.value = !menuAberto.value
}
</script>

<template>
  <header>
    <div class="container-header">

      <div class="logo-spot-livre">
        <img class="logo-dsin" src="/img/dsin-logo.png" alt="Dsin Logo" />
        <p class="spot-livre-spot">
          <b>Spot<span class="spot-livre-livre">livre</span></b>
        </p>
      </div>

      <nav class="nav">

        <button class="menu-toggle" @click="toggleMenu">☰</button>

        <ul class="nav-list" :class="{ active: menuAberto }">
          <li><a href="#sessao-sobre-nos">Sobre nós</a></li>
        </ul>
      </nav>

    </div>
  </header>
</template>