<script lang="ts">
export default {
  name: "HeaderComponent",
  data() {
    return {
      menuAberto: false,
      dropdownAberto: false
    }
  },
  methods: {
    ColetarNome() {
      return localStorage.getItem("NomeUsuario")
    },

    ColetarEmail() {
      return localStorage.getItem("EmailUsuario")
    },

    verificarLocalStorage() {
      return localStorage.getItem("TokenAuth") != null
    },

    toggleMenu() {
      this.menuAberto = !this.menuAberto
    },

    toggleDropdown() {
      this.dropdownAberto = !this.dropdownAberto
    },

    fecharDropdown() {
      this.dropdownAberto = false
    },

    sair() {
      localStorage.removeItem("TokenAuth")
      localStorage.removeItem("NomeUsuario")
      this.dropdownAberto = false
      window.location.href = "/"
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

      <div v-if="verificarLocalStorage()" class="navbar-usuario" v-click-outside="fecharDropdown">
        <button class="usuario-btn" @click="toggleDropdown" :aria-expanded="dropdownAberto">
          <div class="avatar-circulo">
            <img src="/img/icones/usuario.png" alt="Usuário" class="avatar-icone" />
          </div>
          <span class="usuario-nome">{{ ColetarNome() }}</span>
          <span class="chevron" :class="{ rotacionado: dropdownAberto }">▾</span>
        </button>

        <div class="dropdown" v-if="dropdownAberto">
          <div class="dropdown-header">
            <span class="dropdown-nome">{{ ColetarNome() }}</span>
            <span class="dropdown-label">{{ ColetarEmail() }}</span>
          </div>
          <hr class="dropdown-divider" />
          <ul class="dropdown-lista">
            <li>
              <a href="/perfil" class="dropdown-item">
                <img src="../assets/icons/carro.png" alt="" class="dropdown-icone" />
                Cadastrar Veículo
              </a>
            </li>
            <li>
              <a href="/minhas-reservas" class="dropdown-item">
                <!-- <img src="/img/icones/reserva.png" alt="" class="dropdown-icone" /> -->
                Minhas reservas
              </a>
            </li>
          </ul>
          <hr class="dropdown-divider" />
          <button class="dropdown-item dropdown-sair" @click="sair">
            <!-- <img src="/img/icones/sair.png" alt="" class="dropdown-icone" /> -->
            Sair
          </button>
        </div>
      </div>

    </div>
  </header>
</template>

<style scoped>
.navbar-usuario {
  position: relative;
}

.usuario-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px 8px;
  border-radius: 8px;
  transition: background 0.2s;
}

.usuario-btn:hover {
  background: rgba(255, 255, 255, 0.1);
}

.avatar-circulo {
  width: 40px;
  height: 40px;
  background-color: #2e2e2e;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.avatar-icone {
  width: 24px;
  height: 24px;
}

.usuario-nome {
  color: white;
  font-size: 16px;
  font-weight: 600;
  white-space: nowrap;
  display: block;
}

.chevron {
  color: white;
  font-size: 14px;
  transition: transform 0.2s;
  display: block;
}

.chevron.rotacionado {
  transform: rotate(180deg);
}

.dropdown {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  min-width: 220px;
  background: #1e1e1e;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
  z-index: 100;
  overflow: hidden;
  animation: fadeDown 0.15s ease;
}

@keyframes fadeDown {
  from { opacity: 0; transform: translateY(-6px); }
  to   { opacity: 1; transform: translateY(0); }
}

.dropdown-header {
  display: flex;
  flex-direction: column;
  padding: 14px 16px 10px;
}

.dropdown-nome {
  color: white;
  font-weight: 700;
  font-size: 15px;
}

.dropdown-label {
  color: rgba(255, 255, 255, 0.45);
  font-size: 12px;
  margin-top: 2px;
}

.dropdown-divider {
  border: none;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  margin: 0;
}

.dropdown-lista {
  list-style: none;
  margin: 0;
  padding: 4px 0;
}

.dropdown-item {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  padding: 10px 16px;
  color: rgba(255, 255, 255, 0.85);
  font-size: 14px;
  text-decoration: none;
  background: none;
  border: none;
  cursor: pointer;
  text-align: left;
  transition: background 0.15s;
}

.dropdown-item:hover {
  background: rgba(255, 255, 255, 0.07);
  color: white;
}

.dropdown-icone {
  width: 18px;
  height: 18px;
  opacity: 0.7;
}

.dropdown-sair {
  color: #ff6b6b;
  padding-bottom: 12px;
}

.dropdown-sair:hover {
  background: rgba(255, 107, 107, 0.1);
  color: #ff6b6b;
}

@media (max-width: 480px) {
  .usuario-nome,
  .chevron {
    display: none;
  }

  .usuario-btn {
    padding: 4px;
  }

  .dropdown {
    right: -8px;
    min-width: 200px;
  }
}
</style>
