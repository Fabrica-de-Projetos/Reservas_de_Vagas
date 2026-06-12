<script>
import { ref, onMounted, onUnmounted } from 'vue'

export default {
    name: 'CarrosselEstacionamentos',
    setup() {
        const indiceAtual = ref(0)
        let intervalo = null

        const fotos = ref([
            '/img/estacionamentos-carrossel/estacionamento_carrossel_1.png',
            '/img/estacionamentos-carrossel/estacionamento_carrossel_2.png',
            '/img/estacionamentos-carrossel/estacionamento_carrossel_3.png',
            '/img/estacionamentos-carrossel/estacionamento_carrossel_4.png',
            '/img/estacionamentos-carrossel/estacionamento_carrossel_5.png'
        ])

        const proximaFoto = () => {
            if (indiceAtual.value < fotos.value.length - 1) {
                indiceAtual.value++
            } else {
                indiceAtual.value = 0
            }
        }

        const fotoAnterior = () => {
            if (indiceAtual.value > 0) {
                indiceAtual.value--
            } else {
                indiceAtual.value = fotos.value.length - 1
            }
        }

        const irParaFoto = (index) => {
            indiceAtual.value = index
        }

        // inicia o carrossel automático ao montar o componente
        onMounted(() => {
            intervalo = setInterval(proximaFoto, 3000)
        })

        // limpa o intervalo ao desmontar pra não vazar memória
        onUnmounted(() => {
            clearInterval(intervalo)
        })

        return { fotos, indiceAtual, proximaFoto, fotoAnterior, irParaFoto }
    }
}
</script>

<template>
    <div class="carrossel">

        <!-- SETA ESQUERDA -->
        <button class="seta seta-esquerda" @click="fotoAnterior">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </button>

        <!-- IMAGENS -->
        <div class="carrossel-imagens">
            <img v-for="(foto, index) in fotos" :key="index" :src="foto" :alt="'Foto estacionamento ' + (index + 1)"
                class="carrossel-foto" :class="{ ativa: index === indiceAtual }" />
        </div>

        <!-- SETA DIREITA -->
        <button class="seta seta-direita" @click="proximaFoto">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5">
                <polyline points="9 18 15 12 9 6" />
            </svg>
        </button>

        <!-- BOLINHAS -->
        <div class="carrossel-dots">
            <span v-for="(foto, index) in fotos" :key="index" class="dot" :class="{ ativo: index === indiceAtual }"
                @click="irParaFoto(index)" />
        </div>

    </div>
</template>

<style scoped>
.carrossel {
    position: relative;
    width: 100%;
    max-width: 900px;
    height: 500px;
    border-radius: 16px;
    overflow: hidden;
    background-color: #2a2a2a;
}

.carrossel-imagens {
    width: 100%;
    height: 100%;
    position: relative;
}

.carrossel-foto {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease;
    border-radius: 16px;
}

.carrossel-foto.ativa {
    opacity: 1;
}

/* SETAS */
.seta {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    border-radius: 50%;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: white;
}

.seta:hover {
    background-color: #FFCB00;
    color: #1a1a1a;
}

.seta svg {
    width: 20px;
    height: 20px;
}

.seta-esquerda {
    left: 16px;
}

.seta-direita {
    right: 16px;
}

/* BOLINHAS */
.carrossel-dots {
    position: absolute;
    bottom: 16px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.ativo {
    background-color: #FFCB00;
    width: 24px;
    border-radius: 4px;
}

@media (max-width: 1000px) {
    .carrossel {
        height: 300px;
    }
}

@media (max-width: 600px) {
    .carrossel {
        height: 220px;
    }

    .seta {
        width: 36px;
        height: 36px;
    }
}
</style>