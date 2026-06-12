<script lang="ts">
import CardVaga from '@/components/CardVaga.vue';
import { verificarToken } from '@/utils/verificarToken';

export default {
  name: "VagasView",
  components: {
    CardVaga
  },
  data() {
    return {
      counterVagas: Number,
      exibirModal: false,
      vagas: Object,
      vagasPiso1: Array.from({ length: 10 }, (_, i) => ({id: i + 1, status: 'Disponível'})),
      vagasPiso2: Array.from({ length: 10 }, (_, i) => ({id: i + 11,status: 'Disponível'})),
    }
  }, 
  mounted() {
    verificarToken()
    this.ListarVagas()
  },
  methods: {

    async ListarVagas()
    {
      const respostaApi = await fetch("https://backend-oh40.onrender.com/api/spotLivre/vagas")
      .then(resposta => {
        return resposta.json()
      })
      this.vagas = respostaApi
      console.log(this.vagas)
      return this.vagas
    }
  }
}
</script>

<template>
  <div class="container-vagas">
    <header class="topo">
      <div class="logo-spot-livre">
        <img src="/img/dsin-logo.png" alt="Logo" class="logo-dsin" />
        <span class="spot">Spot</span><span class="livre">Livre</span>
      </div>
      <div class="usuario">
        <img src="/img/icones/usuario.png" alt="User" class="icone-usuario" />
        <span>User</span>
      </div>
    </header>

    <section class="info-estacionamento">
      <img src="/img/dsin-logo.png" alt="Logo" class="logo-hero" />
      <p class="logo-hero-texto"><span class="spot">Spot</span><span class="livre">Livre</span></p>
      <h1>Nome estacionamento</h1>
      <div class="cards-info">
        <div class="card-info">
          <img src="/img/icones/carro.png" alt="Carro" class="icone-card" />
          <p class="card-label">Capacidade</p>
          <p class="card-valor">20</p>
        </div>
        <div class="card-info">
          <img src="/img/icones/carro.png" alt="Carro" class="icone-card" />
          <p class="card-label">Vagas disponíves</p>
          <p class="card-valor">20</p>
        </div>
      </div>
    </section>


    <section>
      <h2 class="titulo-piso">Piso 2</h2>
      <div class="piso">
        <div class="container-cards">
          <template v-for="array in vagas" :key="array.id">
            <div v-for="vaga in array" :key="vaga.id">
              <CardVaga
              :numero = "vaga.numero"
              :tipo = "vaga.tipo"
              :vagaId = "vaga.id"
              imagem="https://admin.cnnbrasil.com.br/wp-content/uploads/sites/12/2026/05/Neymar-Raphinha-Selecao-e1779992588361.webp?w=884"/>
            </div>
          </template>
        </div>
      </div>
    </section>

  </div>
</template>

<style scoped>
.container-cards{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}
.container-vagas {
  background-color: #000;
  color: white;
  min-height: 100vh;
  font-family: 'Montserrat', sans-serif;
}

.topo {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 24px;
  border-bottom: 1px solid #ffcc002c;
  position: sticky;
  top: 0;
  z-index: 10;
  background-color: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(5px);
}

.logo-spot-livre {
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo-dsin {
  width: 32px;
  height: 32px;
}

.spot {
  color: #fecc02;
  font-weight: 700;
  font-size: 20px;
}

.livre {
  color: white;
  font-weight: 700;
  font-size: 20px;
}

.usuario {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  color: white;
}

.icone-usuario {
  width: 26px;
  height: 26px;
  filter: invert(1);
  opacity: 0.8;
}

.info-estacionamento {
  background-image: url('/img/Background home.png');
  background-size: cover;
  background-position: center;
  position: relative;
  text-align: center;
  padding: 80px 20px 50px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.info-estacionamento::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
}

.logo-hero,
.logo-hero-texto,
.info-estacionamento h1,
.cards-info {
  position: relative;
}

.logo-hero {
  width: 48px;
  height: 48px;
}

.logo-hero-texto {
  font-size: 24px;
  margin: 0;
}

.info-estacionamento h1 {
  font-size: 26px;
  font-weight: 700;
  margin: 8px 0 20px;
}

.cards-info {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}

.card-info {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid #ffcc0050;
  border-radius: 12px;
  padding: 18px 36px;
  min-width: 160px;
  backdrop-filter: blur(4px);
  text-align: center;
}

.icone-card {
  width: 36px;
  height: 36px;
  filter: invert(1);
  opacity: 0.7;
  margin-bottom: 6px;
}

.card-label {
  color: #fecc02;
  font-size: 13px;
  font-weight: 600;
  margin: 0 0 4px;
}

.card-valor {
  font-size: 22px;
  font-weight: 700;
  margin: 0;
}

.piso {
  display: flex;
  justify-content: center;
  margin: 0 auto;
}

.titulo-piso {
  text-align: center;
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 20px;
}

.grid-vagas {
  background: #1a1a1a;
  border: 1px solid #333;
  border-radius: 12px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  padding: 12px;
}

.vaga {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  padding: 12px 6px;
  border-right: 2px solid #fecc02;
  text-align: center;
}

.vaga:nth-child(5),
.vaga:nth-child(10) {
  border-right: none;
}

.vaga:nth-child(n + 6) {
  border-top: 2px solid #fecc02;
}

.vaga-nome {
  font-size: 12px;
  font-weight: 700;
  color: #fecc02;
  margin: 0;
}

.icone-vaga {
  width: 38px;
  height: 38px;
  filter: invert(0.5);
}

.vaga-status {
  font-size: 11px;
  color: #4caf50;
  font-weight: 600;
  margin: 0;
}

.btn-horarios {
  background-color: #fecc02;
  color: #000;
  border: none;
  border-radius: 20px;
  padding: 4px 12px;
  font-size: 11px;
  font-weight: 700;
  font-family: 'Montserrat', sans-serif;
  cursor: pointer;
  transition: box-shadow 0.3s;
}

.btn-horarios:hover {
  box-shadow: 0 0 12px 4px #ffd90266;
}

@media (max-width: 576px) {
  .grid-vagas {
    grid-template-columns: repeat(2, 1fr);
  }

  .vaga:nth-child(5),
  .vaga:nth-child(10) {
    border-right: 2px solid #fecc02;
  }

  .vaga:nth-child(2n) {
    border-right: none;
  }

  .vaga:nth-child(n + 3) {
    border-top: 2px solid #fecc02;
  }
}
</style>

