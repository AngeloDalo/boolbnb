<template>
<div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="card ms-5">
          <img :src="'storage/' + apartment.image" class="card-img-top" :alt="apartment.title">
          <div class="card-body">
                <h3 class="font-weight-bold text-danger">{{ apartment.title }}</h3>
                <p>Prirce: {{ apartment.price }}</p>
                <p>Rooms: {{ apartment.rooms }}</p>
                <p>Bed: {{ apartment.beds }}</p>
                <p>Square: {{ apartment.square }}</p>
          </div>
        </div>
      </div>
</div>
</template>

<script>
import Axios from "axios";
  export default {
    name: 'Apartment',
    props: ['id'],
    data() {
        return {
            apartment: null
        }
    },
    created() {
        const url = 'http://127.0.0.1:8000/api/v1/apartments/' + this.id;
        this.getApartment(url);
    },
    methods: {
        getPost(url){
            Axios.get(url).then(
                (result) => {
                this.apartment = result.data.results.data;
            }).catch(error => console.log(error));
        }
    }
  }
</script>

<style lang="scss">
</style>