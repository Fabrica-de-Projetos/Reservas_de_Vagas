<script>
import { ref } from 'vue'
import ParkingCard from '@/components/ParkingCard.vue'
import StatsCard from '@/components/StatsCard.vue'
import CarrosselEstacionamentos from '@/components/CarrosselEstacionamentos.vue';

export default {
  name: 'HomeView',
  components: {
    ParkingCard,
    StatsCard,
    CarrosselEstacionamentos
  },
  setup() {
    const busca = ref('')

    const stats = ref([
      { icone: 'src/assets/icons/Pin.png', destaque: '50+', label: 'Estacionamentos' },
      { icone: 'src/assets/icons/CarIcon.png', destaque: '100+', label: 'Vagas disponíveis' },
      { icone: 'src/assets/icons/PadlockIcon.png', destaque: '100%', label: 'Reservas seguras' },
    ])

    return { busca, stats }
  }
}
</script>

<template>
  <div class="home-wrapper">

    <!-- navbar -->
    <header class="navbar">
      <div class="logo-spot-livre">
        <img class="logo-dsin" src="/img/dsin-logo.png" alt="Dsin Logo" />
        <p class="spot-livre-spot">
          <b>Spot<span class="spot-livre-livre">livre</span></b>
        </p>
      </div>
      <div class="navbar-usuario">
        <div class="avatar-circulo">
          <img src="/img/icones/usuario.png" alt="Usuário" class="avatar-icone" />
        </div>
        <span class="usuario-nome">User</span>
      </div>
    </header>

    <!-- hero banner -->
    <section class="hero-banner">
      <div class="hero-overlay">
        <h1 class="hero-titulo">
          Seja bem-vindo ao <span class="destaque-amarelo">Spot</span><span class="destaque-branco">Livre</span>!
          Encontre sua vaga em <span class="destaque-amarelo">segundos.</span>
        </h1>
      </div>
    </section>

    <!-- conteudo principal -->
    <main class="conteudo-principal">

      <!-- MAPA -->
      <section class="secao-mapa">
        <CarrosselEstacionamentos />
      </section>

      <!-- estacionamento -->
      <section class="secao-estacionamentos">
        <h2 class="secao-titulo amarelo">Estacionamentos</h2>
        <p class="secao-subtitulo">Escolha o estacionamento e reserve sua vaga em poucos cliques!</p>

        <!-- busca -->
        <div class="barra-busca-wrapper">
          <div class="barra-busca">
            <svg class="icone-lupa" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input v-model="busca" type="text" placeholder="Onde deseja reservar seu SpotLivre?" class="input-busca" />
          </div>
        </div>

        <!-- stats -->
        <div class="stats-grid">
          <StatsCard v-for="stat in stats" :key="stat.label" :icone="stat.icone" :destaque="stat.destaque"
            :label="stat.label" />
        </div>
      </section>

      <!-- vagas disponiveis -->
      <section class="secao-vagas">
        <h2 class="secao-titulo-branco">Vagas disponíveis</h2>
        <div class="cards-grid">
          <ParkingCard imagem="/img/estacionamentos/confianca-estacionamento.jpg" nome="Estacionamento confiança"
            localizacao="R. das Roseiras, 233" :avaliacao="5.0" :vagas="25" />
          <ParkingCard imagem="/img/estacionamentos/dsin-estacionamento.jpg" nome="Estacionamento DSIN"
            localizacao="R. Eugênio Pessine, 73" :avaliacao="5.0" :vagas="15" />
          <ParkingCard imagem="" nome="Nome do Estacionamento" localizacao="Localização" :avaliacao="4.5" :vagas="8" />
          <ParkingCard nome="Nome do Estacionamento" localizacao="Localização" :avaliacao="4.5" :vagas="12" />
          <ParkingCard nome="Nome do Estacionamento" localizacao="Localização" :avaliacao="4.5" :vagas="5" />
          <ParkingCard nome="Nome do Estacionamento" localizacao="Localização" :avaliacao="4.5" :vagas="30" />
        </div>
      </section>

    </main>
  </div>
</template>

<style scoped>
* {
  box-sizing: border-box;
}

.home-wrapper {
  min-height: 100vh;
  background-color: #121212;
  font-family: "Montserrat", sans-serif;
}

.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  backdrop-filter: blur(8px);
  background-color: rgba(18, 18, 18, 0.507);
  border-bottom: #121212;
  z-index: 999;
}

