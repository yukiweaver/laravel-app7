<template>
  <div>
    <div class="map" id="map" ref="googleMap" />
  </div>
</template>

<script>
import { Loader } from '@googlemaps/js-api-loader';

export default {
  name: 'Map',
  data() {
    return {
      google: null,
      mapConfig: {
        center: {
          lat: 35.68944,
          lng: 139.69167
        },
        zoom: 17
      }
    }
  },
  async mounted() {
    this.google = new Loader({
      apiKey: 'AIzaSyCw2qHAMyUTyPcddKjCso0wLz77XaZLZ-o',
      version: "weekly",
      libraries: ["places"]
    });
    this.google.load().then(() => {
        this.initializeMap();
    })
    .catch(e => {
        console.log(e);
    })
  },
  methods: {
    initializeMap() {
      new google.maps.Map(document.getElementById('map'), this.mapConfig);
    }
  }
}
</script>

<style lang="scss" scoped>
.map {
  width: 100vw;
  height: 100vh;
}
</style>