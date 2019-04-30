<?php
/**
 * Created by PhpStorm.
 * User: adming
 * Date: 2/7/2019
 * Time: 12:15 PM
 */

namespace App\Spells;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Spell
{
	public $name, $description, $page, $range, $components, $material, $duration, $casting_time,
	$level, $spellClass, $higher_level, $school;
	public $ritual, $concentration;
	
	public static function allSpells()
	{
		$spell_json = json_decode(Storage::disk('local')->get('spells.json'), true);
        \Log::debug(print_r($spell_json, true));
		$spells = new Collection();
		$idx = 0;
		foreach($spell_json as $spell_stats)
		{
			$spells->push(new Spell($idx, $spell_stats));
			$idx++;
		}
		return $spells;
	}
	
	public function __construct($idx, $stats)
	{
		$this->idx = $idx;
		$this->name = $stats['name'];
		$this->description = $stats['desc'];
		$this->page = isset($stats['page'])? $stats['page']: "";
		$this->range = isset($stats['range'])? $stats['range']: "";
		$this->components = isset($stats['components'])? $stats['components']: "";
		$this->material = isset($stats['material'])? $stats['material']: "";
		$this->duration = isset($stats['duration'])? $stats['duration']: "";
		$this->casting_time = isset($stats['casting_time'])? $stats['casting_time']: "";
		$this->level = isset($stats['level'])? $stats['level']: "";
		$this->spellClass = isset($stats['class'])? $stats['class']: "";
		$this->higher_level = isset($stats['higher_level'])? $stats['higher_level']: "";
		$this->school = isset($stats['school'])? $stats['school']: "";
		$this->ritual = ($stats['ritual'] == "yes")? true: false;
		$this->concentration = ($stats['concentration'] == "yes")? true: false;
	}
}
