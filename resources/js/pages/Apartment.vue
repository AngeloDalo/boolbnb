<template>
    <div class="container-fluid">
        <div class="single-apartment row px-2">
            <div
                v-if="apartment"
                class="col-md-12 col-lg-6 border border-danger rounded-3 p-3 mb-3"
            >
                <div class="row">
                    <div class="div-img col-8">
                        <img
                            class="w-100 h-100 rounded-3"
                            :src="
                                'http://127.0.0.1:8000/storage/' +
                                apartment.image
                            "
                            :alt="apartment.title"
                        />
                        <p class="price text-light px-3">
                            {{ apartment.price }} &euro;
                        </p>
                    </div>
                    <div class="col-4">
                        <h3 class="font-weight-bold text-danger">
                            {{ apartment.title }}
                        </h3>
                        <p>Address: {{ apartment.address }}</p>

                        <span>Rooms: {{ apartment.rooms }}, </span>
                        <span>Beds: {{ apartment.beds }}, </span>
                        <span>Bathrooms: {{ apartment.bathrooms }}, </span>
                        <span
                            >Square: {{ apartment.square }} m<sup>3</sup></span
                        >
                        <p>
                            Services:
                            <span
                                class="badge rounded-pill bg-danger mb-3"
                                v-for="(service, index) in services"
                                :key="index"
                            >
                                {{ service.name }}
                            </span>
                        </p>

                        <router-link
                            class="btn btn-danger mb-2 text-white"
                            :to="{
                                name: 'contact',
                                params: { id: apartment.id },
                            }"
                        >
                            <span class="routerApartment d-none">{{
                                apartment.id
                            }}</span
                            >Contact Owner</router-link
                        >
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="map" id="map" ref="mapRef"></div>
            </div>
        </div>
    </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
import Axios from "axios";
export default {
    name: "Apartment",
    props: ["id"],
    data() {
        return {
            map: null,
            apartment: null,
            services: [],
        };
    },
    created() {
        const url = "http://127.0.0.1:8000/api/v1/apartments/" + this.id;
        this.getApartment(url);
        // this.getServicesShow(url);
    },
    mounted() {},
    methods: {
        getApartment(url) {
            Axios.get(url)
                .then((result) => {
                    this.apartment = result.data.results.apartments;
                    this.services = result.data.results.apartments.services;
                    this.initializeMap();
                })
                .catch((error) => console.log(error));
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
                key: "2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z",
                container: this.$refs.mapRef,
                center: [this.apartment.longitude, this.apartment.latitude],
                zoom: 14,
            });
            new tt.Marker()
                .setLngLat([this.apartment.longitude, this.apartment.latitude])
                .addTo(this.map);
            this.map.addControl(new tt.FullscreenControl());
            this.map.addControl(new tt.NavigationControl());
        },
    },
};
</script>

<style lang="scss" scoped>
#map {
    height: 400px;
    width: 100%;
}

.single-apartment {
    padding-top: 5%;
}
</style>
