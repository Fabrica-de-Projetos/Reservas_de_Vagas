<script lang="ts">
import FormBase from '@/components/FormBase.vue';
import InputDefault from '@/components/InputDefault.vue';
import { useRouter } from 'vue-router';

export default {
  name: "LoginView",
  components: {
    FormBase,
    InputDefault
  },
  data() {
    return {
      email: "",
      senha: "",
      validacaoMensagem: "",
      jsonRequisicao: "",
      validacaoEmail: true,
      validacaoSenha: true,
      regexEmail: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
      router: useRouter()
    }
  },
  mounted(){
    this.BuscarUsuario()
  },
  methods: {

    ValidarEmail(valor: string) {

      if (valor.length === 0) {
        this.validacaoMensagem = "O email deve ser preenchido";
        this.validacaoEmail = false
        return this.validacaoEmail
      }
      else if (!this.regexEmail.test(valor)) {
        this.validacaoMensagem = "Email inválido";
        this.validacaoEmail = false
        return this.validacaoEmail
      }

      this.validacaoEmail = true
      return this.validacaoEmail
    },

    ValidarSenha(valor: string) {
      if (valor.length === 0) {
        this.validacaoMensagem = 'A senha deve ser informada'
        this.validacaoSenha = false
        return this.validacaoSenha
      }

      this.validacaoSenha = true
      return this.validacaoSenha
    },

    async ValidarUsuario() {

      this.jsonRequisicao = JSON.stringify({
        email: this.email,
        senha: this.senha
      })

      const respostaApi = fetch("https://backend-oh40.onrender.com/api/spotLivre/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: this.jsonRequisicao
      })
        .then(response => {
          return response.json()
        })

      return respostaApi
    },

    async BuscarUsuario() {

      const respostaApi = fetch("https://backend-oh40.onrender.com/api/spotLivre/userativo",
        {
          headers: {
            "Authorization": `Bearer ${localStorage.getItem("TokenAuth")}`,
            "Accept": "application/json",
            "Content-Type": "application/json"
          }
        }
      )
      .then(resposta => {
        return resposta.json()
      })

      return respostaApi
    },

    async RequisicaoLogin() {

      if (!this.ValidarEmail(this.email)) {
        return
      }

      if (!this.ValidarSenha(this.senha)) {
        return
      }

      const respostaValidacao = await this.ValidarUsuario()
      const respostaDados = await this.BuscarUsuario()

      localStorage.setItem("TokenAuth", respostaValidacao.token)
      localStorage.setItem("NomeUsuario", respostaDados.usuario.nome)
      localStorage.setItem("EmailUsuario", respostaDados.usuario.email)
      this.router.push("/home")
    }
  }
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
          </div>
          <div>
            <FormBase>
              <InputDefault v-model="email" title="Email" type="text" input-icon="/img/icones/email.png"
                :required="true" :validated="validacaoEmail" :error-message="validacaoMensagem" />

              <InputDefault v-model="senha" title="Senha" type="password" input-icon="/img/icones/senha.png"
                :required="true" :validated="validacaoSenha" :error-message="validacaoMensagem" />

              <div class="centralizar">
                <button @click="RequisicaoLogin" type="button" style="margin-top: 30px" class="botao-modelo-principal">
                  Entrar
                </button>
              </div>
              <div style="margin-top: 15px" class="centralizar pc_view">
                <span style="color: white; margin-right: 5px">Já possui uma conta?</span>
                <RouterLink style="color: #ffcb00; text-decoration: none" to="/cadastro">
                  fazer cadastro
                </RouterLink>
              </div>
            </FormBase>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

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
}

.container {
  display: flex;
  justify-content: center;
  flex-direction: column;
  width: 100%;
  min-height: calc(100vh - 40px);
}

.sessao-cadastro {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
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
  gap: 70px;
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
}

@media (max-width: 1000px) {

  .background-card {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 40px;
    gap: 70px;
  }

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
