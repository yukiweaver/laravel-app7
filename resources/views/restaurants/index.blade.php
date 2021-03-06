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
                <table class="table align-middle">
                    <tbody>
                        <tr>
                            <th scope="row">店舗名</th>
                            <td><input type="text" name="name_any" class="form-control"></td>
                        </tr>
                        <tr>
                            <th scope="row">予算</th>
                            <td>
                                <select class="browser-default custom-select">
                                    <option selected>選択してください</option>
                                    <option value="B009">〜500円</option>
                                    <option value="B010">501〜1000円</option>
                                    <option value="B011">1001〜1500円</option>
                                    <option value="B001">1501〜2000円</option>
                                    <option value="B002">2001〜3000円</option>
                                    <option value="B003">3001〜4000円</option>
                                    <option value="B008">4001〜5000円</option>
                                    <option value="B004">5001〜7000円</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">ジャンル</th>
                            <td>
                                <select class="browser-default custom-select">
                                    <option selected>選択してください</option>
                                    <option value="G001">居酒屋</option>
                                    <option value="G002">ダイニングバー・バル</option>
                                    <option value="G003">創作料理</option>
                                    <option value="G004">和食</option>
                                    <option value="G005">洋食</option>
                                    <option value="G006">イタリアン・フレンチ</option>
                                    <option value="G007">中華</option>
                                    <option value="G008">焼肉・ホルモン</option>
                                    <option value="G017">韓国料理</option>
                                    <option value="G009">アジア・エスニック料理</option>
                                    <option value="G010">各国料理</option>
                                    <option value="G011">カラオケ・パーティ</option>
                                    <option value="G012">バー・カクテル</option>
                                    <option value="G013">ラーメン</option>
                                    <option value="G016">お好み焼き・もんじゃ</option>
                                    <option value="G014">カフェ・スイーツ</option>
                                    <option value="G015">その他グルメ</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">ランチ有無</th>
                            <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline1" name="lunch_flg" value="0" checked>
                                    <label class="custom-control-label" for="defaultInline1">指定なし</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline2" name="lunch_flg" value="1">
                                    <label class="custom-control-label" for="defaultInline2">あり</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">wifi有無</th>
                            <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline1" name="wifi_flg" value="0" checked>
                                    <label class="custom-control-label" for="defaultInline1">指定なし</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="defaultInline2" name="wifi_flg" value="1">
                                    <label class="custom-control-label" for="defaultInline2">あり</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary btn-block">検索する</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
