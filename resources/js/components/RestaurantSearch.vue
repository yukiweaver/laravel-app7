<template>
    <div>
        <table class="table align-middle">
            <tbody>
                <tr>
                    <th scope="row">店舗名</th>
                    <td><input type="text" name="name_any" class="form-control"></td>
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
            budgetSelected: '',
            genreSelected: '',
        }
    }
}
</script>

<style>

</style>