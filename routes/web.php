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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/capteur/{id}', 'DataController@saveOneCaptor')->name('data.saveOneCaptor');
Route::get('/capteur', 'DataController@saveAllCaptor')->name('data.saveAllCaptor');

Route::get('/map', 'MapController@index')->name('map.index');
Route::post('/map/position', 'MapController@position')->name('map.position');
Route::post('/map/path', 'MapController@path')->name('map.path');

Route::get('/map/last', 'MapController@index_last_pos')->name('map.index_last_pos');
Route::post('/map/position/last', 'MapController@position_last')->name('map.position_last');

Route::get('/map/optimize', 'MapController@index_optimize_pos')->name('map.index_optimize_pos');
Route::post('/map/position/optimize', 'MapController@position_optimize')->name('map.position_optimize');
Route::post('/map/path/eta', 'MapController@path_eta')->name('map.path_eta');

Route::get('/me', 'UserController@index')->name('user_profile');
Route::post('/me', 'UserController@update')->name('user_update');

Route::get('/credentials', 'UserController@index_cred')->name('credentials');
Route::post('/credentials', 'UserController@update_cred')->name('credentials_update');

Route::get('/sensor', 'DeviceController@index')->name('sensor.index');
Route::get('/sensor/create', 'DeviceController@create')->name('sensor.create');
Route::post('/sensor', 'DeviceController@store')->name('sensor.store');
Route::delete('/sensor/{id}', 'DeviceController@destroy')->name('sensor.destroy');

Route::get('/place', 'PlaceController@index')->name('place.index');
Route::get('/place/create', 'PlaceController@create')->name('place.create');
Route::post('/place', 'PlaceController@store')->name('place.store');
Route::delete('/place/{id}', 'PlaceController@destroy')->name('place.destroy');
