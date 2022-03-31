<template>
  <div> 
    <div class="map" id="map" ref="mapRef"></div>
  </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';
export default {
  data() {
    return {
      map: null
    }
  },
  mounted() {
    this.initializeMap()
  },
  methods: {
    initializeMap() {
    this.map = tt.map({
    key: '2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z',
    container: this.$refs.mapRef,
    center: [17.277969, 40.4657082],
    zoom: 10
  });


  //Here I get error
  new tt.Marker()
      .setLngLat([17.277969, 40.4657082])
      .addTo(this.map);
    }
  }
}
</script>

<style lang="scss" scoped>
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style>