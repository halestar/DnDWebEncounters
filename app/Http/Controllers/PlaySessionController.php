<?php

namespace App\Http\Controllers;

use App\Encounters\Encounter;
use App\Players\Pc;
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
	
	public function continueSession(Request $request, $id)
	{
		$playSession = PlaySession::findOrFail($id);
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
	
	public function createParty(Request $request, $play_session_id)
	{
		$playSession = PlaySession::findOrFail($play_session_id);
		$data = $request->validate(
			[
				'party_id' => 'nullable|numeric',
				'name' => 'required|max:255',
				'pcs' => 'nullable|array',
			]
		);
		Log::debug(print_r($data, true));
		if(isset($data['party_id']))
			$party = Party::findOrFail($data['party_id']);
		else
			$party = new Party();
		$party->name = $data['name'];
		$apl = 0;
		foreach($data['pcs'] as $pc_id)
		{
			$pc = Pc::findOrFail($pc_id);
			$apl += $pc->level;
		}
		$party->apl = floor($apl / count($data['pcs']));
		if(isset($data['party_id']))
			$party->save();
		else
			$request->user()->parties()->save($party);
		Log::debug(print_r($party, true));
		$party->pcs()->sync($data['pcs']);
		$playSession->party()->associate($party);
		$playSession->save();
		return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
	
	public function assignParty(Request $request, $play_session_id)
	{
		$playSession = PlaySession::findOrFail($play_session_id);
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
	
	public function assignModule(Request $request, $play_session_id)
	{
	
	}
	
	public function addEncounter(Request $request, $play_session_id)
	{
		$playSession = PlaySession::findOrFail($play_session_id);
		$data = $request->validate(
			[
				'encounter_id' => 'required|numeric',
			]
		);
		$encounter = Encounter::findOrFail($data['encounter_id']);
		$playSession->encounters()->attach($encounter, ['complete' => false]);
		return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
	
	public function removeEncounter(Request $request, $play_session_id)
	{
		$playSession = PlaySession::findOrFail($play_session_id);
		$data = $request->validate(
			[
				'encounter_id' => 'required|numeric',
			]
		);
		$encounter = Encounter::findOrFail($data['encounter_id']);
		$playSession->encounters()->detach($encounter);
		return redirect()->route('adventure.continue', ['id' => $playSession->id]);
	}
}