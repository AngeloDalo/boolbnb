<template>
    <div class="cont-tot">
        <div class="title-sponsor d-flex justify-content-center">
            <h1 class="text-danger">APPARTAMENTI SELEZIONATE PER TE</h1>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="" v-if="apartments.length == 0">
                    <div
                        class="card mb-5 border border-danger col-lg-4"
                        v-for="apartment in apartments"
                        :key="apartment.id"
                    >
                        <div class="div-img">
                            <img
                                class="card-img-top p-1"
                                :src="'storage/' + apartment.image"
                                :alt="apartment.title"
                            />
                            <p class="price text-light px-3">
                                {{ apartment.price }} &euro;
                            </p>
                        </div>

                        <div class="card-body">
                            <h3
                                class="font-weight-bold text-danger font-weight-bold"
                            >
                                {{ apartment.title }}
                            </h3>

                            <p class="p-sponsor">
                                <span class="span-sponsor">Address:</span>
                                {{ apartment.address }}
                            </p>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Rooms:</span>
                                {{ apartment.rooms }}
                            </span>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Beds:</span>
                                {{ apartment.rooms }}
                            </span>
                            <span class="p-sponsor"
                                >Beds: {{ apartment.beds }}</span
                            >
                            <span class="p-sponsor">
                                <span class="span-sponsor">Bathrooms:</span>
                                {{ apartment.bathrooms }}
                            </span>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Square:</span>
                                {{ apartment.square }}
                            </span>
                            <div>
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
                <div class="" v-else>
                    <div
                        class="card mb-5 border border-danger col-lg-4"
                        v-for="apartment in apartments"
                        :key="apartment.id"
                    >
                        <div class="div-img">
                            <img
                                class="card-img-top p-1"
                                :src="'storage/' + apartment.image"
                                :alt="apartment.title"
                            />
                            <p class="price text-light px-3">
                                {{ apartment.price }} &euro;
                            </p>
                        </div>

                        <div class="card-body">
                            <h3
                                class="font-weight-bold text-danger font-weight-bold"
                            >
                                {{ apartment.title }}
                            </h3>
                            <!-- <p class="p-sponsor">
                            <span class="span-sponsor">Price:</span>
                            {{ apartment.price }} &euro;
                        </p> -->
                            <p class="p-sponsor">{{ apartment.address }},</p>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Rooms:</span>
                                {{ apartment.rooms }},
                            </span>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Beds:</span>
                                {{ apartment.beds }},
                            </span>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Bathrooms:</span>
                                {{ apartment.bathrooms }},
                            </span>
                            <span class="p-sponsor">
                                <span class="span-sponsor">Square:</span>
                                {{ apartment.square }} m<sup>3</sup>
                            </span>
                            <div>
                                <router-link
                                    class="btn btn-danger my-2"
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
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
export default {
    name: "Sponsor",

    data() {
        return {
            apartments: [],
        };
    },
    mounted() {
        this.getApartment();
    },
    methods: {
        getApartment: function () {
            const url = "http://127.0.0.1:8000/api/v1/sponsor";
            Axios.get(url, {})
                .then((result) => {
                    this.apartments = result.data.results.apartments;
                    console.log(result.data.results.apartments);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style>
.cont-tot {
    background-color: #032f6d0a;
}

.title-sponsor {
    background-color: #032f6d;
}

.div-img {
    position: relative;
}

.p-sponsor {
    margin-bottom: 0.2em !important;
}

.price {
    position: absolute;
    bottom: 10px;
    left: 40px;
    font-size: 1.5em;
    background: rgba(0, 0, 0, 0.418);
    border-radius: 20px;
}

.span-sponsor {
    font-weight: bold;
    color: #032f6d;
}
</style>
