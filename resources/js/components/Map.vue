<template>
    <div>
        <!-- search bar  -->
        <div class="input-group my-5 justify-content-center flex-column">
            <div class="form-outline">
                <input
                    type="search"
                    id="searchBar"
                    class="form-control"
                    placeholder="Search"
                    v-model="query"
                    @keyup.enter="search()"
                    required
                />
                <p id="searchDemo"></p>
            </div>
            <div>
                <div class="col-auto my-1">
                    <select
                        class="custom-select mr-sm-2"
                        id="inlineFormCustomSelect"
                        v-model="km"
                    >
                        <option value="20" selected>20Km</option>
                        <option value="40">40Km</option>
                        <option value="60">60Km</option>
                    </select>
                </div>
                <div class="col-auto my-1">
                    <label>Number of rooms</label>
                    <select
                        class="custom-select mr-sm-2"
                        id="inlineFormCustomSelect"
                        v-model="rooms"
                    >
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                    </select>
                </div>
                <div class="col-auto my-1">
                    <label>Number of beds</label>
                    <select
                        class="custom-select mr-sm-2"
                        id="inlineFormCustomSelect"
                        v-model="beds"
                    >
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                    </select>
                </div>
                <div
                    class="form-check"
                    v-for="(service, index) in services"
                    :key="index"
                >
                    <label :for="service.id">{{ service.name }}</label>
                    <input
                        class="form-check-input position-static"
                        type="checkbox"
                        :id="service.id"
                        :value="service.name"
                        v-model="checkedServices"
                    />
                </div>
            </div>
            <button
                type="button"
                class="btn btn-primary"
                @click="search()"
                value="Submit form"
            >
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- mappa -->
        <div class="map" id="map" ref="mapRef"></div>

        <div>
            <h1>appartamenti</h1>
            <div v-if="filteredApartments.length == 0">
                <h2 v-for="apartment in KmFilterApartment" :key="apartment.id">
                    {{ apartment.title }}
                </h2>
            </div>
            <div v-else>
                <h2 v-for="apartment in filteredApartments" :key="apartment.id">
                    {{ apartment.title }}
                </h2>
            </div>
        </div>
    </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
import tts from "@tomtom-international/web-sdk-services";
import Axios from "axios";
export default {
    name: "Map",
    data() {
        return {
            map: null,
            query: null,
            position: {
                lng: 12.4829321,
                lat: 41.8933203,
            },
            apartments: [],
            KmFilterApartment: [],
            filteredApartments: [],
            services: [],
            checkedServices: [],
            apartment_services: [],
            km: 20,
            rooms: 1,
            beds: 1,
        };
    },
    created() {},
    mounted() {
        this.initializeMap(this.position.lng, this.position.lat);
        this.getApartments();
        this.getServices();
    },
    methods: {
        search: function () {
            this.KmFilterApartment = [];
            this.apartment_services = [];

            let error = document.getElementById("searchDemo");
            let message = "";
            if (this.validateSearch()) {
                this.filteredApartments = [];
                this.getCheckedServices();
                error.innerHTML = "";
                error.classList.remove("alert");
                error.classList.remove("alert-danger");
                tts.services
                    .fuzzySearch({
                        key: "2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z",
                        query: this.query,
                    })
                    .then(this.handleResults);
            } else {
                this.query = null;
                message = "adress not valid";
                error.innerHTML = message;
                error.classList.add("alert");
                error.classList.add("alert-danger");
            }
        },

        getKmApartments: function () {
            let llSearching = new tt.LngLat(
                this.position.lng,
                this.position.lat
            );
            // cicliamo sugli appartementi
            this.apartments.forEach((apartment) => {
                let llApartment = new tt.LngLat(
                    apartment.longitude,
                    apartment.latitude
                );
                let distance = llSearching.distanceTo(llApartment);
                let distanceKm = distance / 1000;
                // restituiamo gli app entro i 20 km
                if (
                    distanceKm <= this.km &&
                    apartment.rooms >= this.rooms &&
                    apartment.beds >= this.beds
                ) {
                    this.KmFilterApartment.push(apartment);
                }
            });
        },

        validateSearch: function () {
            if (this.query && isNaN(this.query)) {
                return true;
            } else {
                return false;
            }
        },

        getCheckedServices: function () {
            const url = "http://127.0.0.1:8000/api/v1/apartments/search";
            Axios.post(url, { services: this.checkedServices })
                .then((result) => {
                    this.apartment_services = result.data.results.data;
                    this.KmFilterApartment.forEach((apartment) => {
                        this.apartment_services.forEach((element) => {
                            if (
                                apartment.id == element.id &&
                                apartment.rooms >= this.rooms &&
                                apartment.beds >= this.beds
                            ) {
                                this.filteredApartments.push(apartment);
                            }
                        });
                    });
                    console.log("filteredapartment", this.filteredApartments);
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getServices: function () {
            const url = "http://127.0.0.1:8000/api/v1/services";
            Axios.get(url)
                .then((result) => {
                    this.services = result.data.results;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getApartments: function () {
            const url = "http://127.0.0.1:8000/api/v1/apartments";
            Axios.get(url)
                .then((result) => {
                    this.apartments = result.data.results;
                    // cicliamo sugli app per avere i marker
                    this.apartments.forEach((apartment) => {
                        let llApartment = new tt.LngLat(
                            apartment.longitude,
                            apartment.latitude
                        );
                        var marker = new tt.Marker()
                            .setLngLat(llApartment)
                            .addTo(this.map);
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleResults: function (result) {
            if (result.results) {
                this.position.lng = result.results[0].position.lng;
                this.position.lat = result.results[0].position.lat;
                let lnglat = result.results[0].position;
                this.moveMap(lnglat);
                this.getKmApartments();
            }
        },
        initializeMap(lng, lat) {
            this.map = tt.map({
                key: "2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z",
                container: this.$refs.mapRef,
                center: [lng, lat],
                zoom: 12,
            });
            this.map.addControl(new tt.FullscreenControl());
            this.map.addControl(new tt.NavigationControl());
        },
        moveMap: function (lnglat) {
            this.map.flyTo({
                center: lnglat,
                zoom: 12,
            });
        },
    },
};
</script>

<style lang="scss" scoped>
#map {
    height: 90vh;
    width: 90vw;
}
div.form-outline {
    width: 60%;
}
button {
    width: 10%;
}
#form1 {
    width: 100%;
}
</style>
