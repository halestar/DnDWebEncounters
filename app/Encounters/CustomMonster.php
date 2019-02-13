<?php

namespace App\Encounters;

use Illuminate\Database\Eloquent\Model;

class CustomMonster extends Model
{
	protected $table = 'custom_monsters';
	protected $guarded = ['user_id'];
	public static $LEGENDARY_ABILITY = "LEGENDARY ABILITY";
	public static $ACTION = "ACTION";
	public static $SPECIAL_ABILITY = "SPECIAL ABILITY";
	
	public function user()
	{
		return $this->belongsTo('App\User', 'id', 'user_id');
	}
	
	public function abilities()
	{
		return $this->hasMany('App\Encounters\MonsterAbility', 'monster_id', 'id');
	}
	
	public function actions()
	{
		return $this->hasMany('App\Encounters\MonsterAbility', 'monster_id', 'id')->where('monster_ability.type', '=', CustomMonster::$ACTION);
	}
	
	public function specialAbilities()
	{
		return $this->hasMany('App\Encounters\MonsterAbility', 'monster_id', 'id')->where('monster_ability.type', '=', CustomMonster::$SPECIAL_ABILITY);
	}
	
	public function legendaryAbilities()
	{
		return $this->hasMany('App\Encounters\MonsterAbility', 'monster_id', 'id')->where('monster_ability.type', '=', CustomMonster::$LEGENDARY_ABILITY);
	}
    
    public function encounters()
    {
        return $this->belongsToMany('App\Encounters\Encounter', 'encounter_monsters');
    }
    
    public function getStrModAttribute()
    {
        return (int)floor(($this->attributes['str'] - 10) / 2);
    }
    
    public function getDexModAttribute()
    {
        return (int)floor(($this->attributes['dex'] - 10) / 2);
    }
    
    public function getConModAttribute()
    {
        return (int)floor(($this->attributes['con'] - 10) / 2);
    }
    
    public function getIntModAttribute()
    {
        return (int)floor(($this->attributes['int'] - 10) / 2);
    }
    
    public function getWisModAttribute()
    {
        return (int)floor(($this->attributes['wis'] - 10) / 2);
    }
    
    public function getChaModAttribute()
    {
        return (int)floor(($this->attributes['cha'] - 10) / 2);
    }
}
