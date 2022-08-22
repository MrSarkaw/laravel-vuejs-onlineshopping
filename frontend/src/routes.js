import { createRouter, createWebHistory } from "vue-router";

//public
import PublicLayout from '@/layouts/PublicLayout.vue'
//auth
import LoginPage from '@/pages/auth/LoginPage.vue'
const routes = [
    {path:'/', component:PublicLayout, children:[
        {path:'login', component:LoginPage, name:'login'}
    ]}
]


const router = createRouter({
    routes,
    history:createWebHistory()
})


export default router;