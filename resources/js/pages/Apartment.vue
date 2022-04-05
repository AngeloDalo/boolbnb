<template>
    <div class="container">
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
                <router-link class="btn btn-danger mb-2 text-white" :to="{ name: 'contact', params: { id: apartment.id }}"> <span class="routerApartment d-none">{{ apartment.id }}</span>Contact Owner</router-link>
            </div>
        </div>
        <!-- mappa -->
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
        }
    },
    created() {
        const url = 'http://127.0.0.1:8000/api/v1/apartments/' + this.id;
        this.getApartment(url);
    },
    mounted() {
        this.initializeMap()
    },
    methods: {
        getApartment(url){
            Axios.get(url).then(
                (result) => {
                this.apartment = result.data.results.data;
            }).catch(error => console.log(error));
        },
        initializeMap() {
            this.map = tt.map({
            key: '2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z',
            container: this.$refs.mapRef,
            center: [17.277969, 40.4657082],
            zoom: 14
        });
        new tt.Marker()
            .setLngLat([17.277969, 40.4657082])
            .addTo(this.map);
            this.map.addControl(new tt.FullscreenControl());
            this.map.addControl(new tt.NavigationControl());
        }
  
        // initializeMap(lng, lat) {
        //     this.map = tt.map({
        //         key: "2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z",
        //         container: this.$refs.mapRef,
        //         center: [lng, lat],
        //         zoom: 9,
        //     });
        //     this.map.addControl(new tt.FullscreenControl());
        //     this.map.addControl(new tt.NavigationControl());
        // },
    }
  }
</script>

<style lang="scss" scoped>
#map {
    height: 400px;
    width: 100%;
}
</style>