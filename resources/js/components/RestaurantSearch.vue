<template>
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
            <div class="card-body text-center">
                <h2 class="h3 card-title text-center mt-2">レストラン検索</h2>
                <table class="table align-middle">
                    <tbody>
                        <tr>
                            <th scope="row">キーワード</th>
                            <td><input type="text" v-model="keyword" name="keyword" class="form-control" placeholder="店名、地名、駅名など"></td>
                        </tr>
                        <tr>
                            <th scope="row">予算</th>
                            <td>
                                <select v-model="budgetSelected" class="browser-default custom-select">
                                    <option disabled value="">選択してください</option>
                                    <option v-for="(name, key) in budgetList" :value="key" :key="key">
                                        {{ name }}
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">ジャンル</th>
                            <td>
                                <select v-model="genreSelected" class="browser-default custom-select">
                                    <option disabled value="">選択してください</option>
                                    <option v-for="(name, key) in genreList" :value="key" :key="key">
                                        {{ name }}
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">ランチ有無</th>
                            <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" v-model="checkLunch" class="custom-control-input" id="no-lunch" name="lunch_flg" value="0">
                                    <label class="custom-control-label" for="no-lunch">指定なし</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" v-model="checkLunch" class="custom-control-input" id="lunch" name="lunch_flg" value="1">
                                    <label class="custom-control-label" for="lunch">あり</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">wifi有無</th>
                            <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" v-model="checkWifi" class="custom-control-input" id="no-wifi" name="wifi_flg" value="0">
                                    <label class="custom-control-label" for="no-wifi">指定なし</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" v-model="checkWifi" class="custom-control-input" id="wifi" name="wifi_flg" value="1">
                                    <label class="custom-control-label" for="wifi">あり</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button @click="clickSearch" class="btn btn-primary btn-block">検索する</button>
            </div>
        </div>
        <br><br>
        <div id="loader-bg">
            <div id="loader">
                <div class="d-flex align-items-center">
                    <strong>Loading...</strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>
        </div>
        <div id="search-result">
            <div v-if="isSearch" key="is_search">
                <p>{{ count }}件がヒットしました。</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="shop in shops" :key="shop.id">
                    <div class="p-name-wrap">
                        <p>
                            <img :src="shop.logo_image">
                        </p>
                        <div class="p-name-content">
                            <p class="p-category">{{ shop.genre.catch }}</p>
                            <p class="p-catch">■ {{ shop.catch }} ■</p>
                            <p class="p-name">{{ shop.name }}</p>
                        </div>
                    </div>
                    <div class="p-content text-center">
                        <div class="p-main-img">
                            <p>
                                <a :href="shop.urls.pc" target="_balank">
                                    <img :src="shop.photo.pc.l" :alt="shop.name">
                                    <br>
                                    <span>店舗ページを見る</span>
                                </a>
                            </p>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <th>予算</th>
                                    <td>{{ shop.budget.average }}</td>
                                </tr>
                                <tr>
                                    <th>オープン</th>
                                    <td>{{ shop.open }}</td>
                                </tr>
                                <tr>
                                    <th>距離</th>
                                    <td>{{ shop.distance.text }}</td>
                                </tr>
                                <tr>
                                    <th>時間（徒歩）</th>
                                    <td>{{ shop.time.text }}</td>
                                </tr>
                                <tr>
                                    <th>マップ</th>
                                    <td><a :href="shop.map_link" target="_balank">ここに行く</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
// 課題
// 検索項目を一つも入れない場合に、APIエラーになることがある

