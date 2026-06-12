<script lang="ts">
import FormBase from '@/components/FormBase.vue'
import InputDefault from '@/components/InputDefault.vue'
import { navegar } from '@/utils/navegar';
import { redirecionarAutenticado } from '@/utils/redirecionarAutenticado';

export default {
  name: "CadastroView",
  components: {
    FormBase,
    InputDefault
  },
  data() {
    return {
      nomeCompleto: "",
      email: "",
      senha: "",
      confirmarSenha: "",
      validacaoNome: true,
      validacaoEmail: true,
      validacaoSenha: true,
      validacaoConfirmSenha: true,
      validacaoMensagem: "",
      toast: {
        visivel: false,
        mensagem: "",
        tipo: "sucesso" as "sucesso" | "erro" | "carregando"
      }
    }
  },
  mounted() {
    redirecionarAutenticado()
  },
  methods: {

    mostrarToast(mensagem: string, tipo: "sucesso" | "erro" | "carregando", duracao = 3500) {
      this.toast.mensagem = mensagem
      this.toast.tipo = tipo
      this.toast.visivel = true

      if (tipo !== "carregando") {
        setTimeout(() => {
          this.toast.visivel = false
        }, duracao)
      }
    },

    validarNome(valor: string): boolean {
      if (valor.length == 0) {
        this.validacaoNome = false
        this.validacaoMensagem = 'O nome deve ser preenchido'
        return false
      }
      this.validacaoNome = true
      return true
    },

    validarEmail(valor: string): boolean {
      if (valor.length === 0) {
        this.validacaoEmail = false
        this.validacaoMensagem = 'O email deve ser preenchido'
        return false
      }
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      if (!regex.test(valor)) {
        this.validacaoEmail = false
        this.validacaoMensagem = 'Email inválido'
        return false
      }
      this.validacaoEmail = true
      return true
    },

    validarSenha(valor: string): boolean {
      if (valor.length === 0) {
        this.validacaoSenha = false
        this.validacaoMensagem = 'A senha deve ser informada'
        return false
      }
      this.validacaoSenha = true
      return true
    },

    validarConfirmarSenha(senhaValor: string, confirmarSenhaValor: string): boolean {
      if (confirmarSenhaValor.length === 0) {
        this.validacaoConfirmSenha = false
        this.validacaoMensagem = 'A confirmação de senha deve ser preenchida'
        return false
      }
      if (senhaValor !== confirmarSenhaValor) {
        this.validacaoConfirmSenha = false
        this.validacaoMensagem = 'As senhas não conferem'
        return false
      }
      this.validacaoConfirmSenha = true
      return true
    },

    async consumirAPI() {
      const json = JSON.stringify({
        nome_usuario: this.nomeCompleto,
        email: this.email,
        senha: this.senha,
      })

      const resposta = await fetch('https://backend-oh40.onrender.com/api/spotLivre/usuarios', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: json,
      })

      if (resposta.status === 201) {
        this.mostrarToast("Cadastro realizado com sucesso!", "sucesso")
        setTimeout(() => navegar("/login"), 1500)
        return
      }

      if (resposta.status === 401) {
        throw new Error("Não autorizado. Verifique os dados informados.")
      }

      throw new Error("Erro ao cadastrar. Tente novamente.")
    },

    async requisicaoCadastro() {
      this.validacaoNome = true
      this.validacaoEmail = true
      this.validacaoSenha = true
      this.validacaoConfirmSenha = true
      this.validacaoMensagem = ''

      if (!this.validarNome(this.nomeCompleto)) return
      if (!this.validarEmail(this.email)) return
      if (!this.validarSenha(this.senha)) return
      if (!this.validarConfirmarSenha(this.senha, this.confirmarSenha)) return

      this.mostrarToast("Processando...", "carregando")

      try {
        await this.consumirAPI()
      } catch (erro: any) {
        this.mostrarToast(erro.message ?? "Ocorreu um erro inesperado.", "erro")
      }
    }
  }
}
</script>

