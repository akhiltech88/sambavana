<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register','Auth\RegisterController@postRegister');
Route::post('login','Auth\LoginController@login');

Route::group(['middleware' => ['api_login']], function () {
Route::post('save_place','PlaceController@savePlace');
Route::post('save_address','AddressBookController@saveAddress');
Route::post('get_place','PlaceController@getPlace');
Route::post('get_address','AddressBookController@getAddress');
});