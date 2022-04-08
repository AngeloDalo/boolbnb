<template>
  <div class="container mt-3">
    <div v-if="success" class="alert alert-success" role="alert">
        Message Sended!
    </div>
    <div class="border border-danger rounded-3 p-3">
        <form @submit.prevent="sendForm">
            <!-- <div class="form-check">
                <label class="form-check-label" for="number">
                    {{$route.params.id}}
                </label>
                <input checked v-model="apartment_id" class="form-check-input" type="radio" name="visible" id="number" v-bind:value="($route.params.id)">
            </div>  -->

            <div class="form-group">
                <label for="name">Name</label>
                <input v-model="name" type="text" class="form-control" id="name" name="name">
                <p class="alert alert-danger" v-for="(error, index) in errors.name" :key="index">
                    {{ error }}
                </p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input v-model="email" type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <p class="alert alert-danger" v-for="(error, index) in errors.email" :key="index">
                    {{ error }}
                </p>
            </div>
            <div class="form-group mb-3">
                <label for="message">Messaggio</label>
                <textarea v-model="text" class="form-control" id="text" name="text" rows="3"></textarea>
                <p class="alert alert-danger" v-for="(error, index) in errors.text" :key="index">
                    {{ error }}
                </p>
            </div>

            <button type="submit" class="btn btn-danger text-white">{{ sending ? "Sending mail..." : "Send" }}</button>
        <button type="text" class="btn btn-danger text-white"><a href="http://127.0.0.1:8000/" class="text-decoration-none text-white">Back Home</a></button>
        </form>
    </div>
  </div>
</template>

<script>
export default {
     name:"contact",
     data(){
         return {
             name: null,
             email: null,
             text: null,
             success: false,
             sending: false,
             apartment_id: null,
             errors: {}
         }
     },
    mounted(){
        this.apartment_id=this.$route.params.id;
        console.log(this.$route.params.id);
    },
     methods:{
         sendForm(){
             console.log(this.name,this.apartment_id);
             this.sending = true;
             this.success = false;;

             axios.post('/api/v1/contacts',
             {
                'name': this.name,
                'email': this.email,
                'text': this.text,
                'apartment_id': this.apartment_id,
             })
             .then(response=>{
                 if(!response.data.success){
                     this.success = false;
                     this.errors = response.data.errors;
                 }
                 else{
                     this.success = true;
                     this.errors = {};
                     this.name="";
                     this.email="";
                     this.text="";
                 }
                 this.sending = false;
             })
             .catch(error=>{
                 console.log(error.response.data);
                 this.sending = false;
             })
         }
     }
}
</script>

<style>
</style>