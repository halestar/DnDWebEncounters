<?php
/**
 * Created by PhpStorm.
 * User: adming
 * Date: 3/7/2019
 * Time: 4:27 PM
 */

namespace App\Spells;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class JSONSpells
{
    public $name, $desc, $page, $range, $components, $material, $duration, $casting_time, $level, $class, $higher_level, $school;
    public $ritual, $concentration;
    
    public static function allSpells()
    {
        $spell_json = json_decode(Storage::disk('local')->get('spells.json'), true);
        \Log::debug(print_r($spell_json, true));
        $spells = new Collection();
        foreach($spell_json as $spell_stats)
        {
            $spells->push(new JSONSpells($spell_stats));
        }
        return $spells;
    }
    
    public function __construct($stats)
    {
        $this->name = $stats['name'];
        $this->desc = $stats['desc'];
        $this->page = isset($stats['page'])? $stats['page']: "";
        $this->range = isset($stats['range'])? $stats['range']: "";
        $this->components = isset($stats['components'])? $stats['components']: "";
        $this->material = isset($stats['material'])? $stats['material']: "";
        $this->duration = isset($stats['duration'])? $stats['duration']: "";
        $this->casting_time = isset($stats['casting_time'])? $stats['casting_time']: "";
        $this->level = isset($stats['level'])? $stats['level']: "";
        $this->class = isset($stats['class'])? $stats['class']: "";
        $this->higher_level = isset($stats['higher_level'])? $stats['higher_level']: "";
        $this->school = isset($stats['school'])? $stats['school']: "";
        $this->ritual = isset($stats['ritual'])? $stats['ritual']: "";
        $this->concentration = isset($stats['concentration'])? $stats['concentration']: "";
    }
}
