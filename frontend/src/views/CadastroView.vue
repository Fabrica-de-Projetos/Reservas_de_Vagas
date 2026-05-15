// aqui eu chamo o css da tela de cadastro lá no finalzinho do codigo


<script setup lang="ts">
import InputDefault from '@/components/InputDefault.vue'
import { ref } from 'vue'

//Variaves que vão mudar de valor durante a execução
const nomeCompleto = ref('')
const email = ref('')
const senha = ref('')
const confirmarSenha = ref('')

const erroEmail = ref(false)
const erroSenha = ref(false)

function validarEmail(valor: string) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  return regex.test(valor)
}

function validarSenha(s: string, c: string) {
  return s === c
}

async function consumirAPI() {
  const json = JSON.stringify({
    nome_usuario: nomeCompleto.value,
    email: email.value,
    senha: senha.value,
  })

  try {
    const response = await fetch(
      'https://backend-oh40.onrender.com/api/spotLivre/usuarios',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: json,
      }
    )
    if (!response.ok) throw new Error('Erro na requisição')
    const data = await response.json()
    console.log(data)
  } catch (error) {
    console.error(error)
  }
}

function handleSubmit() {

  erroEmail.value = false
  erroSenha.value = false

  // Valida email
  if (!validarEmail(email.value)) {
    erroEmail.value = true
    return
  }

  if (!validarSenha(senha.value, confirmarSenha.value)) {
    erroSenha.value = true
    return
  }

  consumirAPI()
}
</script>

<template>
  <main>
    <div class="container">

      <section class="sessao-apresentacao mb_view">
        <div class="logo-spot-livre">
          <img class="logo-dsin" src="/img/dsin-logo.png" alt="Dsin Logo" />
          <p class="spot-livre-spot">
            <b>Spot<span class="spot-livre-livre">livre</span></b>
          </p>
        </div>
        <h1 class="titulo-apresentacao">Seja bem vindo!</h1>
        <h3 class="mensagem-apresentacao">Chegou, registrou, estacionou</h3>
      </section>

      <section class="sessao-cadastro">
        <div class="background-card">

          <div class="pc_view">
            <section class="sessao-apresentacao">
              <div class="logo-spot-livre">
                <img class="logo-dsin" src="/img/dsin-logo.png" alt="Dsin Logo" />
                <p class="spot-livre-spot">
                  <b>Spot<span class="spot-livre-livre">livre</span></b>
                </p>
              </div>
              <h1 class="titulo-apresentacao">Seja bem vindo!</h1>
              <h3 class="mensagem-apresentacao">Chegou, registrou, estacionou</h3>
            </section>

            <img src="/img/banner.svg" alt="Banner" class="banner_car" />

            <div style="margin-bottom: 30px" class="centralizar pc_view">
              <span style="color: white; margin-right: 5px">Já possui uma conta?</span>

              <RouterLink style="color: #ffcb00; text-decoration: none" to="/">
                fazer login
              </RouterLink>
            </div>
          </div>

          <div class="input-container">

            <label class="input-box">
              <span class="input-icone">
                <img src="/img/icones/usuario.png" alt="Icone Usuário" />
              </span>

              <input v-model="nomeCompleto" placeholder=" " type="text" required />
              <span class="input-descricao">Nome completo</span>
              <span style="color: #ff0000">*</span>
            </label>

            <label class="input-box" :class="{ 'input-box-error': erroEmail }">
              <span class="input-icone">
                <img src="/img/icones/email.png" alt="Icone Email" />
              </span>
              <input v-model="email" placeholder=" " type="text" required />
              <span class="input-descricao">Email</span>
              <span style="color: #ff0000">*</span>
            </label>

            <span v-show="erroEmail" class="mensagem-erro mensagem-erro-ativo">
              Digite um email válido
            </span>


            <label class="input-box" :class="{ 'input-box-error': erroSenha }">
              <span class="input-icone">
                <img src="/img/icones/senha.png" alt="Icone Senha" />
              </span>
              <input v-model="senha" placeholder=" " type="password" required />
              <span class="input-descricao">Senha</span>
              <span style="color: #ff0000">*</span>
            </label>

            <label class="input-box" :class="{ 'input-box-error': erroSenha }">
              <span class="input-icone">
                <img src="/img/icones/senha.png" alt="Icone Senha" />
              </span>
              <input v-model="confirmarSenha" placeholder=" " type="password" required />
              <span class="input-descricao">Confirme a senha</span>
              <span style="color: #ff0000">*</span>
            </label>
            <span v-show="erroSenha" class="mensagem-erro mensagem-erro-ativo">
              As senhas devem ser correspondentes
            </span>
            <!--Input de teste utilizando o componentes-->
            <InputDefault
            title="Teste"
            input-icon="/img/icones/senha.png"
            :required ="true"
            :validated="false"
            error-message="Validação falhou"/>

            <div class="centralizar">

              <button
                @click="handleSubmit"
                type="button"
                style="margin-top: 30px"
                class="botao-modelo-principal"
              >
                Cadastrar
              </button>
            </div>

          </div>
        </div>
      </section>

      <div style="margin-bottom: 30px" class="centralizar mb_view">
        <span style="color: white; margin-right: 5px">Já possui uma conta?</span>
        <RouterLink style="color: #ffcb00; text-decoration: none" to="/">
          fazer login
        </RouterLink>
      </div>

    </div>
  </main>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

