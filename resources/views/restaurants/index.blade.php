@extends('app')

@section('title', 'レストラン検索')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">レストラン検索</h2>
            <form method="post" action="">
                <restaurant-search
                :budget-list='@json(\RestaurantConst::BUDGET_LIST)'
                :genre-list='@json(\RestaurantConst::GENRE_LIST)'
                >
                </restaurant-search>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

<script>
successCallback= function(position)
{
//   alert('緯度：' + position.coords.latitude);
//   alert('経度：' + position.coords.longitude);
}
errorCallback = function(error) {}

if (navigator.geolocation) {
  /* Geolocation APIを利用できる環境向けの処理 */
  var navigator = navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
  console.log(navigator);
} else {
  /* Geolocation APIを利用できない環境向けの処理 */
}
</script>
