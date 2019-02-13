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

Route::get('/sync/download', 'SyncController@sendSyncData')->name('sync.download');
Route::post('/sync/upload', 'SyncController@receiveSyncData')->name('sync.upload');
Route::post('/sync/db', 'SyncController@syncDb')->name('sync.db');
