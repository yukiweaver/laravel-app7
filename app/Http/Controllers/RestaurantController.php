<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('restaurants.index');
    }

    /**
     * レストラン検索
     */
    public function search(Request $request)
    {
        // $this->searchRestaurant();
        return ['status' => 'ok', 'content' => $request->all()];
    }

    private function searchRestaurant()
    {
        $baseurl = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
        $keyword = '焼肉';
        $params = [
            'key' => config('services.hotpepper.key'),
            'format' => 'json',
            'keyword' => $keyword,
            'count' => 10,
        ];
        $url = $baseurl . '?' . http_build_query($params, '', '&');
        
        // リクエストを送り結果を取得
        $result = file_get_contents($url);
        
        // 取得した翻訳結果のjsonをPHPの連想配列に変換
        $json = json_decode($result, true);
        print_r($json);
    }
}
