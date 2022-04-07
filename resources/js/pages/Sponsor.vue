<template>
  <div>
      Sponsor
  </div>
</template>

<script>
  export default {
    name: 'Sponsor',
    data() {
        return {
            apartments: [],
        }
    },
        methods: {
        getApartment: function () {
            const url = "http://127.0.0.1:8000/api/v1/sponsor";
            Axios.get(url, {
            })
                .then((result) => {
                    this.apartments = result.data.results.apartments;
                    console.log(result.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
  }
</script>

<style>

</style>