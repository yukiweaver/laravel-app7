<template>
    <div>
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
        <button @click="testMethod" class="btn btn-primary btn-block">検索する</button>
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
        }
    },
    data() {
        return {
            inputName: '',
            budgetSelected: '',
            genreSelected: '',
            checkLunch: '0',
            checkWifi: '0'
        }
    },
    computed: {
        test: function() {
            return 'test';
        }
    },
    methods: {
        testMethod: function() {
            console.log(this.test);
        }
    }
}
</script>

<style>

</style>