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
Route::get('/players', 'PlayerController@index')->name('players.list');
Route::get('/players/add', 'PlayerController@create')->name('players.add');
Route::post('/players/store', 'PlayerController@store')->name('players.store');
Route::get('/players/data','PlayerController@playerList')->name('players.data');
Route::get('/players/portrait/{id}', 'PlayerController@showPortrait')->name('players.portrait');
