
//pessoal essa parte é a seção sobre nós dos cardisinhos lá de baixo blz

<script setup>
import CardSobre from './CardSobre.vue'

const cards = [
  {
    titulo: 'Agilidade',
    descricao: 'Reserve sua vaga e economize seu tempo ao sair de casa.',
  },
  {
    titulo: 'Localização',
    descricao: 'Veja opções de estacionamentos próximos a você.',
  },
  {
    titulo: 'Praticidade',
    descricao: 'Reserve sua vaga em poucos cliques.',
  },
]
</script>

<template>
  <section id="sessao-sobre-nos" class="sessao-sobre-nos">
    <div class="container-sobre">
      <h1>Sobre nós</h1>

      <p class="descricao-sobre">
        O SpotLivre nasceu para resolver um problema comum: o tempo perdido
        procurando vagas. Nosso objetivo é trazer facilidade e praticidade
        para o motorista que deseja sair de um local sabendo que tem uma vaga
        garantida próxima ao seu destino.
      </p>

      <div class="cards-sobre">
        
        <CardSobre
          v-for="card in cards"
          :key="card.titulo"
          :titulo="card.titulo"
          :descricao="card.descricao"
        />
      </div>
    </div>
  </section>
</template>