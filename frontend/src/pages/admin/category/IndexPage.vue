<template>
  <div>
    <router-link class="bg-green-500 px-6 py-2 rounded-xl text-white" :to="{name:'category.create'}">زیادکردن</router-link>

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
            <th scope="col" class="py-3 px-6">ناو</th>
            <th scope="col" class="py-3 px-6">کردارەکان</th>
          </tr>
        </thead>
        <tbody class="">
                <tr v-for="(item, index) in data" :key="index">
                    <th scope="col" class="py-3 px-6">
                       {{item.name}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <router-link :to="{name:'category.edit', params:{id:item.id}}">
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
            compelet:false
        }
    },
    methods: {
      loadData(){
        if(!this.compelet){
          this.page++;
          this.$axios.get('/admin/category?page='+this.page).then(({data})=>{
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