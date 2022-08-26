<template>
  <div>
    <button @click="$router.back()" class="bg-green-500 px-6 py-2 rounded-xl text-white">گەڕاندنەوە</button>
    <div class="h-96 flex items-center justify-center">
        <form class="basis-11/12" @submit.prevent="storeOrUpdate()">
          
            <div class="grid grid-cols-3 gap-4 gap-y-10 mt-3">
                <div>
                    <p>ناو</p>
                    <input v-model="form.name" name="name" type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />

                </div>

                <div>
                    <p>ئیمەل</p>
                    <input name="email" v-model="form.email" type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />

                </div>

                <div>
                    <p>وشەی تێپەڕ</p>
                    <input v-model="form.password" type="password" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                          <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                </div>

                <div>
                    <p>دووبارە کردنەوەی وشەی تێپەڕ</p>
                    <input v-model="form.password_confirmation" type="password" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" placeholder="">
                </div>

                <div>
                    <p>ژمارە مۆبایل</p>
                    <input  v-model="form.phone_number"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" >
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('phone_number')" v-html="form.errors.get('phone_number')" />
                </div>

                <div v-if="isUpdate">
                    <p>ناونیشان</p>
                    <input  v-model="form.address"  type="text" class="bg-gray-300 px-3 py-1 focus:outline-none rounded" >
                    <div class="text-red-500 text-xs mt-1" v-if="form.errors.has('address')" v-html="form.errors.get('address')" />
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
        name:'',
        email:'',
        password:'',
        password_confirmation:'',
        phone_number:'',
        address:''
      })
    };
  },
  methods: {
    storeOrUpdate(){
      let url =this.isUpdate ? 'admin/user/'+this.$route.params.id+'?_method=put' : 'admin/user'
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
        this.$axios.delete('/admin/user/'+this.$route.params.id).then(()=>{
          this.$Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          this.$router.push('/admin/user')
        })
      }
    })
    }
  },
  created() {
    let id = this.$route.params.id;
    if(id){
      this.isUpdate = true;
      this.$axios.get(`admin/user/${id}/edit`).then(({ data })=>{
        this.form.fill(data.data)
      }).catch(()=>{
        this.$router.push('/admin/users')
      })
    }
  },
};
</script>