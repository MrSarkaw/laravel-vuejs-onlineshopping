import { createRouter, createWebHistory } from "vue-router";

//public
import PublicLayout from '@/layouts/PublicLayout.vue'
//auth
import LoginPage from '@/pages/auth/LoginPage.vue'
import RegisterPage from '@/pages/auth/RegisterPage.vue'
//public route
import IndexPage from '@/pages/public/IndexPage.vue'

//admin
import AdminLayout from '@/layouts/AdminLayout.vue'
//users
import IndexUser from '@/pages/admin/user/IndexPage.vue'
import CreateUser from '@/pages/admin/user/CreatePage.vue'
//category
import CategoryIndex from '@/pages/admin/category/IndexPage.vue'
import  CategoryCreate from '@/pages/admin/category/CreatePage.vue'
//posts
import PostIndex from '@/pages/admin/posts/IndexPage.vue'
import  PostCreate from '@/pages/admin/posts/CreatePage.vue'

let ifNotAuth = (to, from, next)=>{
    if(!localStorage.getItem('token')){
        next();
    }

    next('/');
}

const routes = [
    {path:'/', component:PublicLayout, children:[
        {path:'login', component:LoginPage, name:'login', beforeEnter:ifNotAuth},
        {path:'register', component:RegisterPage, name:'register', beforeEnter:ifNotAuth},
        {path:'', component:IndexPage, name:'index'}
    ]},

    {path:'/admin', component:AdminLayout, children:[
        //users
        {path:'user', component:IndexUser, name:'user.index'},
        {path:'user/create', component:CreateUser, name:'user.create'},
        {path:'user/:id/edit', component:CreateUser, name:'user.edit'},
        //category
        {path:'category', component:CategoryIndex, name:'category.index'},
        {path:'category/create', component:CategoryCreate, name:'category.create'},
        {path:'category/:id/edit', component:CategoryCreate, name:'category.edit'},
        //posts
        {path:'posts', component:PostIndex, name:'posts.index'},
        {path:'posts/create', component:PostCreate, name:'posts.create'},
        {path:'posts/:id/edit', component:PostCreate, name:'posts.edit'},
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