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
	
	private function highestInitiative()
	{
		$highest = 0;
		foreach($this->actors as $actor)
		{
			if($highest <= $actor->initiative && !$actor->has_acted && ($actor->isPc() || $actor->isAlive()))
				$highest = $actor->initiative;
		}
		return $highest;
	}
	
	public function getCurrentInitiative()
	{
		if($this->current_initiative == null)
		{
			$this->current_initiative = $this->highestInitiative();
			$this->save();
		}
		return $this->current_initiative;
	}
	
	public function getCurrentActor()
	{
		if($this->current_initiative == null)
			$this->getCurrentInitiative();
		foreach($this->actors as $actor)
		{
			if($this->current_initiative == $actor->initiative && !$actor->has_acted && ($actor->isPc() || $actor->isAlive()))
				return $actor;
		}
		return null;
	}
	
	public function completeSetup()
	{
		$this->encounter_setup = true;
		$this->turn_number = 1;
		$this->getCurrentInitiative();
		$this->save();
	}
	
	public function isCurrentActor($actor)
	{
		$currentActor = $this->getCurrentActor();
		return ($currentActor != null && $currentActor->id == $actor->id);
	}
	
	public function pcActors()
	{
		return $this->actors()->where('actor_type', '=', AdventureActor::PC)->get();
	}
	
	public function monsterActors()
	{
		return $this->actors()->where('actor_type', '<>', AdventureActor::PC)->where('status', '=', AdventureActor::ALIVE)->get();
	}
	
	public function nextRound()
	{
		$this->current_initiative = $this->highestInitiative();
		$this->save();
		$this->playSession->touch();
	}
	
	public function finishTurn()
	{
		AdventureActor::where('adventure_encounter_id', '=', $this->id)
			->update(['has_acted' => false]);
		$this->turn_number++;
		$this->current_initiative = $this->highestInitiative();
		$this->save();
		$this->playSession->touch();
	}
	
	public function finishEncounter()
	{
		$this->encounter_completed = true;
		$this->save();
		$this->playSession->touch();
		$this->playSession->current_encounter_id = null;
		$this->playSession->save();
	}
}
