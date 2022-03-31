<template>
  <div> 
    <h1>Vue 3 TomTom Maps Demo</h1> 
    <div id='map' ref="mapRef"></div> 
  </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';
import { onMounted, ref } from 'vue'; 
export default {
    name: 'Map',
    setup() { 
    const mapRef = ref(null); 
    onMounted(() => { 
      const tt = window.tt; 
      var map = tt.map({ 
      key: '2PavVFdEzd44ElVnixCMPjU42Wgfsj6Z', 
      container: mapRef.value, 
      style: 'tomtom://vector/1/basic-main', 
    }); 
      map.addControl(new tt.FullscreenControl()); 
      map.addControl(new tt.NavigationControl());  
    }) 
    return { 
      mapRef, 
    }; 
  }  
    
}
</script>

<style lang="scss" scoped>
#map { 
    height: 50vh; 
    width: 50vw; 
} 
</style>