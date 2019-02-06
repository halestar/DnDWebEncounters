<?php

namespace App\PlaySessions;

use App\Encounters\Monster;
use Illuminate\Database\Eloquent\Model;

class AdventureActor extends Model
{
	public const SR_MONSTER = "SR_MONSTER";
	public const CUSTOM_MONSTER = "CUSTOM_MONSTER";
	public const PC = "PC";
	
	public const ALIVE = "ALIVE";
	public const DEAD = "DEAD";
    protected $table = 'adventure_actors';
    
    public function isPc()
    {
    	return ($this->actor_type == AdventureActor::PC);
    }
	
	public function isCustomMonster()
	{
		return ($this->actor_type == AdventureActor::CUSTOM_MONSTER);
	}
	
	public function isSrMonster()
	{
		return ($this->actor_type == AdventureActor::SR_MONSTER);
	}
    
    public function adventureEncounter()
    {
    	return $this->belongsTo('App\PlaySessions\AdventureEncounter', 'adventure_encounter_id', 'id');
    }
    
    public function customMonster()
    {
    	if($this->isCustomMonster())
    		return $this->belongsTo('App\Encounters\CustomMonster', 'target_id', 'id');
    	return null;
    }
    
    public function pc()
    {
    	if($this->isPc())
    		return $this->belongsTo('App\Players\Pc', 'target_id', 'id');
    	return null;
    }
    
    public function srMonster()
    {
    	return Monster::makeMonster(json_decode($this->sr_monster, true));
    }
    
    public function getNameAttribute()
    {
    	if($this->isSrMonster())
	    {
	    	return $this->srMonster()->name;
	    }
    	elseif($this->isCustomMonster())
	    {
	        return $this->customMonster->name;
	    }
    	else
	    {
	        return $this->pc->name;
	    }
    }
	
	public function token()
	{
		if($this->actor_type == AdventureActor::SR_MONSTER || $this->actor_type == AdventureActor::CUSTOM_MONSTER)
			return $this->belongsTo('App\Encounters\MonsterToken','token_id', 'id');
		return null;
	}
	
	public function isAlive()
	{
		return ($this->status == AdventureActor::ALIVE);
	}
}
