//Essa parte aqui ainda é relacionada a pagina home, naquela parte de já possui uma contae etc...

<template>
  <section class="sessao-principal">
    <div class="container-comeco">

      <aside class="formulario-login-cadastro">
        <div class="spot-livre-frase">
          <p><b>Mais tempo para seus compromissos, menos tempo no volante.</b></p>
        </div>

        <div class="container-login-e-registro">
          <div class="box-botao">

            <RouterLink to="/cadastro">
              <button class="button-garanta-sua-vaga">
                <b>Garanta a sua vaga!</b>
              </button>
            </RouterLink>

            <div class="login-e-registro">
              <p>
                <RouterLink to="/login">
                  <b>Já possui uma conta? Realize o login</b>
                </RouterLink>
              </p>
            </div>
          </div>
        </div>
      </aside>

      <aside class="imagem-carro">
        <img style="width: 100%" src="/img/background.png" alt="Carro" />
      </aside>

    </div>
  </section>
</template>
