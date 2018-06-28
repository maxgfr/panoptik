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
