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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/players/data','PlayerController@playerList')->name('players.data');
Route::get('/players/pcs/{player}','PcController@playerIndex')->name('players.characters');
Route::resource('players', 'PlayerController');

Route::get('/pcs/data/{selectedPlayer}','PcController@pcList')->name('pcs.data');
Route::resource('pcs', 'PcController')->except(['show']);


Route::get('/monsters/sr/data','MonsterController@srList')->name('monsters.srdata');
Route::get('/monsters/custom/data','MonsterController@customList')->name('monsters.customdata');
Route::get('/monsters/search', 'MonsterController@monsterSearch')->name('monsters.search');
Route::resource('monsters', 'MonsterController')->except(['show']);

Route::get('/encounters/data','EncounterController@encounterList')->name('encounters.data');
Route::resource('encounters', 'EncounterController')->except(['show']);

Route::get('/monster_tokens/data','MonsterTokenController@tokensList')->name('monster_tokens.data');
Route::resource('monster_tokens', 'MonsterTokenController');


Route::get('/modules/data','ModuleController@moduleList')->name('modules.data');
Route::get('/modules/encounter-data','ModuleController@encounterList')->name('modules.encounter_data');
Route::resource('modules', 'ModuleController')->except(['show']);


Route::post('/adventure/party/create/{play_session_id}', 'PlaySessionController@createParty')->name('adventure.party.create');
Route::post('/adventure/party/assign/{play_session_id}', 'PlaySessionController@assignParty')->name('adventure.party.assign');
Route::get('/adventure/pcs', 'PlaySessionController@pcList')->name('adventure.pcs');
Route::get('/adventure/parties', 'PlaySessionController@partyList')->name('adventure.parties');
Route::get('/adventure/begin', 'PlaySessionController@startSession')->name('adventure.begin');
Route::get('/adventure/continue/{id}', 'PlaySessionController@continueSession')->name('adventure.continue');
Route::post('/adventure/module/assign/{play_session_id}', 'PlaySessionController@assignModule')->name('adventure.module.assign');
Route::post('/adventure/encounter/add/{play_session_id}', 'PlaySessionController@addEncounter')->name('adventure.encounter.add');
Route::post('/adventure/encounter/remove/{play_session_id}', 'PlaySessionController@removeEncounter')->name('adventure.encounter.remove');


