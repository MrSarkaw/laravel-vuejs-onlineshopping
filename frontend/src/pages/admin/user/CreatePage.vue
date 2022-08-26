<template>
  <div>
    <button @click="$router.back()" class="bg-green-500 px-6 py-2 rounded-xl text-white">گەڕاندنەوە</button>
    <div class="h-96 flex items-center justify-center">
        <form class="basis-11/12" @submit.prevent="store()">
          
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
            </div>

            <button class="mt-8 bg-green-500 text-white w-2/12 pt-1 rounded-xl">add</button>
        </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form : new this.$Form({
        name:'',
        email:'',
        password:'',
        password_confirmation:'',
        phone_number:''
      })
    };
  },
  methods: {
    store(){
      this.form.post('admin/user').then(()=>{
        this.$Swal.fire(
          'Good job!',
          'You clicked the button!',
          'success'
        )

        this.form.reset();
      })
    }
  },
};
</script>