// aqui eu chamo o css da tela de cadastro lá no finalzinho do codigo


<script setup lang="ts">
import InputDefault from '@/components/InputDefault.vue'
import { ref } from 'vue'

//Variaves que vão mudar de valor durante a execução

const nomeCompleto = ref('')
const email = ref('')
const senha = ref('')
const confirmarSenha = ref('')

const validacaoNome = ref(true)
const validacaoEmail = ref(true)
const validacaoSenha = ref(true)
const validacaoConfirmSenha = ref(true)
const validacaoMensagem = ref('')

function validarNome(valor : string) : boolean {
  if (valor.length == 0) {
    validacaoNome.value = false
    validacaoMensagem.value = 'O nome deve ser preenchido'
    return false
  }
  validacaoNome.value = true
  return true
}

function validarEmail(valor: string): boolean {

  if (valor.length === 0) {
    validacaoEmail.value = false
    validacaoMensagem.value = 'O email deve ser preenchido'
    return false
  }

  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

  if (!regex.test(valor)) {
    validacaoEmail.value = false
    validacaoMensagem.value = 'Email inválido'
    return false
  }

  validacaoEmail.value = true
  return true
}

function validarSenha(valor: string): boolean {

  if (valor.length === 0) {
    validacaoSenha.value = false
    validacaoMensagem.value = 'A senha deve ser informada'
    return false
  }

  validacaoSenha.value = true
  return true
}

function validarConfirmarSenha(
  senhaValor: string,
  confirmarSenhaValor: string
): boolean {

  if (confirmarSenhaValor.length === 0) {
    validacaoConfirmSenha.value = false
    validacaoMensagem.value =
      'A confirmação de senha deve ser preenchida'

    return false
  }

  if (senhaValor !== confirmarSenhaValor) {
    validacaoConfirmSenha.value = false
    validacaoMensagem.value = 'As senhas não conferem'

    return false
  }

  validacaoConfirmSenha.value = true
  return true
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
        headers: {
          'Content-Type': 'application/json',
        },
        body: json,
      }
    )

    if (!response.ok) {
      throw new Error('Erro na requisição')
    }

    const data = await response.json()

    console.log(data)

  } catch (error) {

    console.error(error)
    validacaoMensagem.value = 'Erro ao cadastrar usuário'

  }
}

function requisicaoCadastro() {

  validacaoNome.value = true
  validacaoEmail.value = true
  validacaoSenha.value = true
  validacaoConfirmSenha.value = true
  validacaoMensagem.value = ''

  if (!validarNome(nomeCompleto.value)) {
    return
  }

  if (!validarEmail(email.value)) {
    return
  }

  if (!validarSenha(senha.value)) {
    return
  }

  if (
    !validarConfirmarSenha(
      senha.value,
      confirmarSenha.value
    )
  ) {
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
            <!--Input de teste utilizando o componentes-->
            <InputDefault
            v-model="nomeCompleto"
            title="Nome Completo"
            type="text"
            input-icon="/img/icones/usuario.png"
            :required ="true"
            :validated="validacaoNome"
            :error-message="validacaoMensagem"/>

            <InputDefault
            v-model="email"
            title="Email"
            type="text"
            input-icon="/img/icones/email.png"
            :required ="true"
            :validated="validacaoEmail"
            :error-message="validacaoMensagem"/>

            <InputDefault
            v-model="senha"
            title="Senha"
            type="password"
            input-icon="/img/icones/senha.png"
            :required ="true"
            :validated="validacaoSenha"
            :error-message="validacaoMensagem"/>

            <InputDefault
            v-model="confirmarSenha"
            title="Confirmar Senha"
            type="password"
            input-icon="/img/icones/senha.png"
            :required ="true"
            :validated="validacaoConfirmSenha"
            :error-message="validacaoMensagem"/>



            <div class="centralizar">

              <button
                @click="requisicaoCadastro"
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

<style>

@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
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
