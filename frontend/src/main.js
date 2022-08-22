import { createApp } from 'vue'
import App from './App.vue'
import './index.css'
import routes from './routes'
import axios from './axios'

const app = createApp(App)

app.use(routes)

app.config.globalProperties.$axios = {...axios}

app.mount('#app')
