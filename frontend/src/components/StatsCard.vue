<script>
export default {
    name: 'StatsCard',
    props: {
        icone: String,
        destaque: String,
        label: String
    }
}
</script>

<template>
    <div class="stats-card">
        <img :src="icone" :alt="label" class="stats-icone" />
        <span class="stats-destaque">{{ destaque }}</span>
        <span class="stats-label">{{ label }}</span>
    </div>
</template>

<style scoped>
.stats-card {
    width: 100%;
    max-width: 260px;
    height: 130px;
    background-color: #1e1e1e;
    border-radius: 14px;
    border: 1px solid #2e2e2e;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-family: "Montserrat", sans-serif;
    transition: all 0.3s ease;
}

@media (max-width: 600px) {
    .stats-card {
        max-width: 100%;
    }
}

.stats-card:hover {
    border-color: #FFCB00;
}

.stats-icone {
    width: 28px;
    height: 28px;
}

.stats-destaque {
    color: #FFCB00;
    font-size: 22px;
    font-weight: 700;
}

.stats-label {
    color: white;
    font-size: 14px;
    font-weight: 500;
}
</style>