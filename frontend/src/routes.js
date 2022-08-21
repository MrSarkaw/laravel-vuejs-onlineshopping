import { createRouter, createWebHistory } from "vue-router";


import HelloWorld from '@/components/HelloWorld.vue'
import about from '@/components/aboutPage.vue'

const routes = [
    {path:'/', component:HelloWorld, name:'index'},
    {path:'/about', component:about, name:'about'},
]


const router = createRouter({
    routes,
    history:createWebHistory()
})


export default router;