<?php

namespace App\Consts;

class RestaurantConst
{

    const BASE_URL = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';

    // 1: 300m
    // 2: 500m
    // 3: 1000m (初期値)
    // 4: 2000m
    // 5: 3000m
    const RANGE = 3;

    // 取得数（最大100）
    const COUNT = 30;

    // ホットペッパーAPI 予算マスタAPIの結果を元に記述
    // http://webservice.recruit.co.jp/hotpepper/budget/v1/?key=[APIキー]
    const BUDGET_LIST = [
        'B009' => '〜500円',
        'B010' => '501〜1000円',
        'B011' => '1001〜1500円',
        'B001' => '1501〜2000円',
        'B002' => '2001〜3000円',
        'B003' => '3001〜4000円',
        'B008' => '4001〜5000円',
        'B004' => '5001〜7000円',
    ];

    // ホットペッパーAPI ジャンルマスタAPIの結果を元に記述
    // http://webservice.recruit.co.jp/hotpepper/genre/v1/?key=[APIキー]
    const GENRE_LIST = [
        'G001' => '居酒屋',
        'G002' => 'ダイニングバー・バル',
        'G003' => '創作料理',
        'G004' => '和食',
        'G005' => '洋食',
        'G006' => 'イタリアン・フレンチ',
        'G007' => '中華',
        'G008' => '焼肉・ホルモン',
        'G017' => '韓国料理',
        'G009' => 'アジア・エスニック料理',
        'G010' => '各国料理',
        'G011' => 'カラオケ・パーティ',
        'G012' => 'バー・カクテル',
        'G013' => 'ラーメン',
        'G016' => 'お好み焼き・もんじゃ',
        'G014' => 'カフェ・スイーツ',
        'G015' => 'その他グルメ',
    ];
}