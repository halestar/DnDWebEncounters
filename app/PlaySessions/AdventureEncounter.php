<?php

namespace App\PlaySessions;

use Illuminate\Database\Eloquent\Model;

class AdventureEncounter extends Model
{
    protected $table = 'adventure_encounters';
    
    public function playSession()
    {
        return $this->belongsTo('App\PlaySessions\PlaySession', 'play_session_id', 'id');
    }
	
	public function encounter()
	{
		return $this->belongsTo('App\Encounters\Encounter', 'encounter_id', 'id');
	}
	
	public function actors()
	{
		return $this->hasMany('App\PlaySessions\AdventureActor', 'adventure_encounter_id', 'id');
	}
}
