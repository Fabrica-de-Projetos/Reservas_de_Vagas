<script setup lang="ts">
const props = defineProps<{
  imagem: string
}>()


const emit = defineEmits(['close'])
const horarios = [
  '08:00',
  '09:30',
  '11:00',
  '13:30',
  '15:00',
  '16:30',
  '18:00',
  '19:30'
]

</script>
<template>
  <div class="modal-overlay">
    <div class="modal-card">
      <div class="imagem-modal" :style="{ backgroundImage: `url(${props.imagem})` }">
        <div class="imagem-overlay"></div>
        <button class="botao-fechar" @click="emit('close')">
          ✕
        </button>
      </div>

      <div class="corpo-modal">
        <h1 class="titulo">
          Horários
          <span>disponíveis</span>
        </h1>

        <p class="subtitulo">
          Selecione o melhor horário para você.
        </p>
        <div class="tempo-grid">
          <button v-for="horario in horarios" :key="horario" class="tempo-button">
            <!-- <img class="icon" src="/img/icones/relogio.png"> -->
            {{ horario }}
          </button>
        </div>

        <div class="info-container">
          <div class="info-card">
            <div>
              <div style="display: flex; gap:10px; margin-bottom: 20px;">
                <!-- <img class="icon" src="/img/icones/dinheiro.png"> -->
                <p class="label">
                  Valor da reserva
                </p>
              </div>
              <h3 class="value amarelo-text">
                R$ 100,00
              </h3>
            </div>
          </div>
          <div class="info-card">
            <div>
              <p style="display: flex; gap: 10px; margin-bottom: 20px;" class="label">
                <!-- <img class="icon" src="/img/icones/relogio_amarelo.png"> Tempo de uso -->
              </p>
              <h3 class="value">
               90 min
              </h3>
            </div>
          </div>
        </div>
        <div class="security-box">
          <!-- <img class="icon" src="/img/icones/escudo.png"> Reserva 100% segura e confirmada na hora. -->
        </div>
        <button class="reserve-button">
          <!-- <img style="width: 2rem;" src="/img/icones/simbolo-do-calendario.png"> Reservar agora -->
        </button>
        <p class="footer-text">
          <!-- <img class="icon" src="/img/icones/cadeado.png"> -->
          Seus dados estão protegidos
        </p>
      </div>
    </div>
  </div>

</template>

<style scoped>

.modal-overlay{
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  background: rgba(0,0,0,0.75);
  backdrop-filter: blur(10px);
  z-index: 999;
}

.modal-card{
  width: 100%;
  max-width: 520px;
  max-height: 80vh;
  overflow-y: auto;
  background: #121212;
  border-radius: 28px;
  border: 1px solid rgba(255,255,255,0.06);
  box-shadow:
    0 10px 50px rgba(0,0,0,0.6),
    inset 0 1px 0 rgba(255,255,255,0.04);
  animation: showModal .35s ease;
}

.modal-card::-webkit-scrollbar{
  width: 6px;
}

.modal-card::-webkit-scrollbar-thumb{
  background: rgba(255,255,255,0.15);
  border-radius: 999px;
}

@keyframes showModal{

  from{
    opacity: 0;
    transform: translateY(20px) scale(.96);
  }
  to{
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.imagem-modal{
  position: relative;
  height: 280px;
  background-size: cover;
  background-position: center;
}


.imagem-overlay{
  position: absolute;
  inset: 0;

  background:
    linear-gradient(
      to bottom,
      rgba(0,0,0,0) 10%,
      rgba(0,0,0,0.25) 40%,
      rgba(18,18,18,0.92) 82%,
      #121212 100%
    );
}

.botao-fechar{
  position: absolute;
  top: 18px;
  right: 18px;
  width: 48px;
  height: 48px;
  border: none;
  border-radius: 50%;
  background: rgba(255,255,255,0.12);
  color: white;
  font-size: 20px;
  cursor: pointer;
  backdrop-filter: blur(8px);
  transition: .2s;
  z-index: 10;
}

.botao-fechar:hover{
  background: rgba(255,255,255,0.2);
}

.corpo-modal{
  position: relative;
  z-index: 2;
  margin-top: -30px;
  padding: 30px;
}

.titulo{
  font-size: 52px;
  line-height: 0.95;
  font-weight: 800;
  color: white;
}

.titulo span{
  color: #FFC400;
}

.subtitulo{
  margin-top: 20px;
  color: #A9A9A9;
  font-size: 20px;
}

.tempo-grid{
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
  margin-top: 34px;
}

.tempo-button{
  height: 50px;
  border-radius: 10px;
  border: 1px solid rgba(255,255,255,0.06);
  background: #1A1A1A;
  color: #d2d2d2;
  font-size: 20px;
  cursor: pointer;
  transition: .25s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}

.tempo-button:hover{
  background: #FFC400;
  color: #555555;
  transform: translateY(-2px);
  box-shadow:
    0 8px 20px rgba(255,196,0,0.2);
}


.info-container{
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-top: 28px;
}


.info-card{
  display: flex;
  align-items: center;
  padding: 20px;
  border-radius: 14px;
  background: #1A1A1A;
  border: 1px solid rgba(255,255,255,0.05);
}

.icon{
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}

.bg-amarelo{
  background: rgba(255,196,0,0.15);
}

.label{
  color: #A5A5A5;
  font-size: 15px;
  margin: 0;
}

.value{
  margin-top: 6px;
  font-size: 30px;
  margin-bottom: 0;
  line-height: 1;
  color: white;
}

.amarelo-text{
  color: #FFC400;
}

.security-box{
  display: flex;
  gap: 10px;
  margin-top: 24px;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.05);
  color: #D2D2D2;
  font-size: 16px;
}

.reserve-button{
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  padding: 10px;
  width: 100%;
  min-height: 60px;
  margin-top: 24px;
  border: none;
  border-radius: 12px;
  background: #FFC400;
  color: black;
  font-size: 18px;
  font-weight: 700;
  cursor: pointer;
  transition: .25s;
}

.reserve-button:hover{
  transform: translateY(-3px);

  box-shadow:
    0 12px 30px rgba(255,196,0,0.3);
}

/* FOOTER */

.footer-text{
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 18px;
  color: #777;
  font-size: 14px;
}



@media(max-width: 600px){

  .modal-overlay{
    padding: 14px;
  }

  .corpo-modal{
    padding: 24px;
  }

  .titulo{
    font-size: 42px;
  }

  .subtitulo{
    font-size: 18px;
  }

  .tempo-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-top: 34px;
  }

  .tempo-button{
    height: 62px;
    font-size: 20px;
  }

  .reserve-button{
    height: 66px;
    font-size: 24px;
  }

  .info-container{
    display: flex;
    flex-direction: column;
    gap: 28px;
    margin-top: 28px;
  }
}

@media(max-width: 400px){
  .tempo-grid{
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 10px;
    margin-top: 34px;
  }
}

</style>
