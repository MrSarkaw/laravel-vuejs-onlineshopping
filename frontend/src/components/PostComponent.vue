<template>
  <a  class="h-72 rounded-2xl overflow-hidden relative">
    <img :src="path+'posts/'+post.image" class="h-72 object-cover w-full" alt="">
    <div class="absolute h-full w-full bg-gradient-to-t from-black/80 to-transparent top-0 left-0">
        <!-- @auth
            <form action="{{ route('addToFavCart', ['id'=>$row->id, 'cart'=>0]) }}" method="post">
                @csrf
                <button class="w-9 h-9 bg-black/30 text-white  rounded-xl pt-1 relative top-2 right-2">
                    <i class="fas fa-heart {{ in_array($row->id, $favID)? 'text-red-500' :'' }}"></i>
                </button>
            </form>
        @endauth -->

        <div class="absolute bottom-3 px-2 w-full space-y-5">
            <p class="text-white text-xl">{{ post.title }}</p>

            <div v-if="post.dicount > 0" class="bg-yellow-800/80 text-center text-white text-sm flex items-center justify-between rounded-lg p-1 border-2 border-yellow-700 ">
                <del>{{post.price }} د.ع</del>
                <span>  {{post.price - (post.price * post.discount)}}  د.ع</span>
            </div>
           
            <p v-else class="bg-green-800/80 text-center text-white text-sm rounded-lg p-1 border-2 border-green-700 ">
                {{post.price}} د.ع
            </p>
            <!-- @endif -->
        </div>
    </div>
</a>

</template>
<script>
export default {
    props:['post'],
    data(){
        return{
            path:process.env.VUE_APP_URL
        }
    }
}
</script>