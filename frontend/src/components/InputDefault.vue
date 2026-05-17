<script setup lang="ts">

import { ref } from 'vue'

const props = defineProps<{
  title: string,
  inputIcon: string,
  required: boolean,
  validated: boolean,
  errorMessage: string,
  modelValue: string,
  type?: string
}>()

const emit = defineEmits([
  'update:modelValue'
])

const esconderSenha = ref(true)

</script>

<template>

  <label
    class="input-box"
    :class="{ 'input-box-error': !props.validated }"
  >

    <span class="input-icone">
      <img :src="props.inputIcon" alt="Icone Input" />
    </span>

    <input
      placeholder=" "
      :type="
        props.type === 'password'
          ? (esconderSenha ? 'password' : 'text')
          : props.type || 'text'
      "
      :required="props.required"
      :value="props.modelValue"
      @input="emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    />

    <span class="input-descricao">
      {{ props.title }}
    </span>

    <button
      v-if="props.type === 'password'"
      type="button"
      class="button-show-password"
      @click="esconderSenha = !esconderSenha"
    >

      <img
        v-if="esconderSenha"
        src="/img/icones/visible.png"
        alt="Mostrar senha"
      >

      <img
        v-else
        src="/img/icones/unvisible.png"
        alt="Ocultar senha"
      >

    </button>

    <span
      v-if="props.required"
      class="required-symbol"
    >
      *
    </span>

  </label>

  <div
    v-if="!props.validated"
    class="container-message-error"
  >

    <img
      class="icon-error"
      src="../assets/icons/iconMsgErr.png"
      alt="Erro"
    >

    <span class="mensagem-erro-ativo">
      {{ props.errorMessage }}
    </span>

  </div>

</template>

<style scoped>

.input-box {
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

/* Caso de erro na validação */
.input-box-error {
  border: solid 1px #ff1818;
  transition: all 0.3s ease;
}

.container-message-error {
  display: flex;
  gap: 10px;
  align-items: center;
  margin-top: 10px;
}

.icon-error {
  width: 18px;
  height: 18px;
}

.mensagem-erro-ativo {
  display: block;
  color: #ff1818;
  font-size: 14px;
}

.input-descricao {
  left: 4rem;
  color: #c3c3c3;
  position: absolute;
  background: none;
  cursor: text;
  pointer-events: none;
  transition: all 0.3s ease;
}

.input-icone {
  background: none;
}

.input-icone img {
  background: none;
  margin: 0px;
  width: 25px;
  height: 25px;
}

.input-box input {
  font-size: large;
  color: #c3c3c3;
  width: 100%;
  height: 100%;
  padding: 10px;
  border: none;
  background-color: #262626;
  outline: none;
}

.input-box:focus-within {
  border-color: #FFCB00;
  transition: all 0.3s ease;
}

.input-box-error:focus-within {
  border-color: #ff1818;
}

.input-box input:focus {
  outline: none;
}

.input-box input:focus + .input-descricao,
.input-box input:not(:placeholder-shown) + .input-descricao {
  transform: translateY(-250%);
  left: 0%;
  color: rgb(222, 222, 222);
}

.required-symbol {
  color: #ff0000;
  margin-left: 8px;
  font-size: 18px;
}

.button-show-password {
  background: none;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  margin-left: 10px;
}

.button-show-password img {
  width: 22px;
  height: 22px;
}

</style>
