import { createApp } from 'vue'
import App from './App.vue'
import './index.css'
import store from './store'
import routes from './routes'
import axios from './axios'
import Form from 'vform'
Form.axios = axios

const app = createApp(App)

app.use(routes)
app.use(store)

app.config.globalProperties.$axios = {...axios}
app.config.globalProperties.$Form = Form

app.mount('#app')
