import { createRouter, createWebHistory } from "vue-router";

//public
import PublicLayout from '@/layouts/PublicLayout.vue'
//auth
import LoginPage from '@/pages/auth/LoginPage.vue'
import RegisterPage from '@/pages/auth/RegisterPage.vue'


//admin
import AdminLayout from '@/layouts/AdminLayout.vue'
//users
import IndexUser from '@/pages/admin/user/IndexPage.vue'
import CreateUser from '@/pages/admin/user/CreatePage.vue'

const routes = [
    {path:'/', component:PublicLayout, children:[
        {path:'login', component:LoginPage, name:'login'},
        {path:'register', component:RegisterPage, name:'register'},
    ]},

    {path:'/admin', component:AdminLayout, children:[
        {path:'/user', component:IndexUser, name:'user.index'},
        {path:'/user/create', component:CreateUser, name:'user.create'},
    ], beforeEnter: (to, from, next) => {
        if(localStorage.getItem('token')){
            next();
        }

        next('/');
    }},
]


const router = createRouter({
    routes,
    history:createWebHistory()
})


export default router;