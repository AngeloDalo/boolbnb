<template>
<div class="container-fluid">
    <div v-if="apartments.length == 0">
        <div class="row mb-5 border border-danger" v-for="apartment in apartments" :key="apartment.id">
            <div class="col-6">
                <img class="w-50" :src="'storage/' + apartment.image" :alt="apartment.title"/>
            </div>
            <div class="col-6">
                <h3 class="font-weight-bold text-danger">{{ apartment.title }}</h3>
                <p>Price: {{ apartment.price }}</p>
                <p>Rooms: {{ apartment.rooms }}</p>
                <p>Beds: {{ apartment.beds }}</p>
                <p>Bathrooms: {{ apartment.bathrooms }}</p>
                <p>Square: {{ apartment.square }}</p>
                <p>Address: {{ apartment.address }}</p>
            <router-link class="btn btn-danger mb-2"
                :to="{
                    name: 'apartment',
                    params: { id: apartment.id },
                }">
            View
            </router-link>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="row mb-5 border border-danger" v-for="apartment in apartments" :key="apartment.id">
            <div class="col-6">
                <img class="w-50" :src="'storage/' + apartment.image" :alt="apartment.title"/>
            </div>
            <div class="col-6">
                <h3 class="font-weight-bold text-danger">{{ apartment.title }}</h3>
                <p>Price: {{ apartment.price }} &euro;</p>
                <p>Rooms: {{ apartment.rooms }}</p>
                <p>Beds: {{ apartment.beds }}</p>
                <p>Bathrooms: {{ apartment.bathrooms }}</p>
                <p>Square: {{ apartment.square }} m<sup>3</sup></p>
                <p>Address: {{ apartment.address }}</p>
                <router-link class="btn btn-danger mb-2"
                    :to="{
                        name: 'apartment',
                        params: { id: apartment.id },
                    }"
                >
                View for more details
                </router-link>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Axios from "axios";
  export default {
    name: 'Sponsor',
    
    data() {
        return {
            apartments: [],
        }
    },
    mounted() {
        this.getApartment();
    },
    methods: {
        getApartment: function () {
            const url = "http://127.0.0.1:8000/api/v1/sponsor";
            Axios.get(url, {
            })
                .then((result) => {
                    this.apartments = result.data.results.apartments;
                    console.log(result.data.results.apartments);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
  }
</script>

<style>

</style>