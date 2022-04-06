<template>
    <div class="container">
        <!-- search bar  -->
        <div
            class="input-group my-5 justify-content-center flex-column align-items-center"
        >
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
                    class="btn btn-danger"
                    @click="search()"
                    value="Submit form"
                >
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div>
                <div class="d-flex justify-content-evenly my-3">
                    <div class="col-auto my-1">
                        <label>Distance</label>
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
            </div>
        </div>

        <!-- mappa -->
        <div class="d-flex justify-content-between p-3">
            <div>
                <h1>appartamenti</h1>
                <div v-if="apartment_services.length == 0">
                    <h2>
                        Search Not Found
                    </h2>
                </div>
                <div v-else>
                    <h2
                        v-for="apartment in apartment_services"
                        :key="apartment.id"
                    >
                        {{ apartment.title }}
                    </h2>
                </div>
            </div>
            <div class="map" id="map" ref="mapRef"></div>
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
            apartment_services: [],
            apartmentDistance: [],
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
        // this.getApartments();
        this.getServices();
    },
    methods: {
        search: function () {
            this.apartment_services = [];
            let error = document.getElementById("searchDemo");
            let message = "";
            if (this.validateSearch()) {
                this.filteredApartments = [];
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
                    this.apartment_services = result.data.results.apartments;
                    this.apartmentDistance = result.data.results.distance;
                    // console.log(result.data.results.testing);
                    console.log('apartment[0]', result.data.results.apartments[0]);
                    console.log('checked', result.data.results.checked);
                    console.log('data', result.data.results.data);
                })
                .catch((error) => {
                    console.log(error.response.data);
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
                // console.log('log di handle result',result.results);
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
button {
    width: 10%;
}
#form1 {
    width: 100%;
}

.invisible {
    display: none;
}

.visible {
    display: block;
}
</style>
