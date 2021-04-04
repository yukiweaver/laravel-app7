@extends('app')

@section('title', 'レストラン検索')

@section('content')
  @include('nav')
  <div class="container">
    <div class="row">
      <restaurant-search
      :budget-list='@json(\RestaurantConst::BUDGET_LIST)'
      :genre-list='@json(\RestaurantConst::GENRE_LIST)'
      search-path={{ route('restaurant.search') }}
      >
      </restaurant-search>
      <test></test>
      {{-- <test2></test2> --}}
    </div>
  </div>
@endsection

<script>
successCallback = function(position)
{
//   alert('緯度：' + position.coords.latitude);
//   alert('経度：' + position.coords.longitude);
}
errorCallback = function(error)
{
    // console.log('エラー');
}

if (navigator.geolocation) {
  /* Geolocation APIを利用できる環境向けの処理 */
  var navigator = navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
//   console.log(navigator);
} else {
  /* Geolocation APIを利用できない環境向けの処理 */
}
</script>
