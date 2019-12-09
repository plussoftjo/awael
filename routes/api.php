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


// MAIN CONTROLLER 
Route::get('main/index','API\mainController@index');
Route::post('main/fetch','API\mainController@fetchResult');
Route::post('main/fetchSearch','API\mainController@fetchResultSearch');
Route::get('main/profile/{id}','API\mainController@profile');

// ORDER CONTROLLER 
Route::post('order/store','API\orderController@store');

// ssform Controller 
Route::post('ssform/store','API\ssformController@store');