<script lang="ts">
import ModalVaga from './ModalVaga.vue';
import iconeCarro from '../assets/icons/car-insurance.png'

  export default{
    name: "CardVaga",
    data (){
      return{
        exibirModal: false,
        horarios: [],
        iconeCarro
      }
    },
    props: {
      imagem: String,
      tipo: String,
      numero: Number,
      vagaId: Number,
    },
    components: {
      ModalVaga
    }
  }
</script>

<template>
  <div class="background">
    <div>
      <div class="container">
        <span class="subtitulo">Numero da vaga</span>
        <div>
          <img class="icone" :src="iconeCarro">
        </div>
      </div>
      <div class="numero-vaga">
        <h2 class="numero-valor">{{ numero}}</h2>
      </div>
      <hr class="divisao">
      <div>
        <span class="subtitulo">Tipo de vaga</span>
      </div>
      <span style="color: #c2c2c2;">{{ tipo }}</span>
    </div>
    <div>
      <button class="botao-card" @click="exibirModal = true" >Horários</button>
    </div>
  </div>

  <ModalVaga
  :exibir="exibirModal"
  :horarios="horarios"
  :VagaId ="vagaId"
  @fechar="exibirModal = false"
  :imagem="imagem"/>

</template>

<style scoped>

  .container{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .divisao{
    border: 1px solid #333;
  }

  .background{
    width: 15rem;
    background: #1a1a1a;
    border: 1px solid #333;
    border-radius: 12px;
    gap: 20px;
    padding: 12px;
  }

  .icone{
    background-color: #333;
    width: 3rem;
    padding: 5px;
    border-radius: 10px;
  }

  .subtitulo{
    font-size: 15px;
    color: #787878;
  }

  .numero-valor{
    font-size: 35px;
    margin-top: 0;
    margin-bottom: 0;
    color: #FECC02;
  }

  .botao-card{
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    border-radius: 5px;
    background-color: #FFC400;
    border: none;
    transition: all ease 0.3s;
  }

  .botao-card:hover{
    background: #FFC400;
    transform: translateY(-2px);
    box-shadow:
    0 8px 20px rgba(255,196,0,0.2);
}
</style>