.logo-spot-livre {
  display: flex;
  align-items: center;
  gap: 10px;
  user-select: none;
}

.logo-dsin {
  width: 32px;
  height: 32px;
}

.spot-livre-spot {
  color: #FECC02;
  font-size: 26px;
  margin: 0;
}

.spot-livre-livre {
  color: white;
}

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

.hero-banner {
  width: 100%;
  height: 500px;
  background-image: url('@/assets/icons/backgroundhome.png');
  background-size: cover;
  background-position: center;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.hero-titulo {
  color: white;
  font-size: 40px;
  font-weight: 700;
  text-align: center;
  max-width: 700px;
  line-height: 1.4;
  margin-top: 100px;
}

.destaque-amarelo {
  color: #FFCB00;
}

.destaque-branco {
  color: white;
}

.conteudo-principal {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px 20px 80px;
  gap: 40px;
}

.secao-mapa {
  max-width: 900px;
  width: 100%;
  margin-top: 70px;
  margin-bottom: 50px;
}

.mapa-placeholder {
  width: 100%;
  height: 500px;
  background-color: white;
  border-radius: 16px;
  border: 1px solid #2e2e2e;
}

.secao-estacionamentos {
  width: 100%;
  max-width: 935px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.secao-titulo {
  font-size: 40px;
  font-weight: 700;
  margin: 0;
}

.secao-titulo-branco {
  font-size: 40px;
  font-weight: 700;
  margin-bottom: 70px;
  color: white;
}

.amarelo {
  color: #FFCB00;
}

.secao-subtitulo {
  color: #ffffff;
  font-size: 25px;
  font-weight: 700;
  margin-bottom: 60px;
  text-align: center;
}

.barra-busca-wrapper {
  width: 100%;
  margin-bottom: 60px;
}

.barra-busca {
  display: flex;
  align-items: center;
  gap: 12px;
  background-color: #1e1e1e;
  border: 1px solid #3a3a3a;
  border-radius: 50px;
  padding: 0 24px;
  height: 70px;
  width: 100%;
  transition: border-color 0.3s ease;
}

.barra-busca:focus-within {
  border-color: #FFCB00;
}

.icone-lupa {
  width: 22px;
  height: 22px;
  color: #6b6b6b;
  flex-shrink: 0;
}

.input-busca {
  background: none;
  border: none;
  outline: none;
  color: #c3c3c3;
  font-family: "Montserrat", sans-serif;
  font-size: 15px;
  width: 100%;
}

.input-busca::placeholder {
  color: #6b6b6b;
}

.stats-grid {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
  width: 100%;
  margin-bottom: 40px;
}

.secao-vagas {
  width: 100%;
  max-width: 1100px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 28px;
}

.cards-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 50px;
  width: 100%;
}

@media (max-width: 1000px) {
  .navbar {
    padding: 0 20px;
  }

  .avatar-circulo {
    width: 44px;
    height: 44px;
  }

  .avatar-icone {
    width: 24px;
    height: 24px;
  }

  .hero-banner {
    margin-top: 80px;
    height: 300px;
  }

  .hero-titulo {
    font-size: 26px;
    margin-top: 0;
  }

  .secao-titulo {
    font-size: 28px;
  }

  .secao-titulo-branco {
    font-size: 28px;
    margin-bottom: 30px;
  }

  .secao-subtitulo {
    font-size: 16px;
    margin-bottom: 30px;
  }

  .cards-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }

  .conteudo-principal {
    padding: 20px 16px 60px;
    gap: 24px;
  }

  .secao-mapa {
    margin-top: 40px;
    margin-bottom: 20px;
  }

  .mapa-placeholder {
    height: 300px;
  }

  .barra-busca {
    height: 55px;
  }

  .barra-busca-wrapper {
    margin-bottom: 30px;
  }

  .stats-grid {
    gap: 12px;
    margin-bottom: 20px;
  }
}

@media (max-width: 600px) {
  .hero-titulo {
    font-size: 20px;
  }

  .secao-titulo {
    font-size: 24px;
  }

  .secao-titulo-branco {
    font-size: 24px;
    margin-bottom: 20px;
  }

  .secao-subtitulo {
    font-size: 14px;
  }

  .cards-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .stats-grid {
    flex-direction: column;
    align-items: stretch;
  }

  .navbar {
    padding: 0 16px;
  }

  .usuario-nome {
    font-size: 14px;
  }

  .mapa-placeholder {
    height: 220px;
  }
}
</style>