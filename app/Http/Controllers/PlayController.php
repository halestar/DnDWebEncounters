<?php

namespace App\Http\Controllers;

use App\PlaySessions\AdventureActor;
use App\PlaySessions\AdventureEncounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PlayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function setup(Request $request, AdventureEncounter $adventureEncounter)
    {
    	$tokens = $request->user()->monsterTokens;
    	\Log::debug(print_r($adventureEncounter->encounter->srMonsters, true));
        return view('adventure_encounter.setup', compact('adventureEncounter', 'tokens'));
    }
    
    public function completeSetup(Request $request, AdventureEncounter $adventureEncounter)
    {
	    $rules =
		    [
			    'monster_initiative' => 'checkbox',
			    'monster_hp' => 'checkbox',
		    ];
	    //validate pc initiative
	    $pcs = $adventureEncounter->playSession->party->pcs;
	    foreach($pcs as $pc)
	    	$rules['initiative_' . $pc->id] = 'required|numeric';
	    //validate sr monster tokens
	    $srMonsters = $adventureEncounter->encounter->srMonsters;
	    $idx = 0;
	    foreach($srMonsters as $srMonster)
	    {
		    $rules['monster_target_' . $idx] = 'required|json';
		    $rules['monster_token_' . $idx] = 'required|numeric';
		    $idx++;
	    }
	    //validate custom monsters
	    $customMonsters = $adventureEncounter->encounter->customMonsters;
	    foreach($customMonsters as $customMonster)
		    $rules['custom_monster_token_' . $customMonster->id] = 'required|numeric';
	    //validate
	    $data = $request->validate($rules);
	    //at this point, we can enter the objects.
	    Log::debug("data received from setup: " . print_r($data, true));
	    //setttings first
	    $adventureEncounter->turn_completed = false;
	    $adventureEncounter->encounter_setup = true;
	    $adventureEncounter->encounter_completed = false;
	    $adventureEncounter->monster_initiative = $data['monster_initiative'];
	    $adventureEncounter->monster_hp = $data['monster_hp'];
	    $adventureEncounter->turn_number = 1;
	    //PC's
	    foreach($pcs as $pc)
	    {
	    	$actor = new AdventureActor();
	    	$actor->actor_type = AdventureActor::PC;
	    	$actor->target_id = $pc->id;
	    	$actor->status = AdventureActor::ALIVE;
	    	$actor->initiative = $data['initiative_' . $pc->id];
	    	$actor->has_acted = false;
	    	$actor->current_hp = $pc->hp;
	    	$actor->max_hp = $pc->hp;
	    	$adventureEncounter->actors()->save($actor);
	    }
		//SR Monsters
	    $idx = 0;
	    foreach($srMonsters as $srMonster)
	    {
	    	$monster = json_decode($data['monster_target_' . $idx], true);
		    $actor = new AdventureActor();
		    $actor->actor_type = AdventureActor::SR_MONSTER;
		    $actor->status = AdventureActor::ALIVE;
		    //$actor->initiative = $data['initiative_' . $pc->id];
		    $actor->has_acted = false;
		    $actor->current_hp = $monster['hp'];
		    $actor->max_hp = $monster['hp'];
		    $actor->token_id = $data['monster_token_' . $idx];
		    $idx++;
	    }
	
	    //$adventureEncounter->save();
    }
    
    public function playEncounter(Request $request, AdventureEncounter $adventureEncounter)
    {
        if(!$adventureEncounter->encounter_setup)
        	return redirect()->route('play.setup', ['adventure_encounter' => $adventureEncounter->id]);
    }
}
