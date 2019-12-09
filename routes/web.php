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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin',function() { 
	return view('admin');
});


// --- ADMIN PANEL -- // 

Route::post('admin/mainSection/store','ADMIN\sectionController@store');
Route::post('admin/mainSection/update','ADMIN\sectionController@update');
Route::get('admin/mainSection/index','ADMIN\sectionController@index');
Route::get('admin/mainSection/destroy/{id}','ADMIN\sectionController@destroy');

Route::post('admin/secondSection/store','ADMIN\secondSectionController@store');
Route::post('admin/secondSection/update','ADMIN\secondSectionController@update');
Route::get('admin/secondSection/index','ADMIN\secondSectionController@index');
Route::get('admin/secondSection/destroy/{id}','ADMIN\secondSectionController@destroy');

Route::post('admin/country/store','ADMIN\countryController@store');
Route::post('admin/country/update','ADMIN\countryController@update');
Route::get('admin/country/index','ADMIN\countryController@index');
Route::get('admin/country/destroy/{id}','ADMIN\countryController@destroy');

Route::get('admin/cv/index','ADMIN\cvController@index');
Route::post('admin/cv/store','ADMIN\cvController@store');
Route::get('admin/cv/destroy/{id}','ADMIN\cvController@destroy');


// ORDERS 
Route::get('admin/orders/index','API\orderController@index');
Route::get('admin/orders/done/{id}','API\orderController@update');

// SSFORM 
Route::get('admin/ssform/index','API\ssformController@index');
Route::get('admin/ssform/done/{id}','API\ssformController@update');