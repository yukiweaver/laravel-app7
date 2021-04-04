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
    //   mapConfig: {
    //     center: {
    //       lat: 35.68944,
    //       lng: 139.69167
    //     },
    //     zoom: 17,
    //   }
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
      var directionsService = new google.maps.DirectionsService();
      var directionsRenderer = new google.maps.DirectionsRenderer();
      var mapOptions = {
        zoom: 13,
        center: null,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        // gestureHandling: 'greedy'
      };
      var mapObj = new google.maps.Map(document.getElementById('map'), mapOptions);
      /* mapObj を DirectionsRendererオブジェクトのsetMap()を使って関連付け */
      directionsRenderer.setMap(mapObj);
      /* 開始地点の座標を指定*/
      var start = new google.maps.LatLng(35.5999772, 139.6120942);
      /* 目的地点の座標を指定*/
      var goal = new google.maps.LatLng(35.726708542903665, 139.71908659458046); 
      /* 開始地点と目的地点、ルーティングの種類を設定  */
      var request = {
        origin: start, 
        destination: goal,
        travelMode: google.maps.TravelMode.WALKING,
        avoidHighways:true
      };
      directionsService.route(request, function(result, status) { 
        /* ルート検索に成功したら以下の処理 */
        if (status == google.maps.DirectionsStatus.OK) { 
        
          /* ルートをマップ上に表示 */ 
          directionsRenderer.setDirections(result);
        }
      });
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