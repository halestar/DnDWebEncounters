<?php

namespace App\Http\Controllers;

use App\Encounters\CustomMonster;
use App\Encounters\Encounter;
use App\Encounters\Module;
use App\Encounters\Monster;
use App\Encounters\MonsterAbility;
use App\Encounters\MonsterToken;
use App\Players\Pc;
use App\Players\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
	
	
	
	private function addCustomMonster($stats)
	{
		$customMonster = new CustomMonster();
		$customMonster->uuid = $stats['uuid'];
		$customMonster->name = $stats['name'];
		$customMonster->cr = $stats['cr'];
		$customMonster->monsterType = $stats['monsterType'];
		$customMonster->monsterSize = $stats['monsterSize'];
		$customMonster->alignment = $stats['alignment'];
		$customMonster->resistances = $stats['resistances'];
		$customMonster->immunities = $stats['immunities'];
		$customMonster->vulnerabilities = $stats['vulnerabilities'];
		$customMonster->languages = $stats['languages'];
		$customMonster->senses = $stats['senses'];
		$customMonster->str = $stats['str'];
		$customMonster->dex = $stats['dex'];
		$customMonster->con = $stats['con'];
		$customMonster->int = $stats['intel'];
		$customMonster->wis = $stats['wis'];
		$customMonster->cha = $stats['cha'];
		$customMonster->hp = $stats['hp'];
		$customMonster->ac = $stats['ac'];
		$customMonster->speed = $stats['speed'];
		if(isset($stats['hitDice']) && isset($stats['hitDice']['diceStr']))
			$customMonster->hd = $stats['hitDice']['diceStr'];
		$insert_id = Auth::user()->customMonsters()->save($customMonster)->id;
		
		//special abilities
		foreach($stats['specialAbilities'] as $ab)
		{
			$ability = new MonsterAbility();
			$ability->name = $ab['name'];
			$ability->description = $ab['description'];
			$ability->type = CustomMonster::$SPECIAL_ABILITY;
			$customMonster->specialAbilities()->save($ability);
		}
		
		//legendary abilities
		foreach($stats['actions'] as $ab)
		{
			$ability = new MonsterAbility();
			$ability->name = $ab['name'];
			$ability->description = $ab['description'];
			$ability->type = CustomMonster::$ACTION;
			$customMonster->actions()->save($ability);
		}
		
		//special abilities
		foreach($stats['legendaryAbilities'] as $ab)
		{
			$ability = new MonsterAbility();
			$ability->name = $ab['name'];
			$ability->description = $ab['description'];
			$ability->type = CustomMonster::$LEGENDARY_ABILITY;
			$customMonster->legendaryAbilities()->save($ability);
		}
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $insert_id,
			];
	}
	
	private function updateCustomMonster(CustomMonster $customMonster, $stats)
	{
		$customMonster->uuid = $stats['uuid'];
		$customMonster->name = $stats['name'];
		$customMonster->cr = $stats['cr'];
		$customMonster->monsterType = $stats['monsterType'];
		$customMonster->monsterSize = $stats['monsterSize'];
		$customMonster->alignment = $stats['alignment'];
		$customMonster->resistances = $stats['resistances'];
		$customMonster->immunities = $stats['immunities'];
		$customMonster->vulnerabilities = $stats['vulnerabilities'];
		$customMonster->languages = $stats['languages'];
		$customMonster->senses = $stats['senses'];
		$customMonster->str = $stats['str'];
		$customMonster->dex = $stats['dex'];
		$customMonster->con = $stats['con'];
		$customMonster->int = $stats['intel'];
		$customMonster->wis = $stats['wis'];
		$customMonster->cha = $stats['cha'];
		$customMonster->hp = $stats['hp'];
		$customMonster->ac = $stats['ac'];
		$customMonster->speed = $stats['speed'];
		if(isset($stats['hitDice']) && isset($stats['hitDice']['diceStr']))
			$customMonster->hd = $stats['hitDice']['diceStr'];
		$customMonster->save();
		
		$customMonster->abilities()->delete();
		//special abilities
		foreach($stats['specialAbilities'] as $ab)
		{
			$ability = new MonsterAbility();
			$ability->name = $ab['name'];
			$ability->description = $ab['description'];
			$ability->type = CustomMonster::$SPECIAL_ABILITY;
			$customMonster->specialAbilities()->save($ability);
		}
		
		//legendary abilities
		foreach($stats['actions'] as $ab)
		{
			$ability = new MonsterAbility();
			$ability->name = $ab['name'];
			$ability->description = $ab['description'];
			$ability->type = CustomMonster::$ACTION;
			$customMonster->actions()->save($ability);
		}
		
		//special abilities
		foreach($stats['legendaryAbilities'] as $ab)
		{
			$ability = new MonsterAbility();
			$ability->name = $ab['name'];
			$ability->description = $ab['description'];
			$ability->type = CustomMonster::$LEGENDARY_ABILITY;
			$customMonster->legendaryAbilities()->save($ability);
		}
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $customMonster->id,
			];
	}
	
	private function syncCustomMonsters($monsters)
	{
		$custom_monsters_ids = [];
		foreach($monsters as $monster)
		{
			$dbMonster = CustomMonster::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $monster['uuid'])->first();
			if($dbMonster == null)
			{
				//we don't have an id for the db in this monster, nor a uuid in the db, so its an easy insert.
				$custom_monsters_ids[] = $this->addCustomMonster($monster);
			}
			else
			{
				//in this case we have a monster, but the wrong id, so we will re-point it and update it.
				$custom_monsters_ids[] = $this->updateCustomMonster($dbMonster, $monster);
			}
		}
		return $custom_monsters_ids;
	}
	
	private function addEncounter($stats)
	{
		$encounter = new Encounter();
		$encounter->uuid = $stats['uuid'];
		$encounter->name = $stats['encounterName'];
		$encounter->cr = $stats['cr'];
		Auth::user()->encounters()->save($encounter);
		
		$allMonsters = Monster::allSrMonsters();
		$encounterMonsters = [];
		foreach($stats['monsters'] as $encounterMonster)
		{
			if($encounterMonster['mid'] > 0)
			{
				//sr monster
				$encounterMonsters[] = $allMonsters->get($encounterMonster['mid']);
			}
			else
			{
				//custom monster
				if(isset($encounterMonster['dbId']) && $encounterMonster['dbId'] > 0)
					$encounter->customMonsters()->attach($encounterMonster['dbId']);
				else
				{
					$cMonster = CustomMonster::where('uuid', '=', $encounterMonster['uuid'])->first();
					if($cMonster)
						$encounter->customMonsters()->attach($cMonster->id);
				}
			}
		}
		$encounter->srMonsters = $encounterMonsters;
		$encounter->save();
		return
		[
			'uuid' => $stats['uuid'],
			'dbId' => $encounter->id,
		];
	}
	
	private function updateEncounter(Encounter $encounter, $stats)
	{
		$encounter->uuid = $stats['uuid'];
		$encounter->name = $stats['encounterName'];
		$encounter->cr = $stats['cr'];
		$encounter->save();
		$encounter->customMonsters()->detach();
		
		$allMonsters = Monster::allSrMonsters();
		$encounterMonsters = [];
		foreach($stats['monsters'] as $encounterMonster)
		{
			if($encounterMonster['mid'] > 0)
			{
				//sr monster
				$encounterMonsters[] = $allMonsters->get($encounterMonster['mid']);
			}
			else
			{
				//custom monster
				if(isset($encounterMonster['dbId']) && $encounterMonster['dbId'] > 0)
					$encounter->customMonsters()->attach($encounterMonster['dbId']);
				else
				{
					$cMonster = CustomMonster::where('uuid', '=', $encounterMonster['uuid'])->first();
					if($cMonster)
						$encounter->customMonsters()->attach($cMonster->id);
				}
			}
		}
		$encounter->srMonsters = $encounterMonsters;
		$encounter->save();
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $encounter->id,
			];
	}
	
	private function syncEncounters($encounters)
	{
		$encounter_ids = [];
		foreach($encounters as $encounter)
		{
			$dbEncounter = Encounter::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $encounter['uuid'])->first();
			if($dbEncounter == null)
			{
				//we don't have an id for the db in this monster, nor a uuid in the db, so its an easy insert.
				$encounter_ids[] = $this->addEncounter($encounter);
			}
			else
			{
				//in this case we have a monster, but the wrong id, so we will re-point it and update it.
				$encounter_ids[] = $this->updateEncounter($dbEncounter, $encounter);
			}
		}
		return $encounter_ids;
	}
	
	private function addMonsterToken($stats)
	{
		$token = new MonsterToken();
		$token->uuid = $stats['uuid'];
		$token->name = "" . $stats['tokenName'];
		switch($stats['tokenType'])
		{
			case "1":   //numeric token
				$token->token_type = MonsterToken::$TOKEN_TYPE_NUMBER;
				$token->token_number = $stats['tokenNumber'];
				break;
			case "2":   //color token
				$token->token_type = MonsterToken::$TOKEN_TYPE_COLOR;
				$token->token_color = "#" . substr("000000" . dechex($stats['tokenColor']),-6);
				break;
			case "3":   //colored number token
				$token->token_type = MonsterToken::$TOKEN_TYPE_COLORED_NUMBER;
				$token->token_number = $stats['tokenNumber'];
				$token->token_color = "#" . substr("000000" . dechex($stats['tokenColor']),-6);
				break;
			case "4":  //mini token
				$token->token_type = MonsterToken::$TOKEN_TYPE_MINI;$img = "";
				foreach($stats['miniPortrait'] as $byte)
					$img .= chr($byte);
				$token->mini = $img;
				break;
			default:    //numeric token
				$token->token_type = MonsterToken::$TOKEN_TYPE_NUMBER;
				$token->token_number = $stats['tokenNumber'];
				break;
		}
		Auth::user()->monsterTokens()->save($token);
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $token->id,
			];
	}
	
	private function updateMonsterToken(MonsterToken $token, $stats)
	{
		$token->uuid = $stats['uuid'];
		$token->name = "" . $stats['tokenName'];
		switch($stats['tokenType'])
		{
			case "1":   //numeric token
				$token->token_type = MonsterToken::$TOKEN_TYPE_NUMBER;
				$token->token_number = $stats['tokenNumber'];
				break;
			case "2":   //color token
				$token->token_type = MonsterToken::$TOKEN_TYPE_COLOR;
				$token->token_color = "#" . substr("000000" . dechex($stats['tokenColor']),-6);
				break;
			case "3":   //colored number token
				$token->token_type = MonsterToken::$TOKEN_TYPE_COLORED_NUMBER;
				$token->token_number = $stats['tokenNumber'];
				$token->token_color = "#" . substr("000000" . dechex($stats['tokenColor']),-6);
				break;
			case "4":   //mini token
				$token->token_type = MonsterToken::$TOKEN_TYPE_MINI;
				$img = "";
				foreach($stats['miniPortrait'] as $byte)
					$img .= chr($byte);
				$token->mini = $img;
				break;
			default:    //numeric token
				$token->token_type = MonsterToken::$TOKEN_TYPE_NUMBER;
				$token->token_number = $stats['tokenNumber'];
				break;
		}
		$token->save();
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $token->id,
			];
	}
	
	private function syncMonsterTokens($tokens)
	{
		$token_ids = [];
		foreach($tokens as $token)
		{
			$dbToken = MonsterToken::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $token['uuid'])->first();
			if($dbToken == null)
			{
				//we don't have an id for the db in this monster, nor a uuid in the db, so its an easy insert.
				$token_ids[] = $this->addMonsterToken($token);
			}
			else
			{
				//in this case we have a monster, but the wrong id, so we will re-point it and update it.
				$token_ids[] = $this->updateMonsterToken($dbToken, $token);
			}
		}
		return $token_ids;
	}
	
	private function addPlayer($stats)
	{
		$player = new Player();
		$player->uuid = $stats['uuid'];
		$player->name = $stats['name'];
		if(isset($stats['dci']))
			$player->dci = $stats['dci'];
		if(isset($stats['portrait']))
		{
			$img = "";
			foreach($stats['portrait'] as $byte)
				$img .= chr($byte);
			$player->portrait = $img;
		}
		Auth::user()->players()->save($player);
		//do chaacters next
		$pc_ids = [];
		if(isset($stats['pcs']))
			$pc_ids = $this->syncPc($player, $stats['pcs']);
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $player->id,
				'pcs' => $pc_ids,
			];
	}
	
	private function updatePlayer(Player $player, $stats)
	{
		$player->uuid = $stats['uuid'];
		$player->name = $stats['name'];
		if(isset($stats['dci']))
			$player->dci = $stats['dci'];
		if(isset($stats['portrait']))
		{
			$img = "";
			foreach($stats['portrait'] as $byte)
				$img .= chr($byte);
			$player->portrait = $img;
		}
		$player->save();
		//do chaacters next
		$pc_ids = [];
		if(isset($stats['pcs']))
			$pc_ids = $this->syncPc($player, $stats['pcs']);
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $player->id,
				'pcs' => $pc_ids,
			];
	}
	
	private function syncPlayers($players)
	{
		$player_ids = [];
		foreach($players as $player)
		{
			$dbPlayer = Player::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $player['uuid'])->first();
			if($dbPlayer == null)
			{
				//we don't have an id for the db in this monster, nor a uuid in the db, so its an easy insert.
				$player_ids[] = $this->addPlayer($player);
			}
			else
			{
				//in this case we have a monster, but the wrong id, so we will re-point it and update it.
				$player_ids[] = $this->updatePlayer($dbPlayer, $player);
			}
		}
		return $player_ids;
	}
	
	private function addPc(Player $player, $stats)
	{
		$pc = new Pc();
		$pc->uuid = $stats['uuid'];
		$pc->name = $stats['name'];
		$pc->characterClass = $stats['characterClass'];
		$pc->characterRace = $stats['characterRace'];
		$pc->ac = $stats['ac'];
		$pc->hp = $stats['hp'];
		$pc->pp = $stats['pp'];
		$pc->level = $stats['level'];
		$pc->spellDc = $stats['spellDc'];
		$player->pcs()->save($pc);
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $pc->id,
			];
	}
	
	private function updatePc(Pc $pc, $stats)
	{
		$pc->uuid = $stats['uuid'];
		$pc->name = $stats['name'];
		$pc->characterClass = $stats['characterClass'];
		$pc->characterRace = $stats['characterRace'];
		$pc->ac = $stats['ac'];
		$pc->hp = $stats['hp'];
		$pc->pp = $stats['pp'];
		$pc->level = $stats['level'];
		$pc->spellDc = $stats['spellDc'];
		$pc->save();
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $pc->id,
			];
	}
	
	private function syncPc(Player $player, $pcs)
	{
		$pc_ids = [];
		foreach($pcs as $pc)
		{
			$dbPc = Pc::where('player_id', '=', $player->id)->where('uuid', '=', $pc['uuid'])->first();
			if($dbPc == null)
			{
				//we don't have an id for the db in this monster, nor a uuid in the db, so its an easy insert.
				$pc_ids[] = $this->addPc($player, $pc);
			}
			else
			{
				//in this case we have a monster, but the wrong id, so we will re-point it and update it.
				$pc_ids[] = $this->updatePc($dbPc, $pc);
			}
		}
		return $pc_ids;
	}
	
	private function addModule($stats)
	{
		$module = new Module();
		$module->uuid = $stats['uuid'];
		$module->name = $stats['moduleName'];
		$module->description = $stats['moduleDescription'];
		$module->optimized_level = $stats['optimizedLevel'];
		$module->tier = $stats['tier'];
		Auth::user()->modules()->save($module);
		$encounter_ids = $this->syncEncounters($stats['encounters']);
		$sync_ids = [];
		foreach($encounter_ids as $eid)
			$sync_ids[] = $eid['dbId'];
		$module->encounters()->sync($sync_ids);
		
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $module->id,
				'encounters' => $encounter_ids,
			];
	}
	
	private function updateModule(Module $module, $stats)
	{
		$module->uuid = $stats['uuid'];
		$module->name = $stats['moduleName'];
		$module->description = $stats['moduleDescription'];
		$module->optimized_level = $stats['optimizedLevel'];
		$module->tier = $stats['tier'];
		$module->save();
		$encounter_ids = $this->syncEncounters($stats['encounters']);
		$sync_ids = [];
		foreach($encounter_ids as $eid)
			$sync_ids[] = $eid['dbId'];
		$module->encounters()->sync($sync_ids);
		return
			[
				'uuid' => $stats['uuid'],
				'dbId' => $module->id,
				'encounters' => $encounter_ids,
			];
	}
	
	private function syncModules($modules)
	{
		$module_ids = [];
		foreach($modules as $module)
		{
			$dbModule = Module::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $module['uuid'])->first();
			if($dbModule == null)
			{
				//we don't have an id for the db in this monster, nor a uuid in the db, so its an easy insert.
				$module_ids[] = $this->addModule($module);
			}
			else
			{
				//in this case we have a monster, but the wrong id, so we will re-point it and update it.
				$module_ids[] = $this->updateModule($dbModule, $module);
			}
		}
		return $module_ids;
	}
	
	
	public function receiveSyncData(Request $request)
	{
		$custom_monsters = $request->input("custom_monsters", []);
		$encounters = $request->input("encounters", []);
		$modules = $request->input("modules", []);
		$monster_tokens = $request->input("monster_tokens", []);
		$players = $request->input("players", []);
		$rsp =
			[
				'custom_monsters' => $this->syncCustomMonsters($custom_monsters),
				'encounters' => $this->syncEncounters($encounters),
				'monster_tokens' => $this->syncMonsterTokens($monster_tokens),
				'players' => $this->syncPlayers($players),
				'modules' => $this->syncModules($modules),
			];
		return response($rsp, 200);
	}
	
	public function sendSyncData(Request $request)
	{
		//prepare the data to send
		$players = $request->user()->players()->with(['pcs'])->get();
		foreach($players as $player)
		{
			if($player->portrait)
				$player->portrait = base64_encode($player->portrait);
		}
		$customMonsters = $request->user()->customMonsters()->with(['actions', 'specialAbilities', 'legendaryAbilities'])->get();
		$encounters = $request->user()->encounters()->with(['customMonsters'])->get();
		$monsterTokens = $request->user()->monsterTokens;
		foreach($monsterTokens as $monsterToken)
		{
			if($monsterToken->token_type = MonsterToken::$TOKEN_TYPE_MINI)
				$monsterToken->mini = base64_encode($monsterToken->mini);
		}
		$modules = $request->user()->modules()->with(['encounters'])->get();
		$rsp =
			[
				'players' => $players->toArray(),
				'custom_monsters' => $customMonsters->toArray(),
				'encounters' => $encounters->toArray(),
				'moster_tokens' => $monsterTokens->toArray(),
				'modules' => $modules->toArray(),
			];
		return response($rsp, 200);
	}
	
	public function syncDb(Request $request)
	{
		$custom_monsters = $request->input("custom_monsters", []);
		$encounters = $request->input("encounters", []);
		$modules = $request->input("modules", []);
		$monster_tokens = $request->input("monster_tokens", []);
		$players = $request->input("players", []);
	}
}
