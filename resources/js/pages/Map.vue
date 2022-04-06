<template>
<div class="contain">
        <!-- search bar  -->
        <div
            class="background-serach input-group pt-5 justify-content-center flex-column align-items-center"
        >
            <div class="container d-flex flex-column align-items-center">
                <div class="form-outline d-flex">
                    <input
                        type="search"
                        id="searchBar"
                        class="form-control me-2"
                        placeholder="Search"
                        v-model="query"
                        @keyup.enter="search()"
                        required
                    />
                    <p id="searchDemo"></p>
                    <button
                        type="button"
                        class="btn btn-danger btn-search"
                        @click="search()"
                        value="Submit form"
                    >
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <div>
                    <div class="d-flex justify-content-evenly my-3">
                        <div class="col-auto my-1">
                            <label class="text-danger">Distance</label>
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
                            <label class="text-danger">Number of rooms</label>
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
                            <label class="text-danger">Number of beds</label>
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
                        <button
                            type="button"
                            class="btn btn-outline-danger"
                            @click="viewServices = !viewServices"
                        >
                            <i class="bi bi-filter-circle"></i> Filter
                        </button>
                    </div>

                    <div
                        class="d-flex row"
                        :class="viewServices == false ? 'invisible' : 'visible'"
                    >
                        <div
                            class="form-check col-3"
                            v-for="(service, index) in services"
                            :key="index"
                        >
                            <label class="text-danger" :for="service.id">{{
                                service.name
                            }}</label>
                            <input
                                class="form-check-input position-static"
                                type="checkbox"
                                :id="service.id"
                                :value="service.name"
                                v-model="checkedServices"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- mappa -->
        <h1 class="font-weight-bold text-uppercase text-danger">apartments</h1>
        <div class="container">
            <div class="row p-3">
                <div class="col-6 me-1">
                    <div v-if="apartments.length == 0">
                        <div
                            class="row mb-5 border border-danger"
                            v-for="apartment in apartments"
                            :key="apartment.id"
                        >
                            <div class="col-6">
                                <img
                                    class="w-100"
                                    :src="'storage/' + apartment.image"
                                    :alt="apartment.title"
                                />
                            </div>
                            <div class="col-6">
                                <h3 class="font-weight-bold text-danger">
                                    {{ apartment.title }}
                                </h3>
                                <p>Prirce: {{ apartment.price }}</p>
                                <p>Rooms: {{ apartment.rooms }}</p>
                                <p>Bed: {{ apartment.beds }}</p>
                                <p>Square: {{ apartment.square }}</p>
                                <router-link
                                    class="btn btn-danger mb-2"
                                    :to="{
                                        name: 'apartment',
                                        params: { id: apartment.id },
                                    }"
                                >
                                    View
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div
                            class="row mb-5 border border-danger"
                            v-for="apartment in apartments"
                            :key="apartment.id"
                        >
                            <div class="col-6">
                                <img
                                    class="w-100"
                                    :src="'storage/' + apartment.image"
                                    :alt="apartment.title"
                                />
                            </div>
                            <div class="col-6">
                                <h3 class="font-weight-bold text-danger">
                                    {{ apartment.title }}
                                </h3>
                                <p>Prirce: {{ apartment.price }}</p>
                                <p>Rooms: {{ apartment.rooms }}</p>
                                <p>Bed: {{ apartment.beds }}</p>
                                <p>Square: {{ apartment.square }}</p>
                                <router-link
                                    class="btn btn-danger mb-2"
                                    :to="{
                                        name: 'apartment',
                                        params: { id: apartment.id },
                                    }"
                                >
                                    View
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="map col-2" id="map" ref="mapRef"></div>
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
            viewServices: false,
            map: null,
            query: null,
            position: {
                lng: 12.4829321,
                lat: 41.8933203,
            },
            apartments: [],
            services: [],
            checkedServices: [],
            km: 20,
            rooms: 1,
            beds: 1,
        };
    },
    created() {},
    mounted() {
        this.initializeMap(this.position.lng, this.position.lat);
        this.getServices();
    },
    methods: {
        search: function () {
            this.apartments = [];
            let error = document.getElementById("searchDemo");
            let message = "";
            if (this.validateSearch()) {
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
        validateSearch: function () {
            if (this.query && isNaN(this.query)) {
                return true;
            } else {
                return false;
            }
        },
        gtApartment: function () {
            const url = "http://127.0.0.1:8000/api/v1/apartments/search";
            Axios.post(url, {
                rooms: this.rooms,
                beds: this.beds,
                km: this.km,
                position: this.position,
                checkedServices: this.checkedServices
            })
                .then((result) => {
                    this.apartments = result.data.results.apartments;
                    console.log(result.data);
                    this.apartments.forEach((apartment) => {
                        let llApartment = new tt.LngLat(
                            apartment.longitude,
                            apartment.latitude
                        );
                        let marker = new tt.Marker()
                            .setLngLat(llApartment)
                            .addTo(this.map);
                    });
                    console.log('data', result.data.results);
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
        handleResults: function (result) {
            if (result.results) {
                this.position.lng = result.results[0].position.lng;
                this.position.lat = result.results[0].position.lat;
                let lnglat = result.results[0].position;
                this.moveMap(lnglat);
                this.gtApartment();
            }
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
        moveMap: function (lnglat) {
            this.map.flyTo({
                center: lnglat,
                zoom: 9,
            });
        },
    },
};
</script>

<style lang="scss" scoped>
#map {
    width: 45%;
    height: 40vh;
}
div.form-outline {
    width: 60%;
}
.btn-search {
    width: 10%;
}
#form1 {
    width: 100%;
}

.invisible {
    display: none;
    height: 5px;
}

.visible {
    display: block;
    padding-bottom: 0.8em;
}

.background-serach {
    background-color: #032f6d;
}
</style>
