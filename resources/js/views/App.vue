<template>
  <div>
    <Search />
    <Map />
  </div>
</template>

<script>
import Map from '../components/Map.vue';
import Search from '../components/Search.vue';
export default {
    name: 'App',
    components: {
      Map,
      Search,
    }
}
</script>

<style>

</style>