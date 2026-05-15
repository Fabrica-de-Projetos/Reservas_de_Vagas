<script setup lang="ts">

const props = defineProps<{
  title: string,
  inputIcon: string,
  required: boolean,
  validated: boolean,
  errorMessage: string,
}>()

</script>

<template>
  <label class="input-box" :class="{ 'input-box-error': !props.validated }">
    <span class="input-icone">
      <img :src="props.inputIcon" alt="Icone Usuário" />
    </span>
    <input placeholder=" " type="text" :required="props.required"/>
    <span class="input-descricao">{{ props.title }}</span>
    <span v-if="props.required" style="color: #ff0000">*</span>
  </label>
  <div v-if="!props.validated" class="container-message-error">
    <img style="width: 4%; height: 4%;" src="../assets/icons/iconMsgErr.png">
    <span class="mensagem-erro-ativo">{{ props.errorMessage }}</span>
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

/*Caso de erro na validação*/
.input-box-error {
  border: solid 1px #ff1818;
  transition: all 0.3s ease;
}

.container-message-error{
  display: flex;
  gap: 10px;
  align-items: center;
  margin-top: 10px;
}

.mensagem-erro {
  display: none;
}

.mensagem-erro-ativo {
  display: block;
  color: #ff1818;
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
  height: 25px
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

.input-box input:focus {
  outline: none;
}

.input-box input:focus+.input-descricao,
.input-box input:not(:placeholder-shown)+.input-descricao {
  transform: translateY(-250%);
  left: 0%;
  color: rgb(222, 222, 222)
}
</style>
