<template>
    <div>
       <form @submit.prevent="load">
            <div class="bg-gray-400/30 flex items-center justify-between p-2 px-4 rounded-2xl w-6/12">
                <button class="focus:outline-none mt-1 text-gray-400">
                    <i class="fas fa-search"></i>
                </button>
                <input @keyup="load()" v-model="search" type="text" class="w-11/12 bg-transparent focus:outline-none">
                <button @click="clearSearch()" v-if="search != ''"  class="focus:outline-none mt-1 text-gray-400" id="times">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </form>
    <p v-if="search != ''" class="mt-4 text-gray-400 text-sm">ئەنجامی گەڕان بۆ "{{search}}"</p>


    <div class="grid grid-cols-4 gap-10 mt-10">
        <post-cart v-for="(item, index) in data" :key="index" :post="item" />
    </div>

    </div>
</template>

<script>
import PostCart from '../../components/PostComponent.vue'
export default {
    components:{PostCart},

    computed:{
        data:{
            get(){
                return this.$store.state.post.data
            }
        },

         search:{
            get(){
                return this.$store.state.post.search
            },
            set(value){
                this.$store.state.post.search = value
            }
        }
    },

    methods: {
      load(){
        this.$store.dispatch('post/load')
      },

      clearSearch(){
        this.$store.dispatch('post/clearSearch')
      }
    },

    created() {
        this.load()
    },
}
</script>