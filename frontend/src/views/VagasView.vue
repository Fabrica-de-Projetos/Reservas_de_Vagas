<script lang="ts">
import CardVaga from '@/components/CardVaga.vue';
import HeaderComponent from '@/components/HeaderComponent.vue';
import { verificarToken } from '@/utils/verificarToken';

export default {
  name: "VagasView",
  components: {
    CardVaga,
    HeaderComponent
  },
  data() {
    return {
      counterVagas: Number,
      exibirModal: false,
      dadosEstacionamento: {
        estacionamento: {
          vagas: []
        }
      },
      estacionamentoId: this.$route.params.id
    }
  },
  mounted() {
    verificarToken()
    this.BuscarDadosEstacionamento()
  },
  methods: {

    async BuscarDadosEstacionamento()
    {
      const respostaApi = await fetch(`https://backend-oh40.onrender.com/api/spotLivre/estacionamentos/${this.estacionamentoId}`)
      .then(resposta => {
        return resposta.json()
      })
      this.dadosEstacionamento = respostaApi
      return this.dadosEstacionamento
    },

    exibir()
    {
      console.log(this.dadosEstacionamento)
    }
  }
}
</script>

<template>
  <div class="container-vagas">

    <HeaderComponent/>

    <section class="container-estacionamento">
      <div>
        <span style="color: #ffc000;">Estacionamento</span>
        <h1>{{ dadosEstacionamento.estacionamento.nome }}</h1>
        <div class="container-rua">
          <img style="width: 1.5rem;" src="../assets/icons/localizacao.png" alt="">
          <span style="color: white;">{{ dadosEstacionamento.estacionamento.rua }}</span>
        </div>
      </div>

      <div class="container-info">
        <div class="cards-info">
          <div style="width: 50%;" class="card-info">
            <img src="/img/icones/carro.png" alt="Carro" class="icone-card" />
            <p class="card-label">Capacidade</p>
            <p class="card-valor">{{dadosEstacionamento.estacionamento.total_vagas}}</p>
          </div>
          <div style="width: 50%;" class="card-info">
            <img src="/img/icones/carro.png" alt="Carro" class="icone-card" />
            <p class="card-label">Vagas disponíves</p>
            <p class="card-valor">{{dadosEstacionamento.estacionamento.total_vagas}}</p>
          </div>
          <div class="container-imagem">
          </div>
        </div>
      </div>
    </section>


    <section>
      <h2 class="titulo-piso">Piso 2</h2>
      <div class="piso">
        <div class="container-cards">
              <CardVaga
              v-for="vaga in dadosEstacionamento.estacionamento.vagas"
              :key="vaga.id"
              :numero = "vaga.numero"
              :tipo = "vaga.tipo"
              :vagaId = "vaga.id"
              :imagem="dadosEstacionamento.estacionamento.imagem"/>
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

.container-estacionamento {
  background-repeat: no-repeat;
  margin-top: 100px;
  margin-left: 50px;
  margin-right: 50px;
  background-color: #1a1a1a;
  border: 1px solid #333;
  border-radius: 12px;
  position: relative;
  padding: 40px 30px ;
  display: flex;
  justify-content: space-between;
  flex-direction: row;
  align-items: center;
  gap: 8px;
}

.container-rua{
  display: flex;
  align-items: center;
  background-color: #222222;
  padding: 15px;
  border: 1px solid #333;
  border-radius: 12px;
}

.logo-hero,
.logo-hero-texto,
.container-estacionamento h1,
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

.container-estacionamento h1 {
  font-size: 26px;
  font-weight: 700;
  margin: 8px 0 20px;
}

.container-info{
  display: flex;
  flex-direction: row;
}

.cards-info {
  display: flex;
  gap: 20px;
  justify-content: center;
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

.container-imagem{
  width: 50%;
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

