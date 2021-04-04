<template>
  <div>
    <div id="map_canvas"></div>
    <div id="root_panel"></div>
    <div id="map"></div>
  </div>
</template>

<script>
export default {
    data() {
        return {}
    },
    async mounted() {
        // ページ読み込み完了後、Googleマップを表示
        google.maps.event.addDomListener(window, 'load', this.initMap);
    },
    methods: {
        // initialize() {
        //     // Mapクラスのインスタンスを作成（緯度経度は池袋駅に設定）
        //     var initPos = new google.maps.LatLng(0, 0);
        //     // 地図のプロパティを設定（倍率、マーカー表示位置、地図の種類）
        //     var myOptions = {
        //         center: initPos,
        //         zoom: 16,
        //         mapTypeId: google.maps.MapTypeId.ROADMAP
        //     };
        //     // #map_canva要素にMapクラスの新しいインスタンスを作成
        //     myMap = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        //     // 経由ルートと各条件を設定
        //     var request = {
        //         origin: "池袋駅",  // 出発点
        //         destination: "サンシャインシティ",   // 目的地
        //         travelMode: google.maps.DirectionsTravelMode.WALKING,   // 交通手段の設定
        //         waypoints: [{location: "コミックとらのあな 池袋店"}, {location: "アニメイトカフェ池袋店"}]     // 経由地点
        //     };
        //     // DirectionsServiceオブジェクトを使用
        //     var directions = new google.maps.DirectionsService();
        //     directions.route(request, result_direction);
        // },
        // result_direction(result, status) {
        //     let myMap;
        //     if(status == google.maps.DirectionsStatus.OK) {
        //         var direvtionsPosition = new google.maps.DirectionsRenderer({ map: myMap });
        //         direvtionsPosition.setDirections(result);
        //         direvtionsPosition.setPanel(document.getElementById("root_panel"));
        //     }
        // }
        initMap() {
            // 経路表示用インスタンス
            var DS = new google.maps.DirectionsService();
            var DR = new google.maps.DirectionsRenderer();
            // 地図の作成
            var defaultPosition = new google.maps.LatLng({
                lat: 34.366,
                lng: 132.471
            }); // とりあえず決め打ち・・・
            map = new google.maps.Map(document.getElementById("map"), {
                // #sampleに地図を埋め込む
                center: defaultPosition, // 地図の中心を指定
                zoom: 18, // 地図のズームを指定
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            //  mapとDirectionsServiceを紐づける
            DR.setMap(map);

            // 経路検索用リクエスト（べた書き・・・）
            var request = {
                origin: new google.maps.LatLng(34.364991, 132.470085),
                destination: new google.maps.LatLng(34.366, 132.471),
                travelMode: google.maps.TravelMode.DRIVING
            };

            // 経路表示（べた書き・・・）
            DS.route(request, function(result, status) {
                alert(status);
                DR.setDirections(result);
            });
        }
    }
}
</script>

<style>
html { height: 100%; }
body { height: 100%; margin:0; padding:0; }
#map_canvas { width: 70%; height:100%; float:left; }
#root_panel { width: 30%; height:100%; float:right; overflow: auto; }
</style>