<template>
  <div>
    <!-- search bar  -->
    <div class="input-group my-5 justify-content-center">
        <div class="form-outline">
            <input type="search" id="form1" class="form-control" placeholder="Search" v-model="query"/>
        </div>
        <button type="button" class="btn btn-primary" @click="search()">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <!-- <input type="text" id="query" value="" v-model="query">
    <button @click="search()">Search</button> -->
    <div class="map" id="map" ref="mapRef"></div>
  </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';
import tts from "@tomtom-international/web-sdk-services";
export default {
  name: 'Map',
  data() {
    return {
      map: null,
      query: "",
      position: {
        lng: 12.4829321,
        lat: 41.8933203,
      }
      
    }
  },
  
  mounted() {
    this.initializeMap(this.position.lng, this.position.lat);
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
    moveMap: function(lnglat) {
      this.map.flyTo({
        center: lnglat,
        zoom: 12,
      })
    },
    handleResults: function(result) {
      if (result.results) {
        this.moveMap(result.results[0].position)
      }
      this.position.lng = result.results[0].position.lng;
      this.position.lat = result.results[0].position.lat;
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
div.form-outline {
    width: 60%;
}
#form1 {
    width: 100%;
}
</style>
