// aqui eu chamo o css, para dar os estilos da tela home do site

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/styles.css' 

const app = createApp(App)
app.use(router)
app.mount('#app')