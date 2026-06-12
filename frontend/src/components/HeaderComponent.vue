
<script lang="ts">
export default{
  name: "HeaderComponent",
  data() {
    return{
      menuAberto: false
    }
  },
  methods: {

    ColetarNome()
    {
      const usuarioNome = localStorage.getItem("NomeUsuario")
      return usuarioNome
    },

    verificarLocalStorage()
    {
      if(localStorage.getItem("TokenAuth") != null){
        return true
      }
      else
      {
        return false
      }
    },

    toggleMenu() {
      this.menuAberto = !this.menuAberto
    }
  }
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

      <div v-if="verificarLocalStorage()" class="navbar-usuario">
        <div class="avatar-circulo">
          <img src="/img/icones/usuario.png" alt="Usuário" class="avatar-icone" />
        </div>
        <span class="usuario-nome">{{ColetarNome()}}</span>
      </div>

    </div>
  </header>
</template>

<style scoped>

.navbar-usuario {
  display: flex;
  align-items: center;
  gap: 12px;
}

.avatar-circulo {
  width: 50px;
  height: 50px;
  background-color: #2e2e2e;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.avatar-icone {
  width: 30px;
  height: 30px;
}

.usuario-nome {
  color: white;
  font-size: 18px;
  font-weight: 600;
}

</style>
