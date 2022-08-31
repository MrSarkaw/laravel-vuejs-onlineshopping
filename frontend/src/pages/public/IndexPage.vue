<template>
    <div>
       <form >
            <div class="bg-gray-400/30 flex items-center justify-between p-2 px-4 rounded-2xl w-6/12">
                <button class="focus:outline-none mt-1 text-gray-400">
                    <i class="fas fa-search"></i>
                </button>
                <input id="search" type="text" class="w-11/12 bg-transparent focus:outline-none">
                <button  class="focus:outline-none mt-1 text-gray-400" id="times">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </form>
    <!-- @if (request('q'))
    <p class="mt-4 text-gray-400 text-sm">ئەنجامی گەڕان بۆ "{{request('q')}}"</p>
    @endif -->


    <div class="grid grid-cols-4 gap-10 mt-10">
        <post-cart v-for="(item, index) in data" :key="index" :post="item" />
    </div>

    </div>
</template>

<script>
import PostCart from '../../components/PostComponent.vue'
export default {
    components:{PostCart},
    data(){
        return{
            data:[]
        }
    },

    methods: {
        load(){
            this.$axios.get('getpost').then(({data})=>{
               this.data = data.posts
            })
        }
    },

    created() {
        this.load()
    },
}
</script>