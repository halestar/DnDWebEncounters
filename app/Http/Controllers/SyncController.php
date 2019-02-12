<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
	
	public function sendSyncData(Request $request)
	{
		//prepare the data to send
		$players = $request->user()->players;
		$customMonsters = $request->user()->customMonsters;
		$encounters = $request->user()->encounters;
		$monsterTokens = $request->user()->monsterTokens;
		$modules = $request->user()->modules;
		$pcs = $request->user()->pcs;
		$response =
			[
				'players' => $players,
				'pcs' => $pcs,
				'custom_monsters' => $customMonsters,
				'encounters' => $encounters,
				'moster_tokens' => $monsterTokens,
				'modules' => $modules,
			];
		return response($response, 200);
	}
	
	public function receiveSyncData(Request $request)
	{
		Log::debug("inputs received: " . print_r($request->all(), true));
		
		return response("OK", 200);
	}
}
