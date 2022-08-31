<template>
    <div class="container">
    <form @submit.prevent="login()" method="POST">
        <div class="w-6/12 mx-auto mt-10 shadow bg-white p-6 space-y-4 rounded-lg">
            <i class="fa-solid fa-shirt h-16  w-16 text-3xl mx-auto rounded-full bg-green-600 text-white flex items-center justify-center"></i>
            
            <p class="text-red-500 text-center" v-if="errorMsg != null">{{ errorMsg }}</p>
            <div class="bg-gray-300 p-2 rounded-xl px-3">
                <p class="text-xs text-gray-600">ئیمەل</p>
                <input v-model="form.email" type="text" placeholder="example@gmail.com" name="email" class="bg-transparent focus:outline-none w-full">
                <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
            </div>

            <div class="bg-gray-300 p-2 rounded-xl px-3">
                <p class="text-xs text-gray-600">وشەی نهێنی</p>
                <input v-model="form.password" type="password" placeholder="*******" name="password" class="bg-transparent focus:outline-none w-full">
                 <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
            </div>

            <button class="mt-2 rounded-full bg-green-600 text-white px-4 py-1">چوونەژوورەوە</button>
            <div class="mt-2 text-green-600 text-left">
                <router-link class="border-b-2 border-green-600 pb-2" :to="{name:'register'}">تۆماربوون</router-link>
            </div>
        </div>
    </form>

</div>
</template>

<script>
export default {
    data(){
        return{
           errorMsg:'',
           form: new this.$Form({
                email: '',
                password: ''
            }),
        }
    },
    methods: {
        login(){
           this.form.post('login', this.data).then(({data})=>{
                localStorage.setItem('token', data.token);  
                this.$store.dispatch('user/setUser', data.user);
                this.$axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token')
                this.$router.push('/admin');
           }).catch((error)=>{
            console.log(error)
                this.errorMsg = error?.response?.data?.msg || null;
           });
        }
    },
}
</script>