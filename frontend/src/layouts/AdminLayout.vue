<template>
       <div id="app" dir="rtl" class="flex h-screen justify-between">
        <div class="bg-green-600 text-white h-screen basis-2/12 relative">
            <p class="text-xl text-center font-bold mt-2 border-b pb-3">جلوبەرگ</p>
             <!-- <div class="mt-4 {{in_array(Route::currentRouteName(), ['dashboard'])?'bg-gray-100 text-green-600':''}} p-2 px-3 text-center">
                <a href="{{route('dashboard')}}">داشبۆرد</a>
            </div> -->

            <div class="mt-4 p-2 px-3 text-center">
                <router-link :to="{name:'user.index'}">بەکارهێنەر</router-link>
            </div>

          <div class="mt-4 px-3 p-2 text-center">
                <router-link :to="{name:'category.index'}">بەشەکان</router-link>
            </div>
             <div class="mt-4 px-3 p-2 ">
                <router-link :to="{name:'product.index'}">کاڵاکان</router-link>
            </div>

            <!-- <div class="mt-4 px-3 p-2  {{in_array(Route::currentRouteName(), ['transaction.index'])?'bg-gray-100 text-green-600':''}} text-center">
                <a href="{{route('transaction.index')}}">فرۆشراوەکان</a>
            </div> -->
            <form @submit.prevent="logout()" class="absolute bottom-5  w-full text-center"  >
                <Button class="bg-white text-green-600 w-11/12  p-2 px-4 rounded-xl">چوونەدەرەوە </Button>
            </form>
        </div>
       <div class="basis-10/12">
        <main class="py-4 w-10/12 mx-auto">
            <div class="shadow-lg p-2 mt-3">
                <router-view></router-view>
            </div>
        </main>
       </div>

    </div>
</template>

<script>
export default {
    methods: {
        removeToken(){
            localStorage.removeItem('token')
            this.$router.push('/')
        },
        logout(){
            this.$axios.post('/logout').then(()=>{
                this.removeToken();
            })
        }
    },
    created() {
        this.$axios.get('/getuser').then(({data})=>{
            this.$store.dispatch('user/setUser', data.user)
        }).catch(()=>{
            this.removeToken();
        })
    },
}
</script>