<?php

namespace App\Http\Controllers;

use App\Encounters\Encounter;
use App\Encounters\Module;
use App\Players\Pc;
use App\PlaySessions\AdventureEncounter;
use App\PlaySessions\Party;
use App\PlaySessions\PlaySession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaySessionController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function startSession(Request $request)
	{
		$playSession = new PlaySession();
		$playSessionId = $request->user()->playSessions()->save($playSession)->id;
		return redirect()->route('adventure.continue', ['id' => $playSessionId]);
	}
	
	public function continueSession(Request $request, PlaySession $playSession)
	{
		session(['new_party_return' => $request->fullUrl()]);
		$playSession->touch();
		$parties = $request->user()->parties;
		$pcs = $request->user()->pcs;
		$modules = $request->user()->modules;
		$encounters = $request->user()->encounters;
		return view('play_session.begin_adventure', compact('playSession', 'parties', 'pcs', 'modules', 'encounters'));
	}
	
	public function pcList(Request $request)
	{
		$pcs = Pc::select('characters.*')->join('players', 'characters.player_id', '=', 'players.id')->where('players.user_id', '=', Auth::user()->id)->get();
		return response()->json($pcs);
	}
	
	public function partyList(Request $request)
	{
		$pcs = Party::where('user_id', '=', Auth::user()->id)->get();
		return response()->json($pcs);
	}
	
	public function assignParty(Request $request, PlaySession $playSession)
	{
		$data = $request->validate(
			[
				'party_id' => 'required|numeric',
			]
		);
		$party = Party::findOrFail($data['party_id']);
		$playSession->party()->associate($party);
		$playSession->save();
		return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
	
	public function assignModule(Request $request, PlaySession $playSession)
	{
        $data = $request->validate(
            [
                'module_id' => 'nullable|numeric',
            ]
        );
        if(!isset($data['module_id']))
        {
            //remove the module encounters.
            $module = $playSession->module;
            $playSession->module()->dissociate();
            $playSession->save();
            if($module)
            {
                $encounter_ids = $module->encounters()->pluck('id');
                $playSession->encounters()->detach($encounter_ids);
            }
        }
        else
        {
            //assign a module to the session.
            $module = Module::findOrFail($data['module_id']);
            $playSession->module()->associate($module);
            $playSession->save();
            //add all encounters
            $encounter_ids = $module->encounters()->pluck('id');
            Log::debug(print_r($encounter_ids, true));
            $playSession->encounters()->sync($encounter_ids);
        }
        return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
	
	public function addEncounter(Request $request, PlaySession $playSession)
	{
		$data = $request->validate(
			[
				'encounter_id' => 'required|numeric',
			]
		);
		$encounter = Encounter::findOrFail($data['encounter_id']);
		$playSession->encounters()->attach($encounter, ['complete' => false]);
		return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
	
	public function removeEncounter(Request $request, PlaySession $playSession)
	{
		$data = $request->validate(
			[
				'encounter_id' => 'required|numeric',
			]
		);
		$encounter = Encounter::findOrFail($data['encounter_id']);
		$playSession->encounters()->detach($encounter);
		return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
	
	public function playEncounter(Request $request, PlaySession $playSession, $encounter_id)
    {
        //makes ure tehre is a party!!!
        if($playSession->party == null)
            return redirect()->back()->withErrors(['You have not selected a party']);
        //create the start of the encounter.  From here, all other encounters should be locked out while one is active.
        if($playSession->currentEncounter())
            return redirect()::back()->withErrors(['Error creating adventure!', 'There is already an adventure playing.  Close that one to continue.']);
        $encounter = Encounter::findOrFail($encounter_id);
        $adventureEncounter = new AdventureEncounter();
        $adventureEncounter->encounter_id = $encounter->id;
        $playSession->adventureEncounters()->save($adventureEncounter);
        return redirect()->route('play.setup', ['adventure_encounter' => $adventureEncounter->id]);
    }
    
    public function endAdventure(Request $request, PlaySession $playSession)
    {
        //close out all adventure encounters
	    AdventureEncounter::where('play_session_id', '=', $playSession->id)
		    ->update(['encounter_completed' => '1']);
	    //close out the session
	    $playSession->finishSession();
    	return redirect()->route('home');
    }
}