<template>
  <main>
    <Transition name="toast">
      <div v-if="toast.visivel" class="toast" :class="toast.tipo">
        <span v-if="toast.tipo === 'carregando'" class="spinner"></span>
        <span v-else class="toast-icone">{{ toast.tipo === 'sucesso' ? '✓' : '✕' }}</span>
        <span class="toast-mensagem">{{ toast.mensagem }}</span>
      </div>
    </Transition>

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
              <RouterLink style="color: #ffcb00; text-decoration: none" to="/login">
                fazer login
              </RouterLink>
            </div>
          </div>

          <FormBase>
            <InputDefault v-model="nomeCompleto" title="Nome Completo" type="text" input-icon="/img/icones/usuario.png"
              :required="true" :validated="validacaoNome" :error-message="validacaoMensagem" />

            <InputDefault v-model="email" title="Email" type="text" input-icon="/img/icones/email.png"
              :required="true" :validated="validacaoEmail" :error-message="validacaoMensagem" />

            <InputDefault v-model="senha" title="Senha" type="password" input-icon="/img/icones/senha.png"
              :required="true" :validated="validacaoSenha" :error-message="validacaoMensagem" />

            <InputDefault v-model="confirmarSenha" title="Confirmar Senha" type="password"
              input-icon="/img/icones/senha.png" :required="true" :validated="validacaoConfirmSenha"
              :error-message="validacaoMensagem" />

            <div class="centralizar">
              <button
                @click="requisicaoCadastro"
                type="button"
                style="margin-top: 30px"
                class="botao-modelo-principal"
                :disabled="toast.tipo === 'carregando' && toast.visivel"
              >
                Cadastrar
              </button>
            </div>
          </FormBase>
        </div>
      </section>

    </div>
  </main>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

.toast {
  position: fixed;
  top: 24px;
  right: 24px;
  z-index: 9999;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 20px;
  border-radius: 12px;
  font-family: "Montserrat", sans-serif;
  font-size: 14px;
  font-weight: 600;
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.35);
  max-width: 320px;
}

.toast.sucesso {
  background-color: #1a7a4a;
  color: #d4f5e2;
  border: 1px solid #2dba73;
}

.toast.erro {
  background-color: #7a1a1a;
  color: #fdd;
  border: 1px solid #e05555;
}

.toast.carregando {
  background-color: #1a3a5c;
  color: #cce4ff;
  border: 1px solid #3a8fd4;
}

.spinner {
  width: 18px;
  height: 18px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top-color: #cce4ff;
  border-radius: 50%;
  flex-shrink: 0;
  animation: girar 0.7s linear infinite;
}

@keyframes girar {
  to { transform: rotate(360deg); }
}

.toast-icone {
  font-size: 18px;
  flex-shrink: 0;
}

.toast-enter-active,
.toast-leave-active {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateX(40px);
}

main {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px 0;
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

.botao-modelo-principal:hover:not(:disabled) {
  box-shadow: 0px 1px 30px 10px #ffd90266;
}

.botao-modelo-principal:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  box-shadow: none;
}

.logo-spot-livre {
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

.sessao-apresentacao {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.titulo-apresentacao {
  margin-top: 20px;
  font-family: "Montserrat", sans-serif;
  font-weight: 700;
  font-size: 30px;
  color: white;
}

.mensagem-apresentacao {
  font-family: "Montserrat", sans-serif;
  font-weight: 500;
  color: #FFCB00;
  font-size: 20px;
}

.background-card {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 40px;
  gap: 70px;
}

.banner_car {
  max-width: 45vw;
}

.mb_view { display: none; }

.pc_view {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

@media (max-width: 1000px) {
  .pc_view { display: none; }
  .mb_view { display: flex; }

  .botao-modelo-principal {
    width: 100%;
    border-radius: 50px;
  }

  .toast {
    top: auto;
    bottom: 24px;
    right: 16px;
    left: 16px;
    max-width: unset;
  }
}
</style>
