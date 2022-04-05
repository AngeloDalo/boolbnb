<template>
<div class="container mt-5">
    <div class="row border border-danger rounded-3 p-3">
        <div class="col-6">
            <img class="w-100 rounded-3" :src="'http://127.0.0.1:8000/storage/' + apartment.image" :alt="apartment.title">
        </div>
        <div class="col-6">
            <h3 class="font-weight-bold text-danger">{{ apartment.title }}</h3>
            <p>Prirce: {{ apartment.price }}</p>
            <p>Rooms: {{ apartment.rooms }}</p>
            <p>Bed: {{ apartment.beds }}</p>
            <p>Square: {{ apartment.square }}</p>
            <p>Address: {{ apartment.address }}</p>
            <p>Longitude: {{ apartment.longitude }}</p>
            <p>Latitude: {{ apartment.latitude }}</p>
            <router-link class="btn btn-danger mb-2" :to="{ name: 'contact', params: { id: apartment.id }}"> {{ apartment.id }} </router-link>
        </div>
    </div>
    <div class="map" id="map" ref="mapRef"></div>
</div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
import Axios from "axios";
  export default {
    name: 'Apartment',
    props: ['id'],
    data() {
        return {
            map: null,
            apartment: null
        }
    },
    created() {
        const url = 'http://127.0.0.1:8000/api/v1/apartments/' + this.id;
        this.getApartment(url);
        console.log(url);
    },
    methods: {
        getApartment(url){
            Axios.get(url).then(
                (result) => {
                this.apartment = result.data.results.data;
                this.initializeMap(this.apartment.longitude, this.apartment.latitude);
            }).catch(error => console.log(error));
        },
        initializeMap(lng, lat) {
            this.map = tt.map({
                key: "2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z",
                container: this.$refs.mapRef,
                center: [lng, lat],
                zoom: 9,
            });
            this.map.addControl(new tt.FullscreenControl());
            this.map.addControl(new tt.NavigationControl());
        },
    }
  }
</script>

<style lang="scss">
#map {
    width: 45%;
    height: 40vh;
}
</style>