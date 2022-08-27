<template>
  <div>
    <button @click="$router.back()" class="bg-green-500 px-6 py-2 rounded-xl text-white">گەڕاندنەوە</button>
    <div class="h-96 flex items-center justify-center">
        <form class="basis-11/12" @submit.prevent="storeOrUpdate()">
          
            <div class="grid grid-cols-3 gap-4 gap-y-10 mt-3">
                <div>
                    <p>تایتڵ</p>
                    <input v-model="form.title"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('title')" v-html="form.errors.get('title')" />

                </div>
                 
                <div>
                    <p>درێژە</p>
                    <input v-model="form.descritpion"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('descritpion')" v-html="form.errors.get('descritpion')" />

                </div>

                <div>
                    <p>نرخ</p>
                    <input v-model="form.price"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('price')" v-html="form.errors.get('price')" />

                </div>

                <div>
                    <p>ڕەنگ</p>
                    <input v-model="form.color"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('color')" v-html="form.errors.get('color')" />

                </div>


                <div>
                    <p>سایز</p>
                    <input v-model="form.size"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('size')" v-html="form.errors.get('size')" />

                </div>



                <div>
                    <p>وێنە</p>
                    <input @change="handleFile" type="file" class="bg-gray-300 px-3 py-1 focus:outline-none rounded w-full" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('file')" v-html="form.errors.get('file')" />

                </div>

                
                 

            </div>
            <button class="mt-8 bg-green-500 text-white w-2/12 pt-1 rounded-xl">
              <span v-if="isUpdate">Update</span>
              <span v-else>Add</span>
            </button>

              <button @click="deleteData()" type="button" v-if="isUpdate" class="mt-8 bg-red-500 mx-2 text-white w-2/12 pt-1 rounded-xl">
              <span >Delete</span>
            </button>
        </form>

        

        
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isUpdate:0,
      form : new this.$Form({
        title:'',
        price:'',
        color:'',
        size:'',
        descritpion:'',
        file:'',
      })
    };
  },
  methods: {
    storeOrUpdate(){
      let url =this.isUpdate ? 'admin/post/'+this.$route.params.id+'?_method=put' : 'admin/post'
      this.form.post(url).then(()=>{
        this.$Swal.fire(
          'Good job!',
          'You clicked the button!',
          'success'
        )

        !this.isUpdate?this.form.reset():null;
      })
    },

    deleteData(){
      this.$Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        this.$axios.delete('/admin/post/'+this.$route.params.id).then(()=>{
          this.$Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          this.$router.push('/admin/posts')
        })
      }
    })
    },

    handleFile(e){
      this.form.file = e.target.files[0]
    }
  },
  created() {
    let id = this.$route.params.id;
    if(id){
      this.isUpdate = true;
      this.$axios.get(`admin/post/${id}/edit`).then(({ data })=>{
        this.form.fill(data.data)
      }).catch(()=>{
        this.$router.push('/admin/posts')
      })
    }
  },
};
</script>