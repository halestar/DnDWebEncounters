<?php

namespace App\PlaySessions;

use Illuminate\Database\Eloquent\Model;

class PlaySession extends Model
{
	protected $table = 'play_sessions';
	protected $guarded = ['id', 'user_id', 'current_encounter_id', 'ended'];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'id', 'user_id');
	}
	
	public function party()
	{
		return $this->belongsTo('App\PlaySessions\Party', 'party_id', 'id');
	}
	
	public function encounters()
	{
		return $this->belongsToMany('App\Encounters\Encounter', 'play_session_encounters', 'play_session_id', 'encounter_id');
	}
	
	public function adventureEncounters()
	{
		return $this->hasMany('App\PlaySessions\AdventureEncounter', 'play_session_id', 'id');
	}
	
	public function currentEncounter()
    {
        return $this->adventureEncounters()->where('encounter_completed', '=', false)->first();
    }
	
	public function module()
	{
		return $this->belongsTo('App\Encounters\Module', 'module_id', 'id');
	}
	
	public function finishSession()
	{
	
	}
}
