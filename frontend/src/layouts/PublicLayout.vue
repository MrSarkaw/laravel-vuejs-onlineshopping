<template>
    <div>
          <div class="flex justify-between items-center px-3 border-b-2">
        <div class="basis-7/12 flex justify-between">
            <a href="{{ route('index') }}" class="flex items-center space-x-2 rtl:space-x-reverse">
                <i class="fa-solid fa-shirt h-10 w-10 rounded-full bg-green-600 text-white flex items-center justify-center"></i>
                <p class="font-bold">جلوبەرگ</p>
            </a>
            <div class="space-x-5 rtl:space-x-reverse text-gray-500/70 flex items-center">
                <router-link :to="{name:'index'}" class="text-gray-700  py-4">فرۆشگا</router-link>
                <a href="" >زۆرترین فرۆش</a>
                <a href="{{ route('map') }}" class="text-gray-700  py-4 {{ Route::currentRouteName() == 'map' ? 'border-b-2 border-green-600' :'' }}">شوێن</a>
                <a href="">پەیوەندی</a>
                <a href="">دەربارە</a>
            </div>
        </div>
        <div class="basis-3/12 text-left text-xl space-x-5 rtl:space-x-reverse justify-end items-center flex text-gray-500">

            <!-- <div class="relative">
                <i onclick="showModalUser('cardModal')" class="fas fa-cart-shopping cursor-pointer"></i>
                @if(count($dtCard) > 0)
                <p class="w-3 h-3 bg-red-500 text-white text-xs text-center rounded-full absolute -top-1">
                    {{count($dtCard)}}
                </p>

                <div id="cardModal" class="absolute top-10 max-h-48 overflow-y-scroll hidden space-y-3 -left-28 w-60 bg-white p-2 rounded-xl z-50">
                    @foreach ($dtCard as $row)
                        <a href="{{ route('showpost', ['id'=>$row->post->id]) }}"  class="flex shadow rounded-lg pt-1 items-center justify-between text-xs px-2">
                            <div class="text-center basis-3/12">
                                <p>{{$row->post->title}}</p>
                                <p>{{$row->post->price}}$</p>
                            </div>
                             <div>
                                <img class="w-16 h-16 object-cover rounded-lg" src="{{ asset('posts/'.$row->post->image) }}" alt="">
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif
            </div>


            <div class="relative">
                <i onclick="showModalUser('favModal')" class="fas fa-heart cursor-pointer"></i>
                @if(count($dtFav) > 0)
                <p class="w-3 h-3 bg-red-500 text-white text-xs text-center rounded-full absolute -top-1">
                    {{count($dtFav)}}
                </p>

                <div id="favModal" class="absolute top-10 max-h-48 overflow-y-scroll hidden space-y-3 -left-28 w-60 bg-white p-2 rounded-xl z-50">
                    @foreach ($dtFav as $row)
                        <a href="{{ route('showpost', ['id'=>$row->post->id]) }}"  class="flex shadow rounded-lg pt-1 items-center justify-between text-xs px-2">
                            <div class="text-center basis-3/12">
                                <p>{{$row->post->title}}</p>
                                <p>{{$row->post->price}}$</p>
                            </div>
                             <div>
                                <img class="w-16 h-16 object-cover rounded-lg" src="{{ asset('posts/'.$row->post->image) }}" alt="">
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif
            </div> -->

           
        
            <router-link v-if="!user.id" :to='{name:"login"}'>
                <img src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" class="w-12 rounded-full" alt="">
            </router-link>
             <div @click="showModalUser = !showModalUser" v-else class="flex items-center cursor-pointer relative">
                <p class="text-sm mt-2">{{ user.name }}</p>
                <img  src="https://png.pngtree.com/png-vector/20191101/ourmid/pngtree-cartoon-color-simple-male-avatar-png-image_1934459.jpg" class="w-12 rounded-full" alt="">

                <div v-if="showModalUser" class="shadow bg-green-600 text-white  text-sm text-center p-2 rounded-xl w-full top-14 absolute">
                    <a href="">پڕۆفایل</a>
                    <button class="mt-2" @click="logout()">چوونەدەرەوە</button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex ">
        <div class="basis-3/12  border-l-2 relative">
            <div class="border-b">
                <p class="my-1  p-2 px-5">فلتەر</p>
            </div>
            <form class="px-5 text-gray-500 mb-2 text-sm space-y-4">
                <div class="border-b">
                    <p class="my-1 p-2 px-5">پۆلەکان</p>
                    <p class="mt-2 space-x-3 rtl:space-x-reverse" v-for="(item, index) in category" :key="index">
                        <input type="checkbox" @change="setSelectedData(item.id)" class="accent-green-500 text-white">
                        <span>{{item.name}}</span>
                    </p>
                </div>
                <!-- <div class="border-b pb-2">
                    <p class="my-2 p-2 px-5">مەودای نرخەکان</p>
                    <div class="w-8/12 mx-auto mt-2 flex flex-wrap justify-between">
                        <input value="{{ request('min') ? request('min') : '' }}" name="min" type="text" class="w-4/12 px-2 py-1 text-xs text-center border border-gray-300 rounded-lg focus:outline-none focus:bg-gray-300" placeholder="کەمترین">
                        <input value="{{ request('max') ? request('max') : '' }}" name="max" type="text" class="w-4/12 px-2 py-1 text-xs text-center border border-gray-300 rounded-lg focus:outline-none focus:bg-gray-300" placeholder="بەرزترین">
                        <button class="mt-4 bg-green-600 text-white px-4 py-1  rounded-xl w-full">نرخ دیاری بکە</button>
                    </div>
                </div> -->
            </form>
            <div class="border-b absolute bottom-0">
                <div class="bg-green-600 flex items-center justify-center p-4">
                    <div class="basis-1١/12 px-6 text-center py-2 rounded bg-green-500">
                        <p class="text-center text-2xl text-white">داشکاندنەکان</p>
                        <p class="text-center text-xs text-gray-200">بۆ بینینی داشکاندنەکانمان کلیل لەم بەتنە بکە و هاوڕێکانتی لێ ئاگاداربکە</p>
                        <a href="{{ route('index') }}?discount=true" class="bg-yellow-500 block py-1 mt-4 w-8/12 mx-auto text-sm rounded-lg ">بینین</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="basis-9/12 p-4 overflow-y-scroll h-[610px]">
            <router-view></router-view>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            category:[],
            showModalUser:false
        }
    },

    computed:{
        selectedCategory:{
            get(){
                return this.$store.state.post.selectedCategory
            }
        },
          user:{
            get(){
                return this.$store.state.user.data
            }
        }
    },

    methods: {
        removeToken(){
            localStorage.removeItem('token')
             this.$store.dispatch('user/setUser', [])
        },
        logout(){
            this.$axios.post('/logout').then(()=>{
                this.removeToken();
            })
        },

        setSelectedData(value){
             let index = this.selectedCategory.findIndex((element)=>{
                return element == value
             })
             

             if(index == -1){
                this.selectedCategory.push(value)
             }else{
                this.selectedCategory.splice(index, 1)
             }

             this.$store.dispatch('post/load')
        }
    },

    created(){
        this.$axios.get('/category').then(({ data })=>{
            this.category = data.category
        })
         this.$axios.get('/getuser').then(({data})=>{
            this.$store.dispatch('user/setUser', data.user)
        }).catch(()=>{
            this.removeToken();
        })
    }
}
</script>