// メモ
// ルート案内はリンクに任せることにする。webでは現在地の矢印を出すのが困難っぽい
// 表示時点でdirectionAPI使って、距離と時間は表示するようにする。通信重くはなる
// localhostをスマホで確認できるっぽい。タリーズwifiでは無理だったが・・
export default {
    props: {
        // 予算リスト
        budgetList: {
            type: Object,
            default: {}
        },
        // ジャンルリスト
        genreList: {
            type: Object,
            default: {}
        },
        searchPath: {
            type: String,
            default: ''
        },
        directionPath: {
            type: String,
            default: ''
        },
        travelMode: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
            keyword: '',
            budgetSelected: '',
            genreSelected: '',
            checkLunch: '0',
            checkWifi: '0',
            latitude: '', // 緯度
            longitude: '', // 経度
            shops: [], // 検索結果
            count: 0, // 検索ヒット数
            isSearch: false,
        }
    },
    // DOMの生成が完了した直後の処理
    mounted: function() {
        if (navigator.geolocation) {
            /* Geolocation APIを利用できる環境向けの処理 */
            navigator.geolocation.getCurrentPosition(this.successCallback, this.errorCallback);
        } else {
            alert('位置情報が取得できません');
        }
    },
    computed: {
        //
    },
    methods: {
        async clickSearch() {
            console.log('clickSearch');

            // ロードを表示
            var h = $(window).height();
            $('#loader-bg ,#loader').height(h).css('display','block');

            // 時間で強制的にロード非表示
            setTimeout(function() {
                $('#loader-bg').delay(900).fadeOut(800);
                $('#loader').delay(600).fadeOut(300);
            }, 30000);

            await axios.get(this.searchPath, {
                params: {
                    keyword: this.keyword,
                    budget_selected: this.budgetSelected,
                    genre_selected: this.genreSelected,
                    check_lunch: this.checkLunch,
                    check_wifi: this.checkWifi,
                    latitude: this.latitude,
                    longitude: this.longitude
                }
            })
            .then(function(response) {
                console.log(response.data.results);

                let searchResult = response.data.results;
                let code;
                if (searchResult.error) {
                    searchResult.error.forEach(function(value, index) {
                        code = value['code'];
                        console.error('code:' + code);
                        console.error('message:' + value['message']);
                    });
                    alert('検索に失敗しました。\n' + 'code:' + code);
                    this.stopload();
                    return;
                }

                if (searchResult.shop.length) {
                    (async () => {
                        let i = 0;
                        let shops = [];
                        for (let value of searchResult.shop) {
                            shops[i] = value;
                            
                            // ルート情報取得
                            await axios.get(this.directionPath, {
                                params: {
                                    start_lat: this.latitude,
                                    start_lng: this.longitude,
                                    end_lat: value['lat'],
                                    end_lng: value['lng']
                                }
                            })
                            .then(function(response) {
                                console.log(response.data.routes);
                                let directionResult = response.data.routes;
                                if (!directionResult.length) {
                                    throw 'Google Directionの結果が空です';
                                }
                                for (let vals of directionResult) {
                                    for (let val of vals['legs']) {
                                        shops[i]['distance'] = val['distance'];
                                        shops[i]['time'] = val['duration'];
                                        shops[i]['map_link'] = this.createMapLink(
                                            this.latitude,
                                            this.longitude,
                                            value['name'],
                                            this.travelMode
                                        );
                                    }
                                }
                            }.bind(this))
                            .catch(function(error) {
                                alert('Google Direction APIでエラー');
                                console.error(error);
                            }.bind(this))
                            i ++;
                        }
                        console.log(shops);
                        this.isSearch = true;
                        this.count = searchResult.results_returned;
                        this.shops = shops;

                        // ロード非表示
                        this.stopload();
                    })();
                } else {
                    this.isSearch = true;
                    this.count = searchResult.results_returned;
                    this.shops = searchResult.shop;

                    // ロード非表示
                    this.stopload();
                }

            }.bind(this)) // bindすることでthen,catch内でVueインスタンスを参照する
            .catch(function(error) {
                console.error(error);
                alert('検索に失敗しました');

                // ロード非表示
                this.stopload();
            }.bind(this));
        },
        successCallback: function(position) {
            this.latitude = position.coords.latitude;
            this.longitude = position.coords.longitude;
        },
        errorCallback: function(error) {
            alert('位置情報取得を許可してください');
        },
        stopload() {
            $('#loader-bg').delay(900).fadeOut(800);
            $('#loader').delay(600).fadeOut(300);
        },
        createMapLink(startLat, startLng, restaurantName, travelMode='walking') {
            return `https://www.google.com/maps/dir/?api=1&origin=${startLat},${startLng}&destination=${restaurantName}&travelmode=${travelMode}`;
        }
    }
}
</script>

<style>
#loader-bg {
  display: none;
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0px;
  left: 0px;
  background: rgba(0,0,0,0.7);
  z-index: 1;
}
#loader {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  width: 200px;
  height: 200px;
  margin-top: -100px;
  margin-left: -100px;
  text-align: center;
  color: #fff;
  z-index: 2;
}
</style>