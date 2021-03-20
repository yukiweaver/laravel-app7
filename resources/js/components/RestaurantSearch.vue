<template>
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
            <div class="card-body text-center">
                <h2 class="h3 card-title text-center mt-2">レストラン検索</h2>
                <table class="table align-middle">
                    <tbody>
                        <tr>
                            <th scope="row">店舗名</th>
                            <td><input type="text" v-model="inputName" name="name_any" class="form-control"></td>
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
        <div>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small>3 days ago</small>
                    </div>
                    <p class="mb-1">
                    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus
                    varius blandit.
                    </p>
                    <small>Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">
                    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus
                    varius blandit.
                    </p>
                    <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                    </div>
                    <p class="mb-1">
                    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus
                    varius blandit.
                    </p>
                    <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
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
        }
    },
    data() {
        return {
            inputName: '',
            budgetSelected: '',
            genreSelected: '',
            checkLunch: '0',
            checkWifi: '0',
            latitude: '', // 緯度
            longitude: '', // 経度
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
            await axios.get(this.searchPath, {
                params: {
                    input_name: this.inputName,
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
            })
            .catch(function(error) {
                console.log(error);
            });
        },
        successCallback: function(position) {
            this.latitude = position.coords.latitude;
            this.longitude = position.coords.longitude;
        },
        errorCallback: function(error) {
            alert('位置情報取得に失敗しました');
        }
    }
}
</script>

<style>

</style>