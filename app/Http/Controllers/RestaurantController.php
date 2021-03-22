<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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
        $searchResult = $this->searchRestaurant($request->all());
        return $searchResult;
    }

    private function searchRestaurant(array $data)
    {
        $client = new Client();
        try {
            $response = $client->request('GET', \RestaurantConst::BASE_URL, [
                'query' => [
                    'key' => config('services.hotpepper.key'),
                    'format' => 'json',
                    'name' => $data['name'],
                    'budget' => $data['budget_selected'],
                    'genre' => $data['genre_selected'],
                    'lunch' => $data['check_lunch'],
                    'wifi' => $data['check_wifi'],
                    'lat' => $data['latitude'],
                    'lng' => $data['longitude'],
                    'range' => \RestaurantConst::RANGE,
                    'count' => \RestaurantConst::COUNT,
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (ClientException $e) {
            $response = $e->getReponse;
            return [
                'status' => 'ng',
                'status_code' => $response->getStatusCode(),
                'message' => $response->getMessage(),
            ];
        }

    }

    // private function searchRestaurant()
    // {
    //     $baseurl = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
    //     $keyword = '焼肉';
    //     $params = [
    //         'key' => config('services.hotpepper.key'),
    //         'format' => 'json',
    //         'keyword' => $keyword,
    //         'count' => 10,
    //     ];
    //     $url = $baseurl . '?' . http_build_query($params, '', '&');
        
    //     // リクエストを送り結果を取得
    //     $result = file_get_contents($url);
        
    //     // 取得した翻訳結果のjsonをPHPの連想配列に変換
    //     $json = json_decode($result, true);
    //     print_r($json);
    // }
}
