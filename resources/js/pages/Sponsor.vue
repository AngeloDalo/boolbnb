<template>
    <div class="cont-tot">
        <div class="title-sponsor d-flex justify-content-center">
            <h1 class="text-danger my-3">SELECTED FOR YOU</h1>
        </div>

        <div class="container-fluid py-4 bg-img testing">
            <div
                class="row justify-content-center"
                v-if="apartments.length != 0"
            >
                <div
                    class="shadow card col-sm-12 col-md-4 col-lg-3 border-danger border m-3"
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
                        <span class="p-sponsor"
                            ><span class="span-sponsor">Rooms:</span>
                            {{ apartment.rooms }}</span
                        >
                        <span class="p-sponsor mx-2"
                            ><span class="span-sponsor">Beds:</span>
                            {{ apartment.beds }}</span
                        >
                        <span class="p-sponsor"
                            ><span class="span-sponsor">Bathrooms:</span>
                            {{ apartment.bathrooms }}</span
                        >
                        <br />
                        <span class="p-sponsor"
                            ><span class="span-sponsor">Square:</span>
                            {{ apartment.square }} m<sup>3</sup></span
                        >
                    </div>
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
    height: 100vh;
    background-repeat: no-repeat;
    background-size: cover;
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

.shadow {
    box-shadow: 5px 10px 8px #888888 !important;
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

@media only screen and (max-width: 991px) {
    .cont-tot {
        height: 100%;
    }
}
</style>
