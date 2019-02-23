<?php
/**
 * Created by PhpStorm.
 * User: adming
 * Date: 2/1/2019
 * Time: 10:18 AM
 */

namespace App\Encounters;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Monster
{
	public $monsterJSON;
	public $name, $cr, $monsterType, $monsterSize, $alignment, $resistances, $immunities, $vulnerabilities, $languages, $senses;
	public $str, $dex, $con, $int, $wis, $cha;
	public $str_mod, $dex_mod, $con_mod, $int_mod, $wis_mod, $cha_mod;
	public $hp, $ac, $speed, $hd;
	public $specialAbilities, $actions, $legendaryAbilities;
	public $idx;
	
	public static function allSrMonsters()
	{
		$monster_json = json_decode(Storage::disk('local')->get('dnd_monsters.json'), true);
		$monsters = new Collection();
		$idx = 0;
		foreach($monster_json as $monster_stat)
        {
            $monster_stat['idx'] = $idx;
            $monsters->push(Monster::makeMonster($monster_stat));
            $idx++;
        }
		return $monsters;
	}

	public function __construct()
	{
		$this->name = "";
		$this->cr = "";
		$this->monsterType = "";
		$this->monsterSize = "";
		$this->str = 0;
		$this->dex = 0;
		$this->con = 0;
		$this->int = 0;
		$this->wis = 0;
		$this->cha = 0;
		$this->hp = 0;
		$this->specialAbilities = array();
		$this->actions = array();
		$this->legendaryAbilities = array();
		$this->speed = "unk.";
		$this->alignment = "unk.";
		$this->resistances = "NONE";
		$this->immunities = "NONE";
		$this->vulnerabilities = "NONE";
		$this->languages = "NONE";
		$this->senses = "NONE";
		$this->idx = -1;
		$this->determineMods();
	}

	protected function determineMods()
	{
		$this->str_mod = (int)floor(($this->str - 10) / 2);
		$this->dex_mod = (int)floor(($this->dex - 10) / 2);
		$this->con_mod = (int)floor(($this->con - 10) / 2);
		$this->int_mod = (int)floor(($this->int - 10) / 2);
		$this->wis_mod = (int)floor(($this->wis - 10) / 2);
		$this->cha_mod = (int)floor(($this->cha - 10) / 2);
	}

	public static function makeMonster($stats)
	{
		$monster = new Monster();
		$monster->monsterJSON = json_encode($stats);
		$monster->name = $stats['name'];
		$monster->cr = $stats['challenge_rating'];
		$monster->str = $stats['strength'];
		$monster->dex = $stats['dexterity'];
		$monster->con = $stats['constitution'];
		$monster->int = $stats['intelligence'];
		$monster->wis = $stats['wisdom'];
		$monster->cha = $stats['charisma'];
		$monster->hp = $stats['hit_points'];
		$monster->ac = $stats['armor_class'];
		$monster->monsterType = $stats['type'];
		$monster->monsterSize = $stats['size'];
		$monster->alignment = $stats['alignment'];
        $monster->speed = isset($stats['speed'])? $stats['speed']: "ukn.";
		$monster->resistances = isset($stats['damage_resistances'])? $stats['damage_resistances']: "NONE";
		$monster->immunities = (isset($stats['damage_immunities'])? $stats['damage_immunities']: "");
		if(isset($stats['condition_immunities']))
		{
			if($monster->immunities != "")
				$monster->immunities = $monster->immunities . ", " . $stats['condition_immunities'];
			else
				$monster->immunities = $stats['condition_immunities'];
		}
		$monster->vulnerabilities = (isset($stats['damage_vulnerabilities'])? $stats['damage_vulnerabilities']: "");
		$monster->languages = (isset($stats['languages'])? $stats['languages']: "");
		$monster->senses = (isset($stats['senses'])? $stats['senses']: "");
		$monster->determineMods();
		$monster->specialAbilities = (isset($stats['special_abilities'])? $stats['special_abilities']: []);
		$monster->actions = (isset($stats['actions'])? $stats['actions']: []);
		$monster->legendaryAbilities = (isset($stats['legendary_actions'])? $stats['legendary_actions']: []);
		$monster->hd = (isset($stats['hit_dice'])? $stats['hit_dice']: "");
		$monster->idx = $stats['idx'];
		return $monster;
	}

	protected function formatMod($mod)
	{
		if($mod < 0)
			return $mod;
		if($mod == 0)
			return "0";
		return "+" . $mod;
	}
	
	
	
	
}
