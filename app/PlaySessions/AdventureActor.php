<?php

namespace App\PlaySessions;

use Illuminate\Database\Eloquent\Model;

class AdventureActor extends Model
{
	public const SR_MONSTER = "SR_MONSTER";
	public const CUSTOM_MONSTER = "CUSTOM_MONSTER";
	public const PC = "PC";
	
	public const ALIVE = "ALIVE";
	public const DEAD = "DEAD";
    protected $table = 'adventure_actors';
    
    public function adventureEncounter()
    {
    	return $this->belongsTo('App\PlaySessions\AdventureEncounter', 'adventure_encounter_id', 'id');
    }
}
