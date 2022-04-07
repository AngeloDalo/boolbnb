<template>
<div class="container">
    <div v-if="apartment" class="container">
        <div class="row border border-danger rounded-3 p-3">
            <div class="col-6">
                <img class="w-100 rounded-3" :src="'http://127.0.0.1:8000/storage/' + apartment.image" :alt="apartment.title">
            </div>
            <div class="col-6">
                <h3 class="font-weight-bold text-danger">{{ apartment.title }}</h3>
                <p>Price: {{ apartment.price }} &euro;</p>
                <p>Rooms: {{ apartment.rooms }}</p>
                <p>Beds: {{ apartment.beds }}</p>
                <p>Bathrooms: {{ apartment.bathrooms }}</p>
                <p>Services:
                    <span class="badge rounded-pill bg-danger" v-for="(service, index) in services" :key="index">
                        {{ service.name }}
                    </span>
                </p>
                <p>Square: {{ apartment.square }} m<sup>3</sup></p>
                <p>Address: {{ apartment.address }}</p>
                <router-link class="btn btn-danger mb-2 text-white" :to="{ name: 'contact', params: { id: apartment.id }}"> <span class="routerApartment d-none">{{ apartment.id }}</span>Contact Owner</router-link>
            </div>
        </div>
    </div>
    <div class="map" id="map" ref="mapRef"></div>
</div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';
import Axios from "axios";
  export default {
    name: 'Apartment',
    props: ['id'],
    data() {
        return {
            map: null,
            apartment: null,
            services: [],
        }
    },
    created() {
        const url = 'http://127.0.0.1:8000/api/v1/apartments/' + this.id;
        this.getApartment(url);
        // this.getServicesShow(url);
    },
    mounted() {
    },
    methods: {
        getApartment(url){
            Axios.get(url).then(
                (result) => {
                this.apartment = result.data.results.apartments;
                this.services = result.data.results.apartments.services;
                this.initializeMap()
            }).catch(error => console.log(error));
        },
        // getServicesShow: function () {
        //     const url = "http://127.0.0.1:8000/api/v1/serviceshow";
        //     Axios.get(url, {
        //     })
        //         .then((result) => {
        //             this.services = result.data.results.apartments;
        //             console.log(result.data.results.apartments);
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        initializeMap() {
            console.log(this.apartment);
            this.map = tt.map({
            key: '2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z',
            container: this.$refs.mapRef,
            center: [this.apartment.longitude, this.apartment.latitude],
            zoom: 14
        });
        new tt.Marker()
            .setLngLat([this.apartment.longitude, this.apartment.latitude])
            .addTo(this.map);
            this.map.addControl(new tt.FullscreenControl());
            this.map.addControl(new tt.NavigationControl());
        }
    }
  }
</script>

<style lang="scss" scoped>
#map {
    height: 400px;
    width: 100%;
}
</style>