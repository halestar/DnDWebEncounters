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
	
	public function playSessions()
	{
		return $this->hasMany('App\PlaySessions\PlaySession', 'user_id', 'id');
	}
	
	public function party()
	{
		return $this->belongsTo('App\PlaySessions\Party', 'party_id', 'id');
	}
	
	public function encounters()
	{
		return $this->belongsToMany('App\Encounters\Encounter', 'play_session_encounters');
	}
	
	public function encountersToPlay()
	{
		return $this->belongsToMany('App\Encounters\Encounter', 'play_session_encounters')->where('play_session_encounters.complete', false);
	}
	
	public function completedEncounters()
	{
		return $this->belongsToMany('App\Encounters\Encounter', 'play_session_encounters')->where('play_session_encounters.complete', true);
	}
	
	public function currentEncounter()
	{
		return $this->belongsTo('App\Encounters\Encounter', 'id', 'current_encounter_id');
	}
	
	public function module()
	{
		return $this->belongsTo('App\Encounters\Module', 'id', 'module_id');
	}
}
