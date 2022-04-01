<template>
    <div>
        <!-- search bar  -->
            <div class="input-group my-5 justify-content-center">
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
        };
    },

    mounted() {
        this.initializeMap(this.position.lng, this.position.lat);
    },
    methods: {
        validateSearch: function () {
            if (this.query && isNaN(this.query)) {
				return true;
            } else {
				return false;
            }
        },
        initializeMap(lng, lat) {
            this.map = tt.map({
                key: "2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z",
                container: this.$refs.mapRef,
                center: [lng, lat],
                zoom: 12,
            });
            new tt.Marker().setLngLat([lng, lat]).addTo(this.map);
            this.map.addControl(new tt.FullscreenControl());
            this.map.addControl(new tt.NavigationControl());
        },
        moveMap: function (lnglat) {
            this.map.flyTo({
                center: lnglat,
                zoom: 12,
            });
        },
        handleResults: function (result) {
            if (result.results) {
				let lnglat = result.results[0].position;
                this.moveMap(lnglat);
				console.log(lnglat);
				const url = 'http://127.0.0.1:8000/api/v1/apartments/search&lat=' + this.position.lat + '&lng=' + this.position.lng;
				Axios.get(url).then((result) => {
					// this.positionSearch = result.data.results;
					console.log(result);
				}).catch((error) => {
					console.log(error);
				})
            }
            this.position.lng = result.results[0].position.lng;
            this.position.lat = result.results[0].position.lat;
            this.query = "";
        },
        search: function () {
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
#form1 {
    width: 100%;
}
</style>
