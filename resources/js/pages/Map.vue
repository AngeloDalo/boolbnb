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
                    <button
                        type="button"
                        class="btn btn-danger btn-search"
                        @click="search()"
                        value="Submit form"
                    >
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                    <p id="searchDemo" class="mt-2 p-2"></p>

                <div>
                    <div class="row d-flex justify-content-evenly my-3">
                        <div class="col-auto my-1">
                            <label class="text-white">Distance</label>
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
                            <label class="text-white">Number of rooms</label>
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
                            <label class="text-white">Number of beds</label>
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
                        <div class="col-auto">
                            <button
                                type="button"
                                class="btn btn-outline-light"
                                @click="viewServices = !viewServices"
                            >
                                <i class="bi bi-filter-circle"></i> Filter
                            </button>
                        </div>
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
                            <label class="text-white" :for="service.id">{{
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
        <div class="cont-apartments container-fluid">
            <div class="row overflow-master justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-6 overflow">
                    <div
                        class="w-100 h-100 d-flex justify-content-center align-items-center"
                        v-if="apartments.length == 0"
                    >
                        <img
                            class="globe"
                            :src="require('/public/img/time-to-travel (2).jpg')"
                            alt=""
                        />
                    </div>
                    <div v-else>
                        <div
                            class="shadow row mb-5 border border-danger rounded-3 p-3 bg-light"
                            v-for="apartment in apartments"
                            :key="apartment.id"
                        >
                            <div class="col-lg-6 col-12 div-img">
                                <img
                                    class="w-100 h-100 rounded-3"
                                    :src="'storage/' + apartment.image"
                                    :alt="apartment.title"
                                />
                                <p class="price text-light px-3">
                                    {{ apartment.price }} &euro;
                                </p>
                            </div>
                            <div class="col-lg-6 col-12">
                                <h3 class="font-weight-bold text-danger">
                                    {{ apartment.title }}
                                </h3>
                                <p>
                                    <span class="fw-bold text-uppercase"
                                        >Address:</span
                                    >
                                    {{ apartment.address }}
                                </p>
                                <p>
                                    <span class="fw-bold text-uppercase"
                                        >Rooms:</span
                                    >
                                    {{ apartment.rooms }}
                                </p>
                                <p>
                                    <span class="fw-bold text-uppercase"
                                        >Bed:</span
                                    >
                                    {{ apartment.beds }}
                                </p>
                                <p>
                                    <span class="fw-bold text-uppercase"
                                        >Square:</span
                                    >
                                    {{ apartment.square }} m<sup>3</sup>
                                </p>
                                <router-link
                                    class="btn btn-danger mb-2 text-light"
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
                <div class="col-6 d-none d-lg-block col-lg-6">
                    <div class="map" id="map" ref="mapRef"></div>
                </div>
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
            markers: [],
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
                this.apartments = [];
                this.position.lng = result.results[0].position.lng;
                this.position.lat = result.results[0].position.lat;
                let lnglat = result.results[0].position;
                this.moveMap(lnglat);
                this.getApartment();
                this.markers.forEach((marker) => {
                    marker.remove();
                });
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
        getApartment: function () {
            const url = "http://127.0.0.1:8000/api/v1/apartments/search";
            Axios.post(url, {
                rooms: this.rooms,
                beds: this.beds,
                km: this.km,
                position: this.position,
                checkedServices: this.checkedServices,
            })
                .then((result) => {
                    this.apartments = result.data.results.apartments;
                    // console.log(result.data);
                    this.apartments.forEach((apartment) => {
                        let llApartment = new tt.LngLat(
                            apartment.longitude,
                            apartment.latitude
                        );
                        let marker = new tt.Marker()
                            .setLngLat(llApartment)
                            .addTo(this.map);

                        this.markers.push(marker);
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
#map {
    margin-left: 7em;
    height: 72vh;
    box-shadow: 5px 10px 8px #888888 !important;
}

.overflow {
    height: 72vh;
    overflow-y: auto;
}

.globe {
    width: 100%;
}

::-webkit-scrollbar {
    background-color: #f8fafc;
}

.cont-apartments {
    // background-image: url("https://www.wishinnovation.it/wp-content/uploads/2021/12/PNRR-Turismo.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}

div.form-outline {
    width: 60%;
}
#searchDemo {
    width: 60%;
}

.shadow {
    box-shadow: 5px 10px 8px #888888 !important;
    margin: 0 5px;
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
.overflow-master {
    padding: 50px 100px 50px 100px;
    background-color: white;
}
.div-img {
    position: relative;
}
.price {
    position: absolute;
    bottom: 10px;
    left: 40px;
    font-size: 1.5em;
    background: rgba(0, 0, 0, 0.418);
    border-radius: 20px;
}
@media only screen and (max-width: 991px) {
    .cont-apartments {
        height: 100%;
    }
}
</style>
