<template>
    <div class="container-fluid">
        <div class="single-apartment row px-2">
            <div v-if="apartment" class="col-lg-12 col-12 rounded-3 py-4 mb-2">
                <div class="row">
                    <h3
                        class="col-12 text-uppercase fs-1 text-center py-2 font-weight-bold text-danger"
                    >
                        {{ apartment.title }}
                    </h3>
                    <div class="div-img col-12 text-center">
                        <img
                            class="shadow w-50 rounded-3"
                            :src="
                                'http://127.0.0.1:8000/storage/' +
                                apartment.image
                            "
                            :alt="apartment.title"
                        />
                    </div>
                    <div class="col-12 text-center">
                        <p class="mt-5">
                            <span class="fw-bold text-uppercase">Price:</span>
                            {{ apartment.price }} &euro;
                        </p>

                        <span class=""
                            ><span class="fw-bold text-uppercase">Rooms:</span>
                            {{ apartment.rooms }},</span
                        >
                        <span class=""
                            ><span class="fw-bold text-uppercase">Beds:</span>
                            {{ apartment.beds }},
                        </span>
                        <span class=""
                            ><span class="fw-bold text-uppercase"
                                >Bathrooms:</span
                            >
                            {{ apartment.bathrooms }},
                        </span>
                        <span
                            ><span class="fw-bold text-uppercase">Square:</span>
                            {{ apartment.square }}m<sup>3</sup></span
                        >
                        <p class="mt-3">
                            <span class="fw-bold text-uppercase"
                                >Services:</span
                            >

                            <span
                                class="badge rounded-pill bg-danger mb-3 me-2"
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
                        <p class="mt-5">
                            <span class="fw-bold text-uppercase">Address:</span>
                            {{ apartment.address }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="map" id="map" ref="mapRef"></div>
            </div>
        </div>
        <footer class="bg-light text-center text-white">
            <div class="text-center p-3 row" style="background-color: #032f6d;">
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/angelo-d-al%C3%B2-290325234/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/AngeloDalo" role="button"><i class="fab fa-github"></i></a>
                    <span>Angelo D'Alo'</span>
                </section>
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/cristian-guzman-45178b157/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/Guz117" role="button"><i class="fab fa-github"></i></a>
                    <span>Cristian Guzman</span>
                </section>
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/giandosaba/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/GiandoSaba" role="button"><i class="fab fa-github"></i></a>
                    <span>Giandomenico Sabato</span>
                </section>
                <section class="mb-4 col-2 col-md-3">
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca;" href="https://www.linkedin.com/in/daniele-simonetti-/" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333;" href="https://github.com/Daniele-Simonetti" role="button"><i class="fab fa-github"></i></a>
                    <span>Daniele Simonetti</span>
                </section>
                <p class="love">Made with <span>&hearts;</span></p>
            </div>
        </footer>
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
            // console.log(this.apartment);
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
    height: 72vh;
    width: 100%;
}

.shadow {
    box-shadow: 5px 10px 8px #888888 !important;
}
</style>
