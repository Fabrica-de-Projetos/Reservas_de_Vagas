<script>
export default {
    name: 'ParkingCard',
    props: {
        nome: String,
        localizacao: String,
        avaliacao: Number,
        vagas: Number,
        imagem: String
    }
}
</script>

<template>
    <div class="parking-card">
        <div class="card-imagem">
            <img v-if="imagem" :src="imagem" :alt="nome" />
            <div v-else class="card-imagem-placeholder"></div>
            <span class="badge-vagas">{{ vagas }} Vagas</span>
        </div>
        <div class="card-info">
            <h3 class="card-nome">{{ nome }}</h3>
            <p class="card-localizacao">
                <img src="@/assets/icons/PinIcon.png" alt="Localização" class="icone-pin" />
                {{ localizacao }}
            </p>
            <div class="card-avaliacao">
                <span class="estrela">★</span>
                <span class="nota">{{ avaliacao }}</span>
            </div>
            <button class="botao-reservar">
                <b>Reservar vaga</b>
            </button>
        </div>
    </div>
</template>

<style scoped>
.parking-card {
    width: 100%;
    background-color: #1a1a1a;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #2e2e2e;
    transition: all 0.3s ease;
    font-family: "Montserrat", sans-serif;
}

.parking-card:hover {
    border-color: #FFCB00;
    transform: translateY(-4px);
    box-shadow: 0px 8px 30px rgba(255, 203, 0, 0.15);
}

.card-imagem {
    position: relative;
    width: 100%;
    height: 180px;
    background-color: #2a2a2a;
}

.card-imagem img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.card-imagem-placeholder {
    width: 100%;
    height: 100%;
    
}

.badge-vagas {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #ffcc0079;
    color: #1a1a1a;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    font-family: "Montserrat", sans-serif;
}

.card-info {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.card-nome {
    color: white;
    font-size: 15px;
    font-weight: 700;
    margin: 0;
}

.card-localizacao {
    color: #c3c3c3;
    font-size: 13px;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}

.icone-pin {
    width: 14px;
    height: 14px;
}

.card-avaliacao {
    display: flex;
    align-items: center;
    gap: 6px;
    background-color: #2a2a2a;
    width: fit-content;
    padding: 4px 10px;
    border-radius: 20px;
}

.estrela {
    color: #FFCB00;
    font-size: 14px;
}

.nota {
    color: white;
    font-size: 13px;
    font-weight: 600;
}

.botao-reservar {
    background-color: #FFCB00;
    width: 100%;
    height: 44px;
    font-family: "Montserrat", sans-serif;
    font-size: 14px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 4px;
    color: #1a1a1a;
}

.botao-reservar:hover {
    box-shadow: 0px 1px 30px 10px #ffd90266;
}
</style>