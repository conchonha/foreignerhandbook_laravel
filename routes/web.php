<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('login');
});

Route::get('model/user/getData','UserController@getData');

Route::post('model/user/register','UserController@register')->name('register');

Route::post('model/user/login','UserController@login')->name('login');

Route::get('model/menu/getDataMenuTop','MenuController@getDataMenuTop');

Route::get('model/menu/getDataMenuBottom','MenuController@getDataMenuBottom');

Route::get('model/event/getDataEventRanDom','EvenController@getDataEventRanDom');

Route::get('model/place/getDataPlaceHomeRandom','PlaceController@getDataPlaceHomeRandom');

Route::get('model/place/getDataImageHomeRandom','PlaceController@getDataImageHomeRandom');

Route::get('model/ingredient/getDataIngredientIdMenu/id_menu={id}','ingredientController@getData');

Route::get('model/ingredient/getDataPlaceIdIngredient','PlaceController@getDataPlaceIdIngredient');

Route::get('model/place/getDataPlaceIdPlace','PlaceController@getDataPlaceIdPlace');
