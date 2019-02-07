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


Route::post('/adventure/party/create/{play_session}', 'PlaySessionController@createParty')->name('adventure.party.create');
Route::post('/adventure/party/assign/{play_session}', 'PlaySessionController@assignParty')->name('adventure.party.assign');
Route::get('/adventure/pcs', 'PlaySessionController@pcList')->name('adventure.pcs');
Route::get('/adventure/parties', 'PlaySessionController@partyList')->name('adventure.parties');
Route::get('/adventure/begin', 'PlaySessionController@startSession')->name('adventure.begin');
Route::get('/adventure/continue/{play_session}', 'PlaySessionController@continueSession')->name('adventure.continue');
Route::get('/adventure/end/{play_session}', 'PlaySessionController@endAdventure')->name('adventure.end');
Route::post('/adventure/module/assign/{play_session}', 'PlaySessionController@assignModule')->name('adventure.module.assign');
Route::post('/adventure/encounter/add/{play_session}', 'PlaySessionController@addEncounter')->name('adventure.encounter.add');
Route::post('/adventure/encounter/remove/{play_session}', 'PlaySessionController@removeEncounter')->name('adventure.encounter.remove');
Route::get('/adventure/encounter/play/{play_session}/{encounter_id}', 'PlaySessionController@playEncounter')->name('adventure.encounter.play');

Route::get('/play/{adventure_encounter}/setup', 'PlayController@setup')->name('play.setup');
Route::post('/play/{adventure_encounter}/setup', 'PlayController@completeSetup')->name('play.setup.complete');

Route::get('/play/{adventure_encounter}/party', 'PlayController@editAdventureParty')->name('play.party.edit');
Route::post('/play/{adventure_encounter}/party', 'PlayController@updateAdventureParty')->name('play.party.update');
Route::get('/play/{adventure_encounter}/monsters', 'PlayController@editAdventureMonsters')->name('play.monsters.edit');
Route::post('/play/{adventure_encounter}/monsters', 'PlayController@updateAdventureMonsters')->name('play.monsters.update');


Route::get('/play/{adventure_encounter}', 'PlayController@playEncounter')->name('play');
Route::get('/play/{adventure_encounter}/monster-target/{adventure_actor}', 'PlayController@loadMonsterTarget')->name('play.monster_target');


Route::post('/play/{adventure_encounter}/finish/monster/{adventure_actor}', 'PlayController@finishMonster')->name('play.finish.monster');
Route::get('/play/{adventure_encounter}/finish/dead/{adventure_actor}', 'PlayController@markMonsterDead')->name('play.finish.dead');
Route::get('/play/{adventure_encounter}/finish/player/{adventure_actor}', 'PlayController@finishPlayerTurn')->name('play.finish.player');
Route::post('/play/{adventure_encounter}/finish/monster-turn/{adventure_actor}', 'PlayController@finishMonsterTurn')->name('play.finish.monster_turn');
Route::get('/play/{adventure_encounter}/finish/turn', 'PlayController@finishTurn')->name('play.finish.turn');
Route::get('/play/{adventure_encounter}/finish/encounter', 'PlayController@finishEncounter')->name('play.finish.encounter');

Route::get('/dice/dialog', 'DiceController@showDialog')->name('dice.dialog');
Route::post('/dice/roll', 'DiceController@rollDice')->name('dice.roll');
Route::post('/dice/quick', 'DiceController@quickRoll')->name('dice.quick');

Route::get('/spells/dialog', 'SpellController@showDialog')->name('spells.dialog');
Route::post('/spells/search', 'SpellController@spellSearch')->name('spells.search');
Route::get('/spells/show/{idx}', 'SpellController@showSpell')->name('spells.show');


