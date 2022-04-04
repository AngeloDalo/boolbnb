<template>
    <div>
        <Map/>
        <router-view></router-view>
    </div>
</template>

<script>
import Map from "../components/Map.vue";
export default {
    name: "App",
    components: {
        Map,
    },
};
</script>

<style lang="scss" scoped>
@import '~bootstrap/scss/bootstrap';
</style>
