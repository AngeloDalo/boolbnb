<template>
  <div>
    <!-- search bar video -->
    <input type="text" id="query" value="" v-model="query">
    <button @click="search()">Search</button>
    <div class="map" id="map" ref="mapRef"></div>
  </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';
import tts from "@tomtom-international/web-sdk-services";
// import {tt as ttServices} from '@tomtom-international/web-sdk-services';
// import tt from '@tomtom-international/web-sdk-maps';
// import tt from "@tomtom-international/web-sdk-services";
export default {
  data() {
    return {
      map: null,
      query: "",
      position: {
        lng: '',
        lat: '',
      }
    }
  },
  mounted() {
    // this.initializeMap()
  },
  methods: {
    initializeMap(lng, lat) { 
    this.map = tt.map({
    key: '2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z',
    container: this.$refs.mapRef,
    center: [lng, lat],
    zoom: 12
    });
    new tt.Marker()
      .setLngLat([lng, lat])
      .addTo(this.map);
    this.map.addControl(new tt.FullscreenControl());
    this.map.addControl(new tt.NavigationControl());
    },
    handleResults: function(result) {
      this.position.lng = result.results[0].position.lng;
      this.position.lat = result.results[0].position.lat;
      this.initializeMap(this.position.lng, this.position.lat)
    },
    search: function() {
      tts.services.fuzzySearch({
        key: '2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z',
        query: this.query,
      }).then(this.handleResults)
    }
  }
}
</script>

<style lang="scss" scoped>
#map {
    height: 90vh;
    width: 90vw;
}
</style>
