<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'RestaurantController@index')->name('restaurant.index');
Route::get('/restaurant/search', 'RestaurantController@search')->name('restaurant.search');
Route::get('/restaurant/direction', 'RestaurantController@direction')->name('restaurant.direction');
