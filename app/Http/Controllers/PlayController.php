<?php

namespace App\Http\Controllers;

use App\Dice\DiceParser;
use App\Dice\InitiativeRoller;
use App\Encounters\Monster;
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
        if($adventureEncounter->encounter_setup)
            return redirect()->route('play', ['id' => $adventureEncounter->id]);
    	$tokens = $request->user()->monsterTokens;
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
        $adventureEncounter->save();
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
	    //monsters come next
        if(!$adventureEncounter->monster_initiative)
            $global_initiative = (new InitiativeRoller(0))->roll();
		//SR Monsters
	    $idx = 0;
	    foreach($srMonsters as $srMonster)
	    {
	    	$monster = Monster::makeMonster(json_decode($data['monster_target_' . $idx], true));
		    $actor = new AdventureActor();
		    $actor->actor_type = AdventureActor::SR_MONSTER;
		    $actor->sr_monster = $monster->monsterJSON;
            $actor->status = AdventureActor::ALIVE;
            if($adventureEncounter->monster_initiative)
		        $actor->initiative = (new InitiativeRoller($monster->dex_mod))->roll();
            else
                $actor->initiative = $global_initiative;
		    $actor->has_acted = false;
		    if($adventureEncounter->monster_hp)
                $actor->max_hp = (new DiceParser($monster->hd))->roll();
		    else
                $actor->max_hp = $monster->hp;
            $actor->current_hp = $actor->max_hp;
		    $actor->token_id = $data['monster_token_' . $idx];
		    Log::debug("SR Monster actor is now: " . print_r($actor, true));
		    $adventureEncounter->actors()->save($actor);
		    $idx++;
	    }
	    //custom monsters
        foreach($customMonsters as $customMonster)
        {
            $actor = new AdventureActor();
            $actor->actor_type = AdventureActor::CUSTOM_MONSTER;
            $actor->target_id = $customMonster->id;
            $actor->status = AdventureActor::ALIVE;
            if($adventureEncounter->monster_initiative)
                $actor->initiative = (new InitiativeRoller($customMonster->dexMod))->roll();
            else
                $actor->initiative = $global_initiative;
            $actor->has_acted = false;
            if($adventureEncounter->monster_hp)
                $actor->max_hp = (new DiceParser($customMonster->hd))->roll();
            else
                $actor->max_hp = $customMonster->hp;
            $actor->current_hp = $actor->max_hp;
            $actor->token_id = $data['custom_monster_token_' . $customMonster->id];
            $adventureEncounter->actors()->save($actor);
        }
	    return redirect()->route('play', ['id' => $adventureEncounter->id]);
    }
    
    public function playEncounter(Request $request, AdventureEncounter $adventureEncounter)
    {
        if(!$adventureEncounter->encounter_setup)
        	return redirect()->route('play.setup', ['adventure_encounter' => $adventureEncounter->id]);
        return view('adventure_encounter.home', compact('adventureEncounter'));
    }
}
