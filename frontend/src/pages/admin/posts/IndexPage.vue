<template>
  <div>
    <router-link class="bg-green-500 px-6 py-2 rounded-xl text-white" :to="{name:'posts.create'}">زیادکردن</router-link>

    <div class="overflow-x-auto relative mt-4">
      <table
        class="w-full text-center text-sm text-gray-500 dark:text-gray-400"
      >
        <thead
          class="
            text-xs text-gray-700
            uppercase
            bg-gray-50
            dark:bg-gray-700 dark:text-gray-400
          "
        >
          <tr>
                <th scope="col" class="py-3 px-6">
                    تایتڵ
                </th>
             
                <th scope="col" class="py-3 px-6">
                    نرخ
                </th>
                <th scope="col" class="py-3 px-6">
                    ڕەنگ
                </th>
                <th scope="col" class="py-3 px-6">
                    سایز
                </th>

                <th scope="col" class="py-3 px-6">
                    ژمارەی بەشەکان
                </th>
                <th scope="col" class="py-3 px-6">
                    وێنە
                </th>

                <th scope="col" class="py-3 px-6">
                    کاتی دروست بوون
                </th>

                <th scope="col" class="py-3 px-6">
                    کردارەکان
                </th>

            </tr>
        </thead>
        <tbody class="">
                <tr v-for="(item, index) in data" :key="index">
                    <th scope="col" class="py-3 px-6">
                        {{item.title}}
                    </th>
                  
                    <th scope="col" class="py-3 px-6">
                        {{item.price}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{item.color}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{item.size}}
                    </th>

                    <th scope="col" class="py-3 px-6">
                        {{item.categories_count}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <img :src="`${imageurl}posts/${item.image}`" class="w-32" alt="">
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{item.created_at}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                         <router-link :to="{name:'posts.edit', params:{id:item.id}}">
                            <i class="fas fa-pen"></i>
                        </router-link>
                    </th>
                </tr>
          </tbody>
      </table>
    </div>
    <button v-if="!compelet" @click="loadData()" class="bg-blue-500 text-white px-2  py-1 rounded">Load Data <i class="fas fa-arrow-down"></i></button>
  </div>
</template>

<script>
export default {
    data(){
        return{
            data:[],
            page:0,
            compelet:false,
            imageurl:process.env.VUE_APP_URL
        }
    },
    methods: {
      loadData(){
        if(!this.compelet){
          this.page++;
          this.$axios.get('/admin/post?page='+this.page).then(({data})=>{
              if(data.data.data.length > 0){
                this.data = this.data.concat(data.data.data)
              }else{
                this.compelet = true
              }
          }).catch(()=>{
              alert('error')
          })
        }
      }
    },
    created() {
        this.loadData();
    },
}
</script>