* {
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box;
}

body {
    font-family: "Montserrat", sans-serif;
    font-weight: 400;
    background-color: #1d1d1d;
}

.centralizar {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row !important;
    gap: 0 !important;
}

.container {
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding-top: 30px;
}

.botao-modelo-principal {
    background-color: #FFCB00;
    width: 300px;
    height: 50px;
    font-family: "Montserrat", sans-serif;
    font-size: 16px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.botao-modelo-principal:hover {
      box-shadow: 0px 1px 30px 10px #ffd90266;
}

.logo-spot-livre{
    width: 189px;
    height: 37px;
    display: flex;
    flex-direction: row;
    gap: 10px;
    justify-content: center;
    align-items: center;
    text-align: center;
    user-select: none;
}
.logo-spot-livre .logo-dsin {
    width: 32px;
    height: 32px;
}
.spot-livre-spot {
    color: #FECC02;
    font-size: 30px;
}
.spot-livre-livre {
    color: white;
}
.sessao-apresentacao{
    margin-top: 40px;
    margin-bottom: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.titulo-apresentacao{
    margin-top: 20px;
    font-family: "Montserrat", sans-serif;
    font-weight:700;
    font-size: 30px;
    color: white;
}

.mensagem-apresentacao{
    font-family: "Montserrat", sans-serif;
    font-weight: 500;
    color: #FFCB00;
    font-size: 20px;
}

.background-card{
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
    gap: 70px;
}
/*Estilização do input*/
.input-container{
    width: 90%;
    max-width: 600px;
    padding: 20px;
    padding-top: 30px;
    background-color:#323232;
    border: solid 1px #6B6B6B;
    border-radius: 25px;
}

.banner_car {
    max-width: 45vw;
}

.mb_view {
    display: none;
}

.pc_view {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 70px;
}

.input-box{
    position: relative;
    display: flex;
    align-items: center;
    padding: 10px;
    justify-content: space-between;
    background-color: #262626;
    border: solid 1px #6B6B6B;
    border-radius: 10px;
    margin-top: 50px;
}
/*Caso de erro na validação*/
.input-box-error{
    border: solid 1px #ff1818;
    transition: all 0.3s ease;
}
.mensagem-erro{
    display: none;
}

.mensagem-erro-ativo{
    display: block;
    color: #ff1818;
}

.input-descricao{
    left: 4rem;
    color: #c3c3c3;
    position: absolute;
    background: none;
    cursor: text;
    pointer-events: none;
    transition: all 0.3s ease;
}

.input-icone{
    background: none;
}

.input-icone img{
    background: none;
    margin: 0px;
    width: 25px;
    height: 25px
}

.input-box input{
    font-size: large;
    color: #c3c3c3;
    width: 100%;
    height: 100%;
    padding: 10px;
    border: none;
    background-color: #262626;
    outline: none;
}

.input-box:focus-within{
    border-color: #FFCB00;
    transition: all 0.3s ease;
}

.input-box input:focus{
    outline: none;
}

.input-box input:focus + .input-descricao,
.input-box input:not(:placeholder-shown) + .input-descricao {
    transform: translateY(-250%);
    left: 0%;
    color: rgb(222, 222, 222)
}

@media (max-width: 1000px) {
    .pc_view {
        display: none;
    }

    .mb_view {
    display: flex;
    }

    .botao-modelo-principal {
        width: 100%;
        border-radius: 50px;
    }
}
</style>
