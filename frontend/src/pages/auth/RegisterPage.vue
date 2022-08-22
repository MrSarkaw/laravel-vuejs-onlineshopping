<template>
    <div class="container">
    <form  @submit.prevent="register()" method="POST">
        <div class="w-6/12 mx-auto  shadow bg-white p-6 space-y-4 rounded-lg">
            <i class="fa-solid fa-shirt h-16  w-16 text-3xl mx-auto rounded-full bg-green-600 text-white flex items-center justify-center"></i>

            <div class="bg-gray-300 p-2 rounded-xl px-3">
                <p class="text-xs text-gray-600">ناو</p>
                <input v-model="form.name" type="text" placeholder="" name="name" class="bg-transparent focus:outline-none w-full">
                <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('password')" v-html="form.errors.get('name')" />
            </div>


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

            <div class="bg-gray-300 p-2 rounded-xl px-3">
                <p class="text-xs text-gray-600">دووبارەکردنەوی وشەی نهێنی</p>
                <input v-model="form.password_confirmation" type="password" placeholder="*******" name="password_confirmation" class="bg-transparent focus:outline-none w-full">
            </div>

            <div class="bg-gray-300 p-2 rounded-xl px-3">
                <p class="text-xs text-gray-600">ناونیشان</p>
                <input v-model="form.address" type="text" placeholder="" name="address" class="bg-transparent focus:outline-none w-full">
                <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
            </div>

            <div class="bg-gray-300 p-2 rounded-xl px-3">
                <p class="text-xs text-gray-600">ژمارەی مۆبایل</p>
                <input v-model="form.phone_number" type="text" placeholder="" name="phone_number" class="bg-transparent focus:outline-none w-full">
                <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('phone_number')" v-html="form.errors.get('phone_number')" />
            </div>
            <button class="mt-2 rounded-full bg-green-600 text-white px-4 py-1">تۆماربوون</button>
            <div class="mt-2 text-green-600 text-left">
                <router-link class="border-b-2 border-green-600 pb-2" :to='{name:"login"}'>چوونەژوورەوە</router-link>
            </div>
        </div>
    </form>

</div>
</template>

<script>
export default {
    data(){
        return{
           form: new this.$Form({
                name:'',
                email: '',
                password: '',
                password_confirmation:"",
                address:'',
                phone_number:''
            })
        }
    },
    methods: {
        register(){
           this.form.post('register', this.data).then(({data})=>{
                localStorage.setItem('token', data.token);
                this.form.reset();
           });
        }
    },
}
</